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
    
    public function index()
    {
        $totalMateri = Repository::dipublikasikan()->count();
        $totalGuru = User::role('Guru')->count();
        $totalJenisDokumen = JenisDokumen::count();
        $totalMataPelajaran = MataPelajaran::count();
        $totalKurikulum = Kurikulum::count();

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
            'faqs'
        ));
    }
}
