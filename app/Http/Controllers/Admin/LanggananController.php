<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Langganan;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LanggananController extends Controller
{
    /**
     * Menampilkan daftar data langganan guru untuk Admin.
     */
    public function index(Request $request): View
    {
        $query = Langganan::with(['user', 'paketLangganan.semester', 'pembayarans'])
            ->when($request->filled('search'), function ($q) use ($request) {
                $search = $request->search;
                $q->whereHas('user', function ($userQuery) use ($search) {
                    $userQuery->where('nama', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('status'), function ($q) use ($request) {
                $q->where('status', $request->status);
            });

        $langganans = $query->latest()->paginate(15)->withQueryString();

        $totalAktif = Langganan::where('status', Langganan::STATUS_AKTIF)
            ->whereDate('tanggal_mulai', '<=', now())
            ->whereDate('tanggal_berakhir', '>=', now())
            ->where(function ($q) {
                $q->whereHas('pembayarans', fn($p) => $p->where('status', 'berhasil'))
                ->orWhereDoesntHave('pembayarans');
            })
            ->count();

        return view('admin.langganan.index', [
            'langganans' => $langganans,
            'totalAktif' => $totalAktif,
        ]);
    }
}

