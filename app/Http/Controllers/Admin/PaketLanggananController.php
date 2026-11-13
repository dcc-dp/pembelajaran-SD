<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaketLangganan;
use App\Models\Semester;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class PaketLanggananController extends Controller
{
    public function index(Request $request)
    {
        $paketLangganans = PaketLangganan::with(['semester'])
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('nama', 'like', '%' . $request->search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
            })
            ->when($request->filled('semester_id'), function ($query) use ($request) {
                $query->where('semester_id', $request->semester_id);
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $semesters = Semester::aktif()->orderBy('urutan')->get();

        return view('admin.paket-langganan.index', compact('paketLangganans', 'semesters'));
    }

    public function create()
    {
        $semesters = Semester::aktif()->orderBy('urutan')->get();

        return view('admin.paket-langganan.create', compact('semesters'));
    }

    public function store(Request $request)
    {
        $validated = $this->validasiData($request);

        PaketLangganan::create($validated);

        return redirect()
            ->route('admin.paket-langganan.index')
            ->with('success', 'Paket langganan berhasil ditambahkan.');
    }

    public function show(PaketLangganan $paketLangganan)
    {
        $paketLangganan->load([
            'semester',
            'langganans.user',
            'langganans.pembayarans',
        ]);

        return view(
            'admin.paket-langganan.show',
            compact('paketLangganan')
        );
    }

    public function edit(PaketLangganan $paketLangganan)
    {
        $semesters = Semester::aktif()->orderBy('urutan')->get();

        return view('admin.paket-langganan.edit', compact(
            'paketLangganan',
            'semesters'
        ));
    }

    public function update(Request $request, PaketLangganan $paketLangganan)
    {
        $validated = $this->validasiData($request);

        $paketLangganan->update($validated);

        return redirect()
            ->route('admin.paket-langganan.index')
            ->with('success', 'Paket langganan berhasil diperbarui.');
    }

    public function destroy(PaketLangganan $paketLangganan)
    {
        try {
            $paketLangganan->delete();

            return redirect()
                ->route('admin.paket-langganan.index')
                ->with('success', 'Paket langganan berhasil dihapus.');
        } catch (QueryException $e) {
            return redirect()
                ->route('admin.paket-langganan.index')
                ->with('danger', 'Paket langganan tidak dapat dihapus karena sedang digunakan oleh data lain.');
        }
    }

    private function validasiData(Request $request): array
    {
        return $request->validate([
            'semester_id' => ['required', 'exists:semesters,id'],
            'nama' => ['required', 'string', 'max:100'],
            'deskripsi' => ['nullable', 'string'],
            'harga' => ['required', 'numeric', 'min:0'],
            'durasi_bulan' => ['required', 'integer', 'min:1'],
            'status' => ['required', 'in:aktif,tidak_aktif'],
        ], [
            'semester_id.required' => 'Silakan pilih semester untuk paket ini (Semester 1 atau Semester 2).',
            'semester_id.exists' => 'Semester yang dipilih tidak valid.',
        ]);
    }
}
