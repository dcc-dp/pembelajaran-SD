<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Repository;
use App\Models\Semester;
use Illuminate\Http\Request;

class PreviewMateriController extends Controller
{
    
    public function index(Request $request)
    {
        $kelasList = Kelas::where('status', 'aktif')->orderBy('urutan')->get();
        $semesterList = Semester::where('status', 'aktif')->orderBy('urutan')->get();
        $mataPelajaranList = MataPelajaran::where('status', 'aktif')->orderBy('urutan')->get();

        $query = Repository::dipublikasikan()
            ->with(['kelas', 'semester', 'mataPelajaran', 'jenisDokumen', 'kurikulum'])
            ->latest();

        if ($request->filled('kelas_id')) {
            $query->where('kelas_id', $request->kelas_id);
        }

        if ($request->filled('semester_id')) {
            $query->where('semester_id', $request->semester_id);
        }

        if ($request->filled('mata_pelajaran_id')) {
            $query->where('mata_pelajaran_id', $request->mata_pelajaran_id);
        }

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $repositories = $query->paginate(9)->withQueryString();

        return view('guest.preview-materi.index', compact(
            'repositories',
            'kelasList',
            'semesterList',
            'mataPelajaranList'
        ));
    }

  
    public function show(Request $request, $id = null)
    {
        $document = null;

        if ($id) {
            $document = Repository::dipublikasikan()
                ->with(['kelas', 'semester', 'mataPelajaran', 'jenisDokumen', 'kurikulum'])
                ->find($id);
        }

        if (!$document) {
            $document = Repository::dipublikasikan()
                ->with(['kelas', 'semester', 'mataPelajaran', 'jenisDokumen', 'kurikulum'])
                ->latest()
                ->first();
        }

        $materiLainnya = collect();
        if ($document) {
            $materiLainnya = Repository::dipublikasikan()
                ->with(['kelas', 'semester', 'mataPelajaran', 'jenisDokumen'])
                ->where('id', '!=', $document->id)
                ->latest()
                ->take(4)
                ->get();
        }

        return view('guest.preview-materi.show', compact('document', 'materiLainnya'));
    }
}
