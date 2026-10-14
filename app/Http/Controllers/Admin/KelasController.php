<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KelasController extends Controller
{
   
    public function index(Request $request)
    {
        $kelas = Kelas::when($request->filled('search'), function ($query) use ($request) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->orderBy('urutan', 'asc')
            ->paginate(10)
            ->withQueryString();

        return view('admin.kelas.index', compact('kelas'));
    }

    public function create()
    {
        return view('admin.kelas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:30', 'unique:kelas,nama'],
            'urutan' => ['required', 'integer', 'min:1'],
            'status' => ['required', 'in:aktif,tidak_aktif'],
        ]);

        Kelas::create($validated);

        return redirect()
            ->route('admin.kelas.index')
            ->with('success', 'Kelas berhasil ditambahkan.');
    }

  
    public function show(Kelas $kelas)
    {
        return view('admin.kelas.show', compact('kelas'));
    }

  
    public function edit(Kelas $kelas)
    {
        return view('admin.kelas.edit', compact('kelas'));
    }

  
    public function update(Request $request, Kelas $kelas)
    {
        $validated = $request->validate([
            'nama' => [
                'required',
                'string',
                'max:30',
                Rule::unique('kelas', 'nama')->ignore($kelas->id),
            ],
            'urutan' => ['required', 'integer', 'min:1'],
            'status' => ['required', 'in:aktif,tidak_aktif'],
        ]);

        $kelas->update($validated);

        return redirect()
            ->route('admin.kelas.index')
            ->with('success', 'Kelas berhasil diperbarui.');
    }

  
    public function destroy(Kelas $kelas)
    {
        try {
            $kelas->delete();

            return redirect()
                ->route('admin.kelas.index')
                ->with('success', 'Kelas berhasil dihapus.');
        } catch (QueryException $e) {
            return redirect()
                ->route('admin.kelas.index')
                ->with('danger', 'Kelas tidak dapat dihapus karena sedang digunakan oleh data lain.');
        }
    }
}
