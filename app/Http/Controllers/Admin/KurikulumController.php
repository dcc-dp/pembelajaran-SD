<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kurikulum;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class KurikulumController extends Controller
{

    public function index(Request $request)
    {
        $kurikulums = Kurikulum::when($request->filled('search'), function ($query) use ($request) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.kurikulum.index', compact('kurikulums'));
    }

  
    public function create()
    {
        return view('admin.kurikulum.create');
    }

    
    public function store(Request $request)
    {
        $validated = $this->validasiData($request);

        Kurikulum::create($validated);

        return redirect()
            ->route('admin.kurikulum.index')
            ->with('success', 'Kurikulum berhasil ditambahkan.');
    }

   
    public function show(Kurikulum $kurikulum)
    {
        return view('admin.kurikulum.show', compact('kurikulum'));
    }

   
    public function edit(Kurikulum $kurikulum)
    {
        return view('admin.kurikulum.edit', compact('kurikulum'));
    }

    
    public function update(Request $request, Kurikulum $kurikulum)
    {
        $validated = $this->validasiData($request);

        $kurikulum->update($validated);

        return redirect()
            ->route('admin.kurikulum.index')
            ->with('success', 'Kurikulum berhasil diperbarui.');
    }

   
    public function destroy(Kurikulum $kurikulum)
    {
        try {
            $kurikulum->delete();

            return redirect()
                ->route('admin.kurikulum.index')
                ->with('success', 'Kurikulum berhasil dihapus.');
        } catch (QueryException $e) {
            return redirect()
                ->route('admin.kurikulum.index')
                ->with('danger', 'Kurikulum tidak dapat dihapus karena sedang digunakan oleh data lain.');
        }
    }

    
    private function validasiData(Request $request): array
    {
        return $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'deskripsi' => ['nullable', 'string'],
            'status' => ['required', 'in:aktif,tidak_aktif'],
        ]);
    }
}
