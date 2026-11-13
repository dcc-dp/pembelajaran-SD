<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\PaketLangganan;

class PaketLanggananController extends Controller
{
    public function index()
    {
        $paketLangganans = PaketLangganan::aktif()
            ->with(['semester'])
            ->orderBy('semester_id')
            ->get();

        return view('guest.paket-langganan.index', compact('paketLangganans'));
    }
}
