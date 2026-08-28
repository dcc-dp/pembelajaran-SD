<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriDokumen;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KategoriDokumenController extends Controller
{
    /**
     * Menampilkan daftar kategori dokumen.
     */
    public function index()
    {
        $kategoriDokumens = KategoriDokumen::orderBy('urutan')->get();

        return view('admin.kategori-dokumen.index', compact('kategoriDokumens'));
    }

    /**
     * Menampilkan form tambah kategori dokumen.
     */
    public function create()
    {
        return view('admin.kategori-dokumen.create');
    }

    /**
     * Menyimpan kategori dokumen baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100|unique:kategori_dokumens,nama',
            'deskripsi' => 'nullable|string',
            'urutan' => 'required|integer|min:1',
            'status' => 'required|in:aktif,tidak_aktif',
        ]);

        KategoriDokumen::create($validated);

        return redirect()
            ->route('admin.kategori-dokumen.index')
            ->with('success', 'Kategori dokumen berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit kategori dokumen.
     */
    public function edit(KategoriDokumen $kategoriDokumen)
    {
        return view(
            'admin.kategori-dokumen.edit',
            compact('kategoriDokumen')
        );
    }

    /**
     * Mengupdate kategori dokumen.
     */
    public function update(
        Request $request,
        KategoriDokumen $kategoriDokumen
    ) {
        $validated = $request->validate([
            'nama' => [
                'required',
                'string',
                'max:100',
                Rule::unique('kategori_dokumens', 'nama')
                    ->ignore($kategoriDokumen->id),
            ],
            'deskripsi' => 'nullable|string',
            'urutan' => 'required|integer|min:1',
            'status' => 'required|in:aktif,tidak_aktif',
        ]);

        $kategoriDokumen->update($validated);

        return redirect()
            ->route('admin.kategori-dokumen.index')
            ->with('success', 'Kategori dokumen berhasil diperbarui.');
    }

    /**
     * Menghapus kategori dokumen.
     */
    public function destroy(KategoriDokumen $kategoriDokumen)
    {
        $kategoriDokumen->delete();

        return redirect()
            ->route('admin.kategori-dokumen.index')
            ->with('danger', 'Kategori dokumen berhasil dihapus.');
    }
}