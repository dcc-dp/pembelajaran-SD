<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class FaqController extends Controller
{
 
    public function index(Request $request)
    {
        $faqs = Faq::when($request->filled('search'), function ($query) use ($request) {
            $query->where('pertanyaan', 'like', '%' . $request->search . '%');
        })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->orderBy('urutan', 'asc')
            ->orderBy('id', 'asc')
            ->paginate(10)
            ->withQueryString();

        return view('admin.faq.index', compact('faqs'));
    }

 
    public function create()
    {
        return view('admin.faq.create');
    }

 
    public function store(Request $request)
    {
        $validated = $this->validasiData($request);

        Faq::create($validated);

        return redirect()
            ->route('admin.faq.index')
            ->with('success', 'FAQ berhasil ditambahkan.');
    }

   
    public function show(Faq $faq)
    {
        return view('admin.faq.show', compact('faq'));
    }

  
    public function edit(Faq $faq)
    {
        return view('admin.faq.edit', compact('faq'));
    }

    
    public function update(Request $request, Faq $faq)
    {
        $validated = $this->validasiData($request);

        $faq->update($validated);

        return redirect()
            ->route('admin.faq.index')
            ->with('success', 'FAQ berhasil diperbarui.');
    }

    
    public function destroy(Faq $faq)
    {
        try {
            $faq->delete();

            return redirect()
                ->route('admin.faq.index')
                ->with('success', 'FAQ berhasil dihapus.');
        } catch (QueryException $e) {
            return redirect()
                ->route('admin.faq.index')
                ->with('danger', 'FAQ tidak dapat dihapus karena sedang digunakan oleh data lain.');
        }
    }

  
    private function validasiData(Request $request): array
    {
        return $request->validate([
            'pertanyaan' => ['required', 'string', 'max:255'],
            'jawaban' => ['required', 'string'],
            'urutan' => ['required', 'integer', 'min:0'],
            'status' => ['required', 'in:aktif,tidak_aktif'],
        ]);
    }
}
