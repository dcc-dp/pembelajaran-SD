<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Langganan;
use App\Models\PaketLangganan;
use App\Models\Pembayaran;
use App\Models\Semester;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
     * Memproses pengajuan langganan baru atau perpanjangan paket oleh Guru.
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
            'bukti_pembayaran.image' => 'File bukti transfer harus berupa gambar.',
            'bukti_pembayaran.mimes' => 'Format gambar yang diperbolehkan: JPG, JPEG, PNG, atau WEBP.',
            'bukti_pembayaran.max' => 'Ukuran file bukti transfer maksimal 2 MB.',
        ]);

        $paket = PaketLangganan::findOrFail($request->paket_langganan_id);

        // Cek apakah paket semester ini sudah bisa diperpanjang (belum aktif, sudah habis, atau <= H-7)
        if (! $user->canRenewSemester($paket->semester_id)) {
            $sisaHari = $user->getSisaHariSemester($paket->semester_id);
            return redirect()
                ->route('guru.langganan.index')
                ->with('error', "Paket {$paket->nama} Anda masih aktif ({$sisaHari} hari tersisa). Perpanjangan paket baru dapat dilakukan mulai H-" . Langganan::BATAS_HARI_PERPANJANG . " sebelum masa aktif berakhir.");
        }

        $buktiPath = null;
        if ($request->hasFile('bukti_pembayaran')) {
            $buktiPath = $request->file('bukti_pembayaran')->store('pembayaran/bukti', 'public');
        }

        // Penentuan masa akses paket (12 bulan):
        // Jika guru memperpanjang sebelum masa aktif paket semester terkait berakhir,
        // masa akses baru dimulai setelah masa aktif paket tersebut sebelumnya berakhir.
        $latestEndDate = $user->getLatestSubscriptionEndDate($paket->semester_id);
        if ($latestEndDate && $latestEndDate->gte(Carbon::today())) {
            $tanggalMulai = $latestEndDate->copy()->addDay()->toDateString();
            $tanggalBerakhir = Carbon::parse($tanggalMulai)->addMonths($paket->durasi_bulan ?? 12)->toDateString();
        } else {
            $tanggalMulai = Carbon::today()->toDateString();
            $tanggalBerakhir = Carbon::today()->addMonths($paket->durasi_bulan ?? 12)->toDateString();
        }

        $langganan = Langganan::create([
            'user_id' => $user->id,
            'paket_langganan_id' => $paket->id,
            'tanggal_mulai' => $tanggalMulai,
            'tanggal_berakhir' => $tanggalBerakhir,
            'status' => Langganan::STATUS_AKTIF,
        ]);

        Pembayaran::create([
            'langganan_id' => $langganan->id,
            'metode_pembayaran' => $request->input('metode_pembayaran') ?: 'Otomatis',
            'jumlah' => $paket->harga,
            'tanggal_pembayaran' => now(),
            'bukti_pembayaran' => $buktiPath,
            'status' => Pembayaran::STATUS_MENUNGGU,
        ]);

        return redirect()
            ->route('guru.langganan.index')
            ->with('success', "Pesanan {$paket->nama} berhasil dibuat. Akses materi akan otomatis aktif setelah pembayaran selesai.");
    }
}

