<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisDokumen;
use App\Models\Kelas;
use App\Models\Kurikulum;
use App\Models\MataPelajaran;
use App\Models\Repository;
use App\Models\Semester;
use Illuminate\Database\QueryException;
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

        return view('admin.repository.index', array_merge([
            'repositories' => $repositories,
        ], $this->dataDropdown()));
    }

    /**
     * Menampilkan formulir tambah repository.
     */
    public function create()
    {
        return view('admin.repository.create', array_merge([], $this->dataDropdown()));
    }

    /**
     * Menyimpan data repository baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $this->validasiData($request, true);

        $data = $validated;
        $uploadedFile = $request->file('file');
        $data['nama_file'] = $uploadedFile->getClientOriginalName();
        $data['tipe_file'] = strtolower($uploadedFile->getClientOriginalExtension());
        $data['file'] = $uploadedFile->store('repositories', 'public');

        Repository::create($data);

        return redirect()
            ->route('admin.repository.index')
            ->with('success', 'Repository berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail informasi repository dokumen.
     */
    public function show(Repository $repository)
    {
        $repository->load([
            'kurikulum',
            'semester',
            'kelas',
            'mataPelajaran',
            'jenisDokumen',
        ]);

        return view('admin.repository.show', compact('repository'));
    }

    /**
     * Mengunduh file dokumen repository.
     */
    public function download(Repository $repository)
    {
        if (!$repository->file || !Storage::disk('public')->exists($repository->file)) {
            return back()->with('danger', 'File dokumen tidak ditemukan di penyimpanan server.');
        }

        return Storage::disk('public')->download($repository->file, $repository->nama_file);
    }

    /**
     * Menampilkan formulir edit repository.
     */
    public function edit(Repository $repository)
    {
        return view('admin.repository.edit', array_merge([
            'repository' => $repository,
        ], $this->dataDropdown()));
    }

    /**
     * Memperbarui data repository di database.
     */
    public function update(Request $request, Repository $repository)
    {
        $validated = $this->validasiData($request, false);

        $data = $validated;

        if ($request->hasFile('file')) {
            if ($repository->file && Storage::disk('public')->exists($repository->file)) {
                Storage::disk('public')->delete($repository->file);
            }

            $uploadedFile = $request->file('file');
            $data['nama_file'] = $uploadedFile->getClientOriginalName();
            $data['tipe_file'] = strtolower($uploadedFile->getClientOriginalExtension());
            $data['file'] = $uploadedFile->store('repositories', 'public');
        } else {
            unset($data['file']);
        }

        $repository->update($data);

        return redirect()
            ->route('admin.repository.index')
            ->with('success', 'Repository berhasil diperbarui.');
    }

    /**
     * Menghapus repository dan file fisik terkait dari penyimpanan.
     */
    public function destroy(Repository $repository)
    {
        try {
            $filePath = $repository->file;

            $repository->delete();

            if ($filePath && Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }

            return redirect()
                ->route('admin.repository.index')
                ->with('success', 'Repository berhasil dihapus.');
        } catch (QueryException $e) {
            return redirect()
                ->route('admin.repository.index')
                ->with('danger', 'Repository tidak dapat dihapus karena sedang digunakan oleh data lain.');
        }
    }

    /**
     * Memvalidasi data input repository untuk store dan update.
     */
    private function validasiData(Request $request, bool $wajibFile): array
    {
        $fileRules = $wajibFile
            ? ['required', 'file', 'mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,zip,rar', 'max:51200']
            : ['nullable', 'file', 'mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,zip,rar', 'max:51200'];

        $messages = [
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
        ];

        if ($wajibFile) {
            $messages['file.required'] = 'File dokumen wajib diunggah.';
        }

        return $request->validate([
            'kurikulum_id' => ['required', 'exists:kurikulums,id'],
            'semester_id' => ['required', 'exists:semesters,id'],
            'kelas_id' => ['required', 'exists:kelas,id'],
            'mata_pelajaran_id' => ['required', 'exists:mata_pelajarans,id'],
            'jenis_dokumen_id' => ['required', 'exists:jenis_dokumens,id'],
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'file' => $fileRules,
            'akses' => ['required', 'in:gratis,premium'],
            'status' => ['required', 'in:draft,dipublikasikan,diarsipkan'],
        ], $messages);
    }

    /**
     * Mendapatkan data untuk kebutuhan dropdown form repository.
     */
    private function dataDropdown(): array
    {
        return [
            'kurikulums' => Kurikulum::aktif()->orderBy('nama')->get(),
            'semesters' => Semester::aktif()->orderBy('urutan')->get(),
            'kelas' => Kelas::aktif()->orderBy('urutan')->get(),
            'mataPelajarans' => MataPelajaran::aktif()->orderBy('urutan')->get(),
            'jenisDokumens' => JenisDokumen::aktif()->orderBy('urutan')->get(),
        ];
    }
}
