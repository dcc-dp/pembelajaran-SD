<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\JenisDokumen;
use App\Models\Kurikulum;
use App\Models\MataPelajaran;
use App\Models\PaketLangganan;
use App\Models\Repository;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman beranda guest dengan data dinamis dari database.
     */
    public function index()
    {
        // 1. Data Statistik Riil
        $totalMateri = Repository::dipublikasikan()->count();
        $totalGuru = User::role('Guru')->count();
        $totalJenisDokumen = JenisDokumen::count();
        $totalMataPelajaran = MataPelajaran::count();
        $totalKurikulum = Kurikulum::count();

        // 2. Data Preview Materi / Perangkat Ajar Terbaru (maksimal 6 dokumen)
        $materiTerbaru = Repository::dipublikasikan()
            ->with(['mataPelajaran', 'kelas', 'jenisDokumen', 'kurikulum', 'semester'])
            ->latest()
            ->take(6)
            ->get();

        // 3. Data Paket Langganan Aktif Pilihan (maksimal 3 paket)
        $paketLangganan = PaketLangganan::aktif()
            ->with(['kelas', 'semester'])
            ->take(3)
            ->get();

        // 4. Data FAQ Populer (maksimal 4 FAQ)
        $faqs = Faq::aktif()
            ->orderBy('urutan')
            ->take(4)
            ->get();

        return view('guest.home.index', compact(
            'totalMateri',
            'totalGuru',
            'totalJenisDokumen',
            'totalMataPelajaran',
            'totalKurikulum',
            'materiTerbaru',
            'paketLangganan',
            'faqs'
        ));
    }
}
