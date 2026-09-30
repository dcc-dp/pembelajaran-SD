<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\PaketLangganan;
use App\Models\Semester;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class PaketLanggananController extends Controller
{
    /**
     * Menampilkan daftar paket langganan.
     */
    public function index(Request $request)
    {
        $paketLangganans = PaketLangganan::with(['kelas', 'semester'])
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('nama', 'like', '%' . $request->search . '%');
            })
            ->when($request->filled('kelas_id'), function ($query) use ($request) {
                $query->where('kelas_id', $request->kelas_id);
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

        $kelas = Kelas::aktif()->orderBy('urutan')->get();
        $semesters = Semester::aktif()->orderBy('urutan')->get();

        return view('admin.paket-langganan.index', compact('paketLangganans', 'kelas', 'semesters'));
    }

    /**
     * Menampilkan form tambah paket.
     */
    public function create()
    {
        $kelas = Kelas::aktif()
            ->orderBy('urutan')
            ->get();

        $semesters = Semester::aktif()
            ->orderBy('urutan')
            ->get();

        return view('admin.paket-langganan.create', compact(
            'kelas',
            'semesters'
        ));
    }

    /**
     * Menyimpan paket langganan baru.
     */
    public function store(Request $request)
    {
        $validated = $this->validasiData($request);

        PaketLangganan::create($validated);

        return redirect()
            ->route('admin.paket-langganan.index')
            ->with('success', 'Paket langganan berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail paket.
     */
    public function show(PaketLangganan $paketLangganan)
    {
        $paketLangganan->load([
            'kelas',
            'semester',
            'langganans.user',
        ]);

        return view(
            'admin.paket-langganan.show',
            compact('paketLangganan')
        );
    }

    /**
     * Menampilkan form edit paket.
     */
    public function edit(PaketLangganan $paketLangganan)
    {
        $kelas = Kelas::aktif()
            ->orderBy('urutan')
            ->get();

        $semesters = Semester::aktif()
            ->orderBy('urutan')
            ->get();

        return view('admin.paket-langganan.edit', compact(
            'paketLangganan',
            'kelas',
            'semesters'
        ));
    }

    /**
     * Memperbarui paket langganan.
     */
    public function update(Request $request, PaketLangganan $paketLangganan)
    {
        $validated = $this->validasiData($request);

        $paketLangganan->update($validated);

        return redirect()
            ->route('admin.paket-langganan.index')
            ->with('success', 'Paket langganan berhasil diperbarui.');
    }

    /**
     * Menghapus paket langganan.
     */
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

    /**
     * Memvalidasi request data paket langganan.
     */
    private function validasiData(Request $request): array
    {
        return $request->validate([
            'kelas_id' => ['required', 'exists:kelas,id'],
            'semester_id' => ['nullable', 'exists:semesters,id'],
            'nama' => ['required', 'string', 'max:100'],
            'deskripsi' => ['nullable', 'string'],
            'harga' => ['required', 'numeric', 'min:0'],
            'durasi_bulan' => ['required', 'integer', 'min:1'],
            'status' => ['required', 'in:aktif,tidak_aktif'],
        ]);
    }
}
