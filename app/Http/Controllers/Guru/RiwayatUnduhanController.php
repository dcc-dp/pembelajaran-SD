<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\JenisDokumen;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\RiwayatUnduhan;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RiwayatUnduhanController extends Controller
{
    public function index(Request $request): View
    {
        $query = RiwayatUnduhan::with([
            'repository.semester',
            'repository.kelas',
            'repository.mataPelajaran',
            'repository.jenisDokumen',
        ])
            ->where('user_id', $request->user()->id);

        // Pencarian judul dokumen
        if ($request->filled('search')) {
            $search = $request->input('search');

            $query->whereHas('repository', function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%");
            });
        }

        // Filter semester
        if ($request->filled('semester_id')) {
            $query->whereHas('repository', function ($q) use ($request) {
                $q->where('semester_id', $request->semester_id);
            });
        }

        // Filter kelas
        if ($request->filled('kelas_id')) {
            $query->whereHas('repository', function ($q) use ($request) {
                $q->where('kelas_id', $request->kelas_id);
            });
        }

        // Filter mata pelajaran
        if ($request->filled('mata_pelajaran_id')) {
            $query->whereHas('repository', function ($q) use ($request) {
                $q->where('mata_pelajaran_id', $request->mata_pelajaran_id);
            });
        }

        // Filter jenis dokumen
        if ($request->filled('jenis_dokumen_id')) {
            $query->whereHas('repository', function ($q) use ($request) {
                $q->where('jenis_dokumen_id', $request->jenis_dokumen_id);
            });
        }

        $riwayatUnduhan = $query
            ->orderByDesc('created_at')
            ->paginate(5)
            ->withQueryString();

        return view('guru.riwayat_download.index', [
            'riwayatUnduhan' => $riwayatUnduhan,
            'semesters' => Semester::aktif()->orderBy('urutan')->get(),
            'kelas' => Kelas::aktif()->orderBy('urutan')->get(),
            'mataPelajarans' => MataPelajaran::aktif()->orderBy('urutan')->get(),
            'jenisDokumens' => JenisDokumen::aktif()->orderBy('urutan')->get(),
        ]);
    }
}
