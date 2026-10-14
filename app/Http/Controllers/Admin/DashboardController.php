<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Langganan;
use App\Models\Repository;
use App\Models\User;

class DashboardController extends Controller
{
    // Menampilkan dashboard admin beserta data statistik dinamis
     
    public function index()
    {
        $totalGuru = User::role('Guru')->count();

        $totalMateri = Repository::dipublikasikan()->count();

        $totalLanggananAktif = Langganan::where('status', 'aktif')->count();

        $totalSekolah = User::role('Guru')
            ->whereNotNull('nama_sekolah')
            ->where('nama_sekolah', '!=', '')
            ->distinct()
            ->count('nama_sekolah');

        return view('admin.dashboard', compact(
            'totalGuru',
            'totalMateri',
            'totalLanggananAktif',
            'totalSekolah'
        ));
    }
}
