<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class MataPelajaranController extends Controller
{
    
    public function index()
    {
        $mataPelajarans = MataPelajaran::orderBy('urutan')->get();

        return view('admin.mata-pelajaran.index', compact('mataPelajarans'));
    }

   
    public function create()
    {
        return view('admin.mata-pelajaran.create');
    }

    
    public function store(Request $request)
    {
        $validated = $this->validasiData($request);

        MataPelajaran::create($validated);

        return redirect()
            ->route('admin.mata-pelajaran.index')
            ->with('success', 'Mata pelajaran berhasil ditambahkan.');
    }

   
    public function edit(MataPelajaran $mataPelajaran)
    {
        return view('admin.mata-pelajaran.edit', compact('mataPelajaran'));
    }

    
    public function update(Request $request, MataPelajaran $mataPelajaran)
    {
        $validated = $this->validasiData($request);

        $mataPelajaran->update($validated);

        return redirect()
            ->route('admin.mata-pelajaran.index')
            ->with('success', 'Mata pelajaran berhasil diperbarui.');
    }

    
    public function destroy(MataPelajaran $mataPelajaran)
    {
        try {
            $mataPelajaran->delete();

            return redirect()
                ->route('admin.mata-pelajaran.index')
                ->with('success', 'Mata pelajaran berhasil dihapus.');
        } catch (QueryException $e) {
            return redirect()
                ->route('admin.mata-pelajaran.index')
                ->with('danger', 'Mata pelajaran tidak dapat dihapus karena sedang digunakan oleh data lain.');
        }
    }

   
    private function validasiData(Request $request): array
    {
        return $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'urutan' => ['required', 'integer', 'min:1'],
            'status' => ['required', 'in:aktif,tidak_aktif'],
        ]);
    }
}
