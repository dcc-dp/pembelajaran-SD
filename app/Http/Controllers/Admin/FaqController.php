<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Menampilkan daftar FAQ.
     */
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

    /**
     * Menampilkan form tambah FAQ.
     */
    public function create()
    {
        return view('admin.faq.create');
    }

    /**
     * Menyimpan data FAQ baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pertanyaan' => ['required', 'string', 'max:255'],
            'jawaban' => ['required', 'string'],
            'urutan' => ['required', 'integer', 'min:0'],
            'status' => ['required', 'in:aktif,tidak_aktif'],
        ]);

        Faq::create($validated);

        return redirect()
            ->route('admin.faq.index')
            ->with('success', 'FAQ berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail data FAQ.
     */
    public function show(Faq $faq)
    {
        return view('admin.faq.show', compact('faq'));
    }

    /**
     * Menampilkan form edit FAQ.
     */
    public function edit(Faq $faq)
    {
        return view('admin.faq.edit', compact('faq'));
    }

    /**
     * Memperbarui data FAQ.
     */
    public function update(Request $request, Faq $faq)
    {
        $validated = $request->validate([
            'pertanyaan' => ['required', 'string', 'max:255'],
            'jawaban' => ['required', 'string'],
            'urutan' => ['required', 'integer', 'min:0'],
            'status' => ['required', 'in:aktif,tidak_aktif'],
        ]);

        $faq->update($validated);

        return redirect()
            ->route('admin.faq.index')
            ->with('success', 'FAQ berhasil diperbarui.');
    }

    /**
     * Menghapus data FAQ.
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()
            ->route('admin.faq.index')
            ->with('success', 'FAQ berhasil dihapus.');
    }
}
