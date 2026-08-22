<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class MataPelajaranController extends Controller
{
    /**
     * Menampilkan daftar mata pelajaran.
     */
    public function index()
    {
        $mataPelajarans = MataPelajaran::orderBy('urutan')->get();

        return view('admin.mata-pelajaran.index', compact('mataPelajarans'));
    }

    /**
     * Menampilkan form tambah data.
     */
    public function create()
    {
        return view('admin.mata-pelajaran.create');
    }

    /**
     * Menyimpan data baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'urutan' => 'required|integer|min:1',
            'status' => 'required|in:aktif,tidak_aktif',
        ]);

        MataPelajaran::create($validated);

        return redirect()
            ->route('admin.mata-pelajaran.index')
            ->with('success', 'Mata pelajaran berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit.
     */
    public function edit(MataPelajaran $mataPelajaran)
    {
        return view('admin.mata-pelajaran.edit', compact('mataPelajaran'));
    }

    /**
     * Mengupdate data.
     */
    public function update(Request $request, MataPelajaran $mataPelajaran)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'urutan' => 'required|integer|min:1',
            'status' => 'required|in:aktif,tidak_aktif',
        ]);

        $mataPelajaran->update($validated);

        return redirect()
            ->route('admin.mata-pelajaran.index')
            ->with('success', 'Mata pelajaran berhasil diperbarui.');
    }

    /**
     * Menghapus data.
     */
    public function destroy(MataPelajaran $mataPelajaran)
    {
        $mataPelajaran->delete();

        return redirect()
            ->route('admin.mata-pelajaran.index')
            ->with('danger', 'Mata pelajaran berhasil dihapus.');
    }
}
