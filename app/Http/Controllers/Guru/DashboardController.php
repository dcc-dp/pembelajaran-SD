<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\PaketLangganan;
use App\Models\Repository;
use App\Models\RiwayatUnduhan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard untuk Guru.
     */
    public function index(Request $request): View
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        $paketSem1 = PaketLangganan::getPaketSemester1();
        $paketSem2 = PaketLangganan::getPaketSemester2();

        $activeSubSem1 = $paketSem1 ? $user->getActiveSubscription($paketSem1->semester_id) : null;
        $activeSubSem2 = $paketSem2 ? $user->getActiveSubscription($paketSem2->semester_id) : null;

        $hasAnyActiveSub = $user->hasActiveSubscription();

        // Cari tanggal berakhir paling jauh untuk info ringkas
        $latestEndSem1 = $paketSem1 ? $user->getLatestSubscriptionEndDate($paketSem1->semester_id) : null;
        $latestEndSem2 = $paketSem2 ? $user->getLatestSubscriptionEndDate($paketSem2->semester_id) : null;

        $maxEndDate = collect([$latestEndSem1, $latestEndSem2])->filter()->max();
        $sisaHari = $maxEndDate ? max(0, Carbon::today()->diffInDays($maxEndDate, false)) : 0;

        $totalRepository = Repository::where('status', 'dipublikasikan')->count();
        $totalUnduhan = RiwayatUnduhan::where('user_id', $user->id)->count();

        return view('guru.dashboard.index', [
            'user' => $user,
            'hasAnyActiveSub' => $hasAnyActiveSub,
            'activeSubSem1' => $activeSubSem1,
            'activeSubSem2' => $activeSubSem2,
            'latestEndSem1' => $latestEndSem1,
            'latestEndSem2' => $latestEndSem2,
            'sisaHari' => $sisaHari,
            'totalRepository' => $totalRepository,
            'totalUnduhan' => $totalUnduhan,
        ]);
    }
}
