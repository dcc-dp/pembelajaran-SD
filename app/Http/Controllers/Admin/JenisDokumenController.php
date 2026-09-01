<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisDokumen;
use App\Models\KategoriDokumen;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JenisDokumenController extends Controller
{
    /**
     * Menampilkan daftar jenis dokumen.
     */
    public function index()
    {
        $jenisDokumens = JenisDokumen::with('kategoriDokumen')
            ->orderBy('urutan')
            ->get();

        return view(
            'admin.jenis-dokumen.index',
            compact('jenisDokumens')
        );
    }


    /**
     * Menampilkan form tambah jenis dokumen.
     */
    public function create()
    {
        $kategoriDokumens = KategoriDokumen::where(
            'status',
            'aktif'
        )
        ->orderBy('urutan')
        ->get();

        return view(
            'admin.jenis-dokumen.create',
            compact('kategoriDokumens')
        );
    }


    /**
     * Menyimpan jenis dokumen baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_dokumen_id' => [
                'required',
                'exists:kategori_dokumens,id',
            ],

            'nama' => [
                'required',
                'string',
                'max:100',
            ],

            'deskripsi' => [
                'nullable',
                'string',
            ],

            'urutan' => [
                'required',
                'integer',
                'min:1',
            ],

            'status' => [
                'required',
                'in:aktif,tidak_aktif',
            ],
        ]);

        JenisDokumen::create($validated);

        return redirect()
            ->route('admin.jenis-dokumen.index')
            ->with(
                'success',
                'Jenis dokumen berhasil ditambahkan.'
            );
    }


    /**
     * Menampilkan detail jenis dokumen.
     */
    public function show(JenisDokumen $jenisDokumen)
    {
        //
    }


    /**
     * Menampilkan form edit.
     */
    public function edit(JenisDokumen $jenisDokumen)
    {
        $kategoriDokumens = KategoriDokumen::orderBy('urutan')
            ->get();

        return view(
            'admin.jenis-dokumen.edit',
            compact(
                'jenisDokumen',
                'kategoriDokumens'
            )
        );
    }


    /**
     * Mengupdate jenis dokumen.
     */
    public function update(
        Request $request,
        JenisDokumen $jenisDokumen
    ) {
        $validated = $request->validate([
            'kategori_dokumen_id' => [
                'required',
                'exists:kategori_dokumens,id',
            ],

            'nama' => [
                'required',
                'string',
                'max:100',
            ],

            'deskripsi' => [
                'nullable',
                'string',
            ],

            'urutan' => [
                'required',
                'integer',
                'min:1',
            ],

            'status' => [
                'required',
                'in:aktif,tidak_aktif',
            ],
        ]);

        $jenisDokumen->update($validated);

        return redirect()
            ->route('admin.jenis-dokumen.index')
            ->with(
                'success',
                'Jenis dokumen berhasil diperbarui.'
            );
    }


    /**
     * Menghapus jenis dokumen.
     */
    public function destroy(JenisDokumen $jenisDokumen)
    {
        $jenisDokumen->delete();

        return redirect()
            ->route('admin.jenis-dokumen.index')
            ->with(
                'success',
                'Jenis dokumen berhasil dihapus.'
            );
    }
}