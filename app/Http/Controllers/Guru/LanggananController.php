<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Langganan;
use App\Models\PaketLangganan;
use App\Models\Pembayaran;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class LanggananController extends Controller
{
    /**
     * Menampilkan halaman Langganan Saya untuk Guru.
     */
    public function index(Request $request): View
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        // 2 Paket Langganan: Paket Semester 1 dan Paket Semester 2
        $paketSemester1 = PaketLangganan::getPaketSemester1();
        $paketSemester2 = PaketLangganan::getPaketSemester2();
        $semuaPaket = PaketLangganan::aktif()->with('semester')->get();

        // Status aktif per semester
        $activeSubSemesterIds = $user->getActiveSubscribedSemesterIds();

        // Langganan aktif Semester 1 & 2
        $activeSubSem1 = $paketSemester1 ? $user->getActiveSubscription($paketSemester1->semester_id) : null;
        $activeSubSem2 = $paketSemester2 ? $user->getActiveSubscription($paketSemester2->semester_id) : null;

        // Tanggal berakhir terjauh per semester
        $latestEndSem1 = $paketSemester1 ? $user->getLatestSubscriptionEndDate($paketSemester1->semester_id) : null;
        $latestEndSem2 = $paketSemester2 ? $user->getLatestSubscriptionEndDate($paketSemester2->semester_id) : null;

        // Riwayat seluruh langganan guru bersangkutan
        $riwayatLangganan = Langganan::with(['paketLangganan.semester', 'pembayarans'])
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        return view('guru.langganan.index', [
            'user' => $user,
            'paketSemester1' => $paketSemester1,
            'paketSemester2' => $paketSemester2,
            'semuaPaket' => $semuaPaket,
            'activeSubSemesterIds' => $activeSubSemesterIds,
            'activeSubSem1' => $activeSubSem1,
            'activeSubSem2' => $activeSubSem2,
            'latestEndSem1' => $latestEndSem1,
            'latestEndSem2' => $latestEndSem2,
            'riwayatLangganan' => $riwayatLangganan,
        ]);
    }

    /**
     * Langkah 3: Membuat pesanan baru dan meminta Snap Token ke Midtrans.
     */
    public function store(Request $request): RedirectResponse
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        $request->validate([
            'paket_langganan_id' => ['required', 'exists:paket_langganans,id'],
            'metode_pembayaran' => ['nullable', 'string', 'max:50'],
            'bukti_pembayaran' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:2048'],
        ], [
            'paket_langganan_id.required' => 'Silakan pilih paket langganan yang diinginkan.',
        ]);

        $paket = PaketLangganan::findOrFail($request->paket_langganan_id);

        // Cek apakah paket semester ini sudah bisa diperpanjang (belum aktif, sudah habis, atau <= H-7)
        if (! $user->canRenewSemester($paket->semester_id)) {
            $sisaHari = $user->getSisaHariSemester($paket->semester_id);
            return redirect()
                ->route('guru.langganan.index')
                ->with('error', "Paket {$paket->nama} Anda masih aktif ({$sisaHari} hari tersisa). Perpanjangan paket baru dapat dilakukan mulai H-" . Langganan::BATAS_HARI_PERPANJANG . " sebelum masa aktif berakhir.");
        }

        // Penentuan masa akses paket (12 bulan):
        // Jika diperpanjang pada periode H-7, masa aktif baru dimulai setelah masa aktif sebelumnya berakhir.
        $latestEndDate = $user->getLatestSubscriptionEndDate($paket->semester_id);
        if ($latestEndDate && $latestEndDate->gte(Carbon::today())) {
            $tanggalMulai = $latestEndDate->copy()->addDay()->toDateString();
            $tanggalBerakhir = Carbon::parse($tanggalMulai)->addMonths($paket->durasi_bulan ?? 12)->toDateString();
        } else {
            $tanggalMulai = Carbon::today()->toDateString();
            $tanggalBerakhir = Carbon::today()->addMonths($paket->durasi_bulan ?? 12)->toDateString();
        }

        // 1. Simpan data Langganan
        $langganan = Langganan::create([
            'user_id' => $user->id,
            'paket_langganan_id' => $paket->id,
            'tanggal_mulai' => $tanggalMulai,
            'tanggal_berakhir' => $tanggalBerakhir,
            'status' => Langganan::STATUS_AKTIF,
        ]);

        // 2. Buat Order ID unik & simpan data Pembayaran awal (status: menunggu)
        $orderId = 'INV-' . now()->format('YmdHis') . '-' . $langganan->id;

        $pembayaran = Pembayaran::create([
            'langganan_id' => $langganan->id,
            'order_id' => $orderId,
            'metode_pembayaran' => $request->input('metode_pembayaran') ?: 'Midtrans',
            'jumlah' => $paket->harga,
            'tanggal_pembayaran' => now(),
            'status' => Pembayaran::STATUS_MENUNGGU,
        ]);

        // 3. Minta Snap Token ke Server Midtrans
        $snapToken = $this->requestMidtransSnapToken($pembayaran, $paket, $user);

        if ($snapToken) {
            $pembayaran->update(['snap_token' => $snapToken]);

            return redirect()
                ->route('guru.langganan.index')
                ->with('snap_token', $snapToken)
                ->with('pembayaran_id', $pembayaran->id)
                ->with('success', "Tagihan {$paket->nama} berhasil dibuat. Silakan selesaikan pembayaran pada jendela yang muncul.");
        }

        return redirect()
            ->route('guru.langganan.index')
            ->with('success', "Pesanan {$paket->nama} berhasil dibuat. Akses materi akan otomatis aktif setelah pembayaran selesai.");
    }

    /**
     * Langkah 5A: Mengecek status pembayaran langsung ke API Midtrans
     * (Dipanggil otomatis setelah popup pembayaran selesai atau saat guru klik "Cek Status").
     */
    public function checkStatus(Request $request, Pembayaran $pembayaran): RedirectResponse
    {
        if ($pembayaran->langganan?->user_id !== $request->user()->id) {
            abort(403);
        }

        if (! $pembayaran->order_id) {
            return redirect()->route('guru.langganan.index');
        }

        $serverKey = config('services.midtrans.server_key');
        $isProduction = config('services.midtrans.is_production', false);
        $baseUrl = $isProduction
            ? 'https://api.midtrans.com/v2'
            : 'https://api.sandbox.midtrans.com/v2';

        try {
            $response = Http::withBasicAuth($serverKey, '')
                ->acceptJson()
                ->get("{$baseUrl}/{$pembayaran->order_id}/status");

            if ($response->successful()) {
                $data = $response->json();
                $transactionStatus = $data['transaction_status'] ?? '';
                $paymentType = $data['payment_type'] ?? 'Midtrans';

                $this->updateStatusDariMidtrans($pembayaran, $transactionStatus, $paymentType);

                if ($pembayaran->fresh()->status === Pembayaran::STATUS_BERHASIL) {
                    $namaPaket = $pembayaran->langganan?->paketLangganan?->nama ?? 'Paket Langganan';
                    return redirect()
                        ->route('guru.langganan.index')
                        ->with('success', "Pembayaran berhasil! {$namaPaket} Anda kini telah aktif.");
                }

                if ($pembayaran->fresh()->status === Pembayaran::STATUS_GAGAL) {
                    return redirect()
                        ->route('guru.langganan.index')
                        ->with('error', 'Transaksi pembayaran dibatalkan atau telah kedaluwarsa.');
                }
            }
        } catch (\Throwable $e) {
            Log::error('Midtrans Check Status Error: ' . $e->getMessage());
        }

        return redirect()
            ->route('guru.langganan.index')
            ->with('success', 'Menunggu penyelesaian pembayaran. Jika Anda sudah membayar, klik tombol Cek Status pada tabel riwayat.');
    }

    /**
     * Langkah 5B: Webhook / Callback otomatis dari Server Midtrans (POST /midtrans/callback).
     */
    public function callback(Request $request): JsonResponse
    {
        $serverKey = config('services.midtrans.server_key');
        $orderId = $request->input('order_id');
        $statusCode = $request->input('status_code');
        $grossAmount = $request->input('gross_amount');
        $signatureKey = $request->input('signature_key');

        // Validasi Signature Key keamanan dari Midtrans
        $expectedSignature = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);
        if ($signatureKey !== $expectedSignature) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $pembayaran = Pembayaran::where('order_id', $orderId)->first();
        if (! $pembayaran) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $transactionStatus = $request->input('transaction_status');
        $paymentType = $request->input('payment_type', 'Midtrans');

        $this->updateStatusDariMidtrans($pembayaran, $transactionStatus, $paymentType);

        return response()->json(['message' => 'Callback processed successfully']);
    }

    /**
     * Helper: Meminta Snap Token ke API Midtrans menggunakan Laravel Http Client.
     */
    protected function requestMidtransSnapToken(Pembayaran $pembayaran, PaketLangganan $paket, $user): ?string
    {
        $serverKey = config('services.midtrans.server_key');
        if (empty($serverKey) || app()->runningUnitTests()) {
            return null;
        }

        $isProduction = config('services.midtrans.is_production', false);
        $snapUrl = $isProduction
            ? 'https://app.midtrans.com/snap/v1/transactions'
            : 'https://app.sandbox.midtrans.com/snap/v1/transactions';

        $payload = [
            'transaction_details' => [
                'order_id' => $pembayaran->order_id,
                'gross_amount' => (int) round($paket->harga),
            ],
            'customer_details' => [
                'first_name' => $user->nama,
                'email' => $user->email,
                'phone' => $user->no_hp ?? '',
            ],
            'item_details' => [
                [
                    'id' => 'PAKET-' . $paket->id,
                    'price' => (int) round($paket->harga),
                    'quantity' => 1,
                    'name' => substr($paket->nama, 0, 50),
                ],
            ],
        ];

        try {
            $response = Http::withBasicAuth($serverKey, '')
                ->acceptJson()
                ->post($snapUrl, $payload);

            if ($response->successful()) {
                return $response->json('token');
            }

            Log::warning('Midtrans Snap Error: ' . $response->body());
        } catch (\Throwable $e) {
            Log::error('Midtrans Connection Error: ' . $e->getMessage());
        }

        return null;
    }

    /**
     * Helper: Memperbarui status Pembayaran & Langganan berdasarkan status dari Midtrans.
     */
    protected function updateStatusDariMidtrans(Pembayaran $pembayaran, string $transactionStatus, string $paymentType): void
    {
        $metodeFormatted = strtoupper(str_replace('_', ' ', $paymentType));

        if (in_array($transactionStatus, ['capture', 'settlement'], true)) {
            // Pembayaran Lunas -> Aktifkan paket langganan
            $pembayaran->update([
                'status' => Pembayaran::STATUS_BERHASIL,
                'metode_pembayaran' => $metodeFormatted,
                'tanggal_pembayaran' => now(),
            ]);

            $pembayaran->langganan?->update([
                'status' => Langganan::STATUS_AKTIF,
            ]);
        } elseif (in_array($transactionStatus, ['deny', 'cancel', 'expire'], true)) {
            // Pembayaran Gagal / Dibatalkan / Kedaluwarsa
            $pembayaran->update([
                'status' => Pembayaran::STATUS_GAGAL,
                'metode_pembayaran' => $metodeFormatted,
            ]);

            $pembayaran->langganan?->update([
                'status' => Langganan::STATUS_DIBATALKAN,
            ]);
        }
    }
}
