<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard untuk Guru.
     */
    public function index(): View
    {
        return view('guru.dashboard.index');
    }
}
