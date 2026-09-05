<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisDokumen;
use App\Models\Kelas;
use App\Models\Kurikulum;
use App\Models\MataPelajaran;
use App\Models\Repository;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RepositoryController extends Controller
{
    /**
     * Menampilkan daftar repository dokumen pembelajaran.
     */
    public function index(Request $request)
    {
        $repositories = Repository::with([
            'kurikulum',
            'semester',
            'kelas',
            'mataPelajaran',
            'jenisDokumen'
        ])
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where('judul', 'like', '%' . $request->search . '%');
            })
            ->when($request->filled('kurikulum_id'), function ($query) use ($request) {
                $query->where('kurikulum_id', $request->kurikulum_id);
            })
            ->when($request->filled('semester_id'), function ($query) use ($request) {
                $query->where('semester_id', $request->semester_id);
            })
            ->when($request->filled('kelas_id'), function ($query) use ($request) {
                $query->where('kelas_id', $request->kelas_id);
            })
            ->when($request->filled('mata_pelajaran_id'), function ($query) use ($request) {
                $query->where('mata_pelajaran_id', $request->mata_pelajaran_id);
            })
            ->when($request->filled('jenis_dokumen_id'), function ($query) use ($request) {
                $query->where('jenis_dokumen_id', $request->jenis_dokumen_id);
            })
            ->when($request->filled('akses'), function ($query) use ($request) {
                $query->where('akses', $request->akses);
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $kurikulums = Kurikulum::where('status', 'aktif')->orderBy('nama')->get();
        $semesters = Semester::where('status', 'aktif')->orderBy('urutan')->get();
        $kelas = Kelas::where('status', 'aktif')->orderBy('urutan')->get();
        $mataPelajarans = MataPelajaran::where('status', 'aktif')->orderBy('urutan')->get();
        $jenisDokumens = JenisDokumen::where('status', 'aktif')->orderBy('urutan')->get();

        return view('admin.repository.index', compact(
            'repositories',
            'kurikulums',
            'semesters',
            'kelas',
            'mataPelajarans',
            'jenisDokumens'
        ));
    }

    /**
     * Menampilkan formulir tambah repository.
     */
    public function create()
    {
        $kurikulums = Kurikulum::where('status', 'aktif')->orderBy('nama')->get();
        $semesters = Semester::where('status', 'aktif')->orderBy('urutan')->get();
        $kelas = Kelas::where('status', 'aktif')->orderBy('urutan')->get();
        $mataPelajarans = MataPelajaran::where('status', 'aktif')->orderBy('urutan')->get();
        $jenisDokumens = JenisDokumen::where('status', 'aktif')->orderBy('urutan')->get();

        return view('admin.repository.create', compact(
            'kurikulums',
            'semesters',
            'kelas',
            'mataPelajarans',
            'jenisDokumens'
        ));
    }

    /**
     * Menyimpan data repository baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kurikulum_id' => ['required', 'exists:kurikulums,id'],
            'semester_id' => ['required', 'exists:semesters,id'],
            'kelas_id' => ['required', 'exists:kelas,id'],
            'mata_pelajaran_id' => ['required', 'exists:mata_pelajarans,id'],
            'jenis_dokumen_id' => ['required', 'exists:jenis_dokumens,id'],
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'file' => ['required', 'file', 'mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,zip,rar', 'max:51200'],
            'akses' => ['required', 'in:gratis,premium'],
            'status' => ['required', 'in:draft,dipublikasikan,diarsipkan'],
        ], [
            'kurikulum_id.required' => 'Silakan pilih kurikulum.',
            'semester_id.required' => 'Silakan pilih semester.',
            'kelas_id.required' => 'Silakan pilih kelas.',
            'mata_pelajaran_id.required' => 'Silakan pilih mata pelajaran.',
            'jenis_dokumen_id.required' => 'Silakan pilih jenis dokumen.',
            'judul.required' => 'Judul repository wajib diisi.',
            'file.required' => 'File dokumen wajib diunggah.',
            'file.mimes' => 'Format file yang diperbolehkan: PDF, DOC, DOCX, PPT, PPTX, XLS, XLSX, ZIP, atau RAR.',
            'file.max' => 'Ukuran file dokumen maksimal 50 MB.',
            'akses.required' => 'Silakan pilih tipe akses.',
            'status.required' => 'Silakan pilih status publikasi.',
        ]);

        $uploadedFile = $request->file('file');
        $namaFile = $uploadedFile->getClientOriginalName();
        $tipeFile = strtolower($uploadedFile->getClientOriginalExtension());
        $filePath = $uploadedFile->store('repositories', 'public');

        Repository::create([
            'kurikulum_id' => $validated['kurikulum_id'],
            'semester_id' => $validated['semester_id'],
            'kelas_id' => $validated['kelas_id'],
            'mata_pelajaran_id' => $validated['mata_pelajaran_id'],
            'jenis_dokumen_id' => $validated['jenis_dokumen_id'],
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'nama_file' => $namaFile,
            'file' => $filePath,
            'tipe_file' => $tipeFile,
            'akses' => $validated['akses'],
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('admin.repository.index')
            ->with('success', 'Repository berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail informasi repository dokumen.
     */
    public function show(string $id)
    {
        $repository = Repository::with([
            'kurikulum',
            'semester',
            'kelas',
            'mataPelajaran',
            'jenisDokumen'
        ])->findOrFail($id);

        return view('admin.repository.show', compact('repository'));
    }

    /**
     * Mengunduh file dokumen repository.
     */
    public function download(string $id)
    {
        $repository = Repository::findOrFail($id);

        if (!$repository->file || !Storage::disk('public')->exists($repository->file)) {
            return back()->with('error', 'File dokumen tidak ditemukan di penyimpanan server.');
        }

        return Storage::disk('public')->download($repository->file, $repository->nama_file);
    }

    /**
     * Menampilkan formulir edit repository.
     */
    public function edit(string $id)
    {
        $repository = Repository::findOrFail($id);

        $kurikulums = Kurikulum::where('status', 'aktif')->orderBy('nama')->get();
        $semesters = Semester::where('status', 'aktif')->orderBy('urutan')->get();
        $kelas = Kelas::where('status', 'aktif')->orderBy('urutan')->get();
        $mataPelajarans = MataPelajaran::where('status', 'aktif')->orderBy('urutan')->get();
        $jenisDokumens = JenisDokumen::where('status', 'aktif')->orderBy('urutan')->get();

        return view('admin.repository.edit', compact(
            'repository',
            'kurikulums',
            'semesters',
            'kelas',
            'mataPelajarans',
            'jenisDokumens'
        ));
    }

    /**
     * Memperbarui data repository di database.
     */
    public function update(Request $request, string $id)
    {
        $repository = Repository::findOrFail($id);

        $validated = $request->validate([
            'kurikulum_id' => ['required', 'exists:kurikulums,id'],
            'semester_id' => ['required', 'exists:semesters,id'],
            'kelas_id' => ['required', 'exists:kelas,id'],
            'mata_pelajaran_id' => ['required', 'exists:mata_pelajarans,id'],
            'jenis_dokumen_id' => ['required', 'exists:jenis_dokumens,id'],
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'file' => ['nullable', 'file', 'mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,zip,rar', 'max:51200'],
            'akses' => ['required', 'in:gratis,premium'],
            'status' => ['required', 'in:draft,dipublikasikan,diarsipkan'],
        ], [
            'kurikulum_id.required' => 'Silakan pilih kurikulum.',
            'semester_id.required' => 'Silakan pilih semester.',
            'kelas_id.required' => 'Silakan pilih kelas.',
            'mata_pelajaran_id.required' => 'Silakan pilih mata pelajaran.',
            'jenis_dokumen_id.required' => 'Silakan pilih jenis dokumen.',
            'judul.required' => 'Judul repository wajib diisi.',
            'file.mimes' => 'Format file yang diperbolehkan: PDF, DOC, DOCX, PPT, PPTX, XLS, XLSX, ZIP, atau RAR.',
            'file.max' => 'Ukuran file dokumen maksimal 50 MB.',
            'akses.required' => 'Silakan pilih tipe akses.',
            'status.required' => 'Silakan pilih status publikasi.',
        ]);

        $dataToUpdate = [
            'kurikulum_id' => $validated['kurikulum_id'],
            'semester_id' => $validated['semester_id'],
            'kelas_id' => $validated['kelas_id'],
            'mata_pelajaran_id' => $validated['mata_pelajaran_id'],
            'jenis_dokumen_id' => $validated['jenis_dokumen_id'],
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'akses' => $validated['akses'],
            'status' => $validated['status'],
        ];

        if ($request->hasFile('file')) {
            if ($repository->file && Storage::disk('public')->exists($repository->file)) {
                Storage::disk('public')->delete($repository->file);
            }

            $uploadedFile = $request->file('file');
            $dataToUpdate['nama_file'] = $uploadedFile->getClientOriginalName();
            $dataToUpdate['tipe_file'] = strtolower($uploadedFile->getClientOriginalExtension());
            $dataToUpdate['file'] = $uploadedFile->store('repositories', 'public');
        }

        $repository->update($dataToUpdate);

        return redirect()
            ->route('admin.repository.index')
            ->with('success', 'Repository berhasil diperbarui.');
    }

    /**
     * Menghapus repository dan file fisik terkait dari penyimpanan.
     */
    public function destroy(string $id)
    {
        $repository = Repository::findOrFail($id);

        if ($repository->file && Storage::disk('public')->exists($repository->file)) {
            Storage::disk('public')->delete($repository->file);
        }

        $repository->delete();

        return redirect()
            ->route('admin.repository.index')
            ->with('success', 'Repository berhasil dihapus.');
    }
}
