<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Semester;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SemesterController extends Controller
{
    /**
     * Menampilkan daftar semester.
     */
    public function index(Request $request)
    {
        $semesters = Semester::when($request->filled('search'), function ($query) use ($request) {
                $query->where('nama', 'like', '%' . $request->search . '%');
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->orderBy('urutan', 'asc')
            ->paginate(10)
            ->withQueryString();

        return view('admin.semester.index', compact('semesters'));
    }

    /**
     * Menampilkan form tambah semester.
     */
    public function create()
    {
        return view('admin.semester.create');
    }

    /**
     * Menyimpan data semester baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:30', 'unique:semesters,nama'],
            'urutan' => ['required', 'integer', 'min:1'],
            'status' => ['required', 'in:aktif,tidak_aktif'],
        ]);

        Semester::create($validated);

        return redirect()
            ->route('admin.semester.index')
            ->with('success', 'Semester berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail data semester.
     */
    public function show(Semester $semester)
    {
        return view('admin.semester.show', compact('semester'));
    }

    /**
     * Menampilkan form edit semester.
     */
    public function edit(Semester $semester)
    {
        return view('admin.semester.edit', compact('semester'));
    }

    /**
     * Memperbarui data semester.
     */
    public function update(Request $request, Semester $semester)
    {
        $validated = $request->validate([
            'nama' => [
                'required',
                'string',
                'max:30',
                Rule::unique('semesters', 'nama')->ignore($semester->id),
            ],
            'urutan' => ['required', 'integer', 'min:1'],
            'status' => ['required', 'in:aktif,tidak_aktif'],
        ]);

        $semester->update($validated);

        return redirect()
            ->route('admin.semester.index')
            ->with('success', 'Semester berhasil diperbarui.');
    }

    /**
     * Menghapus data semester.
     */
    public function destroy(Semester $semester)
    {
        try {
            $semester->delete();

            return redirect()
                ->route('admin.semester.index')
                ->with('success', 'Semester berhasil dihapus.');
        } catch (QueryException $e) {
            return redirect()
                ->route('admin.semester.index')
                ->with('danger', 'Semester tidak dapat dihapus karena sedang digunakan oleh data lain.');
        }
    }
}
