<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Langganan;
use App\Models\Repository;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard admin beserta data statistik dinamis.
     */
    public function index()
    {
        // 1. TOTAL GURU: Menghitung pengguna yang memiliki role 'Guru'
        $totalGuru = User::role('Guru')->count();

        // 2. MATERI: Menghitung data materi/perangkat ajar yang tersedia (dipublikasikan) di repository
        $totalMateri = Repository::where('status', 'dipublikasikan')->count();

        // 3. LANGGANAN AKTIF: Menghitung langganan dengan status 'aktif'
        $totalLanggananAktif = Langganan::where('status', 'aktif')->count();

        // 4. SEKOLAH: Menghitung jumlah sekolah unik yang terdaftar pada guru
        $totalSekolah = User::role('Guru')
            ->whereNotNull('nama_sekolah')
            ->whereRaw("TRIM(nama_sekolah) != ''")
            ->distinct('nama_sekolah')
            ->count('nama_sekolah');

        return view('admin.dashboard', compact(
            'totalGuru',
            'totalMateri',
            'totalLanggananAktif',
            'totalSekolah'
        ));
    }
}
