<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisDokumen;
use App\Models\KategoriDokumen;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class JenisDokumenController extends Controller
{
    /**
     * Menampilkan daftar jenis dokumen.
     */
    public function index(Request $request)
    {
        $jenisDokumens = JenisDokumen::with('kategoriDokumen')
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('nama', 'like', '%' . $request->search . '%')
                      ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
                });
            })
            ->when($request->filled('kategori'), function ($query) use ($request) {
                $query->where('kategori_dokumen_id', $request->kategori);
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->orderBy('urutan', 'asc')
            ->paginate(10)
            ->withQueryString();

        $kategoriDokumens = KategoriDokumen::orderBy('urutan', 'asc')->get();

        return view('admin.jenis-dokumen.index', compact('jenisDokumens', 'kategoriDokumens'));
    }

    /**
     * Menampilkan form tambah jenis dokumen.
     */
    public function create()
    {
        $kategoriDokumens = KategoriDokumen::where('status', 'aktif')
            ->orderBy('urutan', 'asc')
            ->get();

        return view('admin.jenis-dokumen.create', compact('kategoriDokumens'));
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
                'max:255',
            ],
            'status' => [
                'required',
                'in:aktif,tidak_aktif',
            ],
        ]);

        JenisDokumen::create($validated);

        return redirect()
            ->route('admin.jenis-dokumen.index')
            ->with('success', 'Jenis dokumen berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail jenis dokumen.
     */
    public function show(JenisDokumen $jenisDokumen)
    {
        $jenisDokumen->load(['kategoriDokumen', 'repositories']);

        return view('admin.jenis-dokumen.show', compact('jenisDokumen'));
    }

    /**
     * Menampilkan form edit.
     */
    public function edit(JenisDokumen $jenisDokumen)
    {
        $kategoriDokumens = KategoriDokumen::orderBy('urutan', 'asc')->get();

        return view('admin.jenis-dokumen.edit', compact('jenisDokumen', 'kategoriDokumens'));
    }

    /**
     * Mengupdate jenis dokumen.
     */
    public function update(Request $request, JenisDokumen $jenisDokumen)
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
                'max:255',
            ],
            'status' => [
                'required',
                'in:aktif,tidak_aktif',
            ],
        ]);

        $jenisDokumen->update($validated);

        return redirect()
            ->route('admin.jenis-dokumen.index')
            ->with('success', 'Jenis dokumen berhasil diperbarui.');
    }

    /**
     * Menghapus jenis dokumen.
     */
    public function destroy(JenisDokumen $jenisDokumen)
    {
        try {
            $jenisDokumen->delete();

            return redirect()
                ->route('admin.jenis-dokumen.index')
                ->with('success', 'Jenis dokumen berhasil dihapus.');
        } catch (QueryException $e) {
            return redirect()
                ->route('admin.jenis-dokumen.index')
                ->with('danger', 'Jenis dokumen tidak dapat dihapus karena sedang digunakan oleh data lain.');
        }
    }
}