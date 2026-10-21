<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\JenisDokumen;
use App\Models\Kelas;
use App\Models\Kurikulum;
use App\Models\MataPelajaran;
use App\Models\PaketLangganan;
use App\Models\Repository;
use App\Models\RiwayatUnduhan;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class RepositoryController extends Controller
{
    /**
     * Menampilkan katalog repository pembelajaran untuk Guru.
     */
    public function index(Request $request): View
    {
        /** @var \App\Models\User $user */
        $user = $request->user();
        $activeSubscribedKelasIds = $user->getActiveSubscribedKelasIds();

        $query = Repository::query()
            ->with(['kurikulum', 'semester', 'kelas', 'mataPelajaran', 'jenisDokumen'])
            ->where('status', 'dipublikasikan');

        // Filter pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        if ($request->filled('kurikulum_id')) {
            $query->where('kurikulum_id', $request->kurikulum_id);
        }

        if ($request->filled('kelas_id')) {
            $query->where('kelas_id', $request->kelas_id);
        }

        if ($request->filled('semester_id')) {
            $query->where('semester_id', $request->semester_id);
        }

        if ($request->filled('mata_pelajaran_id')) {
            $query->where('mata_pelajaran_id', $request->mata_pelajaran_id);
        }

        if ($request->filled('jenis_dokumen_id')) {
            $query->where('jenis_dokumen_id', $request->jenis_dokumen_id);
        }

        // Filter tipe akses
        if ($request->filled('akses')) {
            if ($request->akses === 'gratis') {
                $query->where('akses', Repository::AKSES_GRATIS);
            } elseif ($request->akses === 'premium') {
                $query->where('akses', Repository::AKSES_PREMIUM);
            } elseif ($request->akses === 'milik_saya') {
                // Dokumen yang bisa diunduh oleh user (gratis ATAU kelasnya aktif dilanggani)
                $query->where(function ($q) use ($activeSubscribedKelasIds) {
                    $q->where('akses', Repository::AKSES_GRATIS)
                        ->orWhereIn('kelas_id', $activeSubscribedKelasIds);
                });
            }
        }

        $repositories = $query->latest()->paginate(12)->withQueryString();

        // Hitung total statistik ringkas untuk informasi guru
        $totalTersedia = Repository::where('status', 'dipublikasikan')->count();
        $totalGratis = Repository::where('status', 'dipublikasikan')->where('akses', Repository::AKSES_GRATIS)->count();
        $totalPremium = max(0, $totalTersedia - $totalGratis);
        $totalAksesSaya = Repository::where('status', 'dipublikasikan')
            ->where(function ($q) use ($activeSubscribedKelasIds) {
                $q->where('akses', Repository::AKSES_GRATIS)
                    ->orWhereIn('kelas_id', $activeSubscribedKelasIds);
            })->count();

        return view('guru.repository.index', [
            'repositories' => $repositories,
            'activeSubscribedKelasIds' => $activeSubscribedKelasIds,
            'kurikulums' => Kurikulum::aktif()->orderBy('nama')->get(),
            'kelas' => Kelas::aktif()->orderBy('urutan')->get(),
            'semesters' => Semester::aktif()->orderBy('urutan')->get(),
            'mataPelajarans' => MataPelajaran::aktif()->orderBy('urutan')->get(),
            'jenisDokumens' => JenisDokumen::aktif()->orderBy('urutan')->get(),
            'totalTersedia' => $totalTersedia,
            'totalGratis' => $totalGratis,
            'totalPremium' => $totalPremium,
            'totalAksesSaya' => $totalAksesSaya,
        ]);
    }

    /**
     * Menampilkan detail & pratinjau dokumen repository.
     */
    public function show(Request $request, Repository $repository): View
    {
        // Hanya dokumen yang dipublikasikan yang bisa dilihat guru
        if ($repository->status !== 'dipublikasikan') {
            abort(404, 'Dokumen tidak ditemukan atau belum dipublikasikan.');
        }

        $repository->load(['kurikulum', 'semester', 'kelas', 'mataPelajaran', 'jenisDokumen']);

        /** @var \App\Models\User $user */
        $user = $request->user();
        $canAccess = $user->canAccessRepository($repository);

        // Jika dokumen premium dan terkunci, cari info paket langganan yang cocok dengan kelas dokumen
        $paketTerkait = null;
        if (!$canAccess) {
            $paketTerkait = PaketLangganan::query()
                ->where('kelas_id', $repository->kelas_id)
                ->where('status', 'aktif')
                ->first();

            // Fallback paket aktif umum jika tidak ada paket spesifik kelas
            if (!$paketTerkait) {
                $paketTerkait = PaketLangganan::query()
                    ->where('status', 'aktif')
                    ->first();
            }
        }

        $isPdf = strtolower($repository->tipe_file) === 'pdf';
        $fileUrl = ($repository->file && Storage::disk('public')->exists($repository->file))
            ? Storage::url($repository->file)
            : null;

        // Cek apakah guru ini pernah mengunduh dokumen ini sebelumnya
        $pernahDiunduh = RiwayatUnduhan::where('user_id', $user->id)
            ->where('repository_id', $repository->id)
            ->exists();

        return view('guru.repository.show', [
            'repository' => $repository,
            'canAccess' => $canAccess,
            'paketTerkait' => $paketTerkait,
            'isPdf' => $isPdf,
            'fileUrl' => $fileUrl,
            'pernahDiunduh' => $pernahDiunduh,
        ]);
    }

    /**
     * Mengunduh berkas asli repository bagi guru yang berhak.
     */
    public function download(Request $request, Repository $repository): Response
    {
        if ($repository->status !== 'dipublikasikan') {
            abort(404, 'Dokumen tidak ditemukan.');
        }

        /** @var \App\Models\User $user */
        $user = $request->user();

        // Validasi hak akses (gratis atau langganan aktif)
        if (!$user->canAccessRepository($repository)) {
            return back()->with('error', 'Dokumen ini bertipe Premium dan terkunci. Silakan aktifkan paket langganan untuk mengunduh.');
        }

        // Validasi fisik berkas di storage
        if (!$repository->file || !Storage::disk('public')->exists($repository->file)) {
            return back()->with('error', 'Berkas dokumen asli tidak ditemukan di server.');
        }

        // Catat riwayat unduhan
        RiwayatUnduhan::create([
            'user_id' => $user->id,
            'repository_id' => $repository->id,
            'created_at' => now(),
        ]);

        return Storage::disk('public')->download($repository->file, $repository->nama_file);
    }
}
