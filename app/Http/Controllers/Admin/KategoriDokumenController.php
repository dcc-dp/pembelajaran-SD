<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriDokumen;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KategoriDokumenController extends Controller
{
   
    public function index()
    {
        $kategoriDokumens = KategoriDokumen::orderBy('urutan')->get();

        return view(
            'admin.kategori-dokumen.index',
            compact('kategoriDokumens')
        );
    }

 
    public function create()
    {
        return view('admin.kategori-dokumen.create');
    }

 
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:100', 'unique:kategori_dokumens,nama'],
            'deskripsi' => ['nullable', 'string'],
            'urutan' => ['required', 'integer', 'min:1'],
            'status' => ['required', 'in:aktif,tidak_aktif'],
        ]);

        KategoriDokumen::create($validated);

        return redirect()
            ->route('admin.kategori-dokumen.index')
            ->with('success', 'Kategori dokumen berhasil ditambahkan.');
    }


    public function edit(KategoriDokumen $kategoriDokumen)
    {
        return view(
            'admin.kategori-dokumen.edit',
            compact('kategoriDokumen')
        );
    }

  
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
            'deskripsi' => ['nullable', 'string'],
            'urutan' => ['required', 'integer', 'min:1'],
            'status' => ['required', 'in:aktif,tidak_aktif'],
        ]);

        $kategoriDokumen->update($validated);

        return redirect()
            ->route('admin.kategori-dokumen.index')
            ->with('success', 'Kategori dokumen berhasil diperbarui.');
    }

  
    public function destroy(KategoriDokumen $kategoriDokumen)
    {
        try {
            $kategoriDokumen->delete();

            return redirect()
                ->route('admin.kategori-dokumen.index')
                ->with('success', 'Kategori dokumen berhasil dihapus.');
        } catch (QueryException $e) {
            return redirect()
                ->route('admin.kategori-dokumen.index')
                ->with('danger', 'Kategori dokumen tidak dapat dihapus karena sedang digunakan oleh data lain.');
        }
    }
}
