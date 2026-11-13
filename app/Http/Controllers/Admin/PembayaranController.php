<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Langganan;
use App\Models\Pembayaran;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PembayaranController extends Controller
{
    /**
     * Menampilkan daftar transaksi pembayaran langganan guru untuk diverifikasi.
     */
    public function index(Request $request): View
    {
        $query = Pembayaran::with(['langganan.user', 'langganan.paketLangganan.semester'])
            ->when($request->filled('search'), function ($q) use ($request) {
                $search = $request->search;
                $q->whereHas('langganan.user', function ($userQuery) use ($search) {
                    $userQuery->where('nama', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('status'), function ($q) use ($request) {
                $q->where('status', $request->status);
            });

        $pembayarans = $query->latest('tanggal_pembayaran')->paginate(15)->withQueryString();

        $totalMenunggu = Pembayaran::where('status', Pembayaran::STATUS_MENUNGGU)->count();
        $totalBerhasil = Pembayaran::where('status', Pembayaran::STATUS_BERHASIL)->count();
        $totalGagal = Pembayaran::where('status', Pembayaran::STATUS_GAGAL)->count();

        return view('admin.pembayaran.index', [
            'pembayarans' => $pembayarans,
            'totalMenunggu' => $totalMenunggu,
            'totalBerhasil' => $totalBerhasil,
            'totalGagal' => $totalGagal,
        ]);
    }

    /**
     * Memverifikasi pembayaran guru (mengaktifkan akses paket selama masa aktif).
     * Jika diperpanjang sebelum masa aktif berakhir, masa akses baru dimulai setelah masa aktif paket semester tersebut berakhir.
     */
    public function verifikasi(Pembayaran $pembayaran): RedirectResponse
    {
        $langganan = $pembayaran->langganan;
        $user = $langganan->user;
        $paket = $langganan->paketLangganan;

        // Cari tanggal berakhir langganan aktif sebelumnya untuk semester paket ini
        $previousLatestEnd = $user->langganans()
            ->where('id', '!=', $langganan->id)
            ->where('status', Langganan::STATUS_AKTIF)
            ->whereHas('pembayarans', fn($q) => $q->where('status', Pembayaran::STATUS_BERHASIL))
            ->whereHas('paketLangganan', function ($q) use ($paket) {
                if ($paket && $paket->semester_id) {
                    $q->where('semester_id', $paket->semester_id);
                }
            })
            ->whereDate('tanggal_berakhir', '>=', Carbon::today())
            ->max('tanggal_berakhir');

        $durasi = $paket->durasi_bulan ?? 12;

        if ($previousLatestEnd) {
            // Perpanjangan sebelum masa aktif berakhir:
            // Masa akses baru dimulai tepat setelah masa akses sebelumnya berakhir.
            $tanggalMulai = Carbon::parse($previousLatestEnd)->addDay()->toDateString();
            $tanggalBerakhir = Carbon::parse($tanggalMulai)->addMonths($durasi)->toDateString();
        } else {
            // Langganan baru atau masa langganan sebelumnya telah habis
            $tanggalMulai = Carbon::today()->toDateString();
            $tanggalBerakhir = Carbon::today()->addMonths($durasi)->toDateString();
        }

        // Update langganan
        $langganan->update([
            'tanggal_mulai' => $tanggalMulai,
            'tanggal_berakhir' => $tanggalBerakhir,
            'status' => Langganan::STATUS_AKTIF,
        ]);

        // Tandai pembayaran berhasil/diverifikasi
        $pembayaran->update([
            'status' => Pembayaran::STATUS_BERHASIL,
        ]);

        return back()->with('success', "Pembayaran dari guru {$user->nama} ({$paket?->nama}) berhasil diverifikasi. Akses aktif dari {$tanggalMulai} hingga {$tanggalBerakhir}.");
    }

    /**
     * Menolak pembayaran.
     */
    public function tolak(Request $request, Pembayaran $pembayaran): RedirectResponse
    {
        $pembayaran->update([
            'status' => Pembayaran::STATUS_GAGAL,
        ]);

        $pembayaran->langganan->update([
            'status' => Langganan::STATUS_DIBATALKAN,
        ]);

        return back()->with('success', 'Pembayaran telah ditolak dan status langganan dibatalkan.');
    }
}

