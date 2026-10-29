
<?php

use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\KurikulumController;
use App\Http\Controllers\Admin\PaketLanggananController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\MataPelajaranController;
use App\Http\Controllers\Admin\KategoriDokumenController;
use App\Http\Controllers\Admin\JenisDokumenController;
use App\Http\Controllers\Admin\SemesterController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\RepositoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Guest\FaqController as GuestFaqController;
use App\Http\Controllers\Guest\HomeController;
use App\Http\Controllers\Guest\PaketLanggananController as GuestPaketLanggananController;
use App\Http\Controllers\Guest\PreviewMateriController;
use App\Http\Controllers\Guru\DashboardController as GuruDashboardController;
use App\Http\Controllers\Guru\RepositoryController as GuruRepositoryController;
use App\Http\Controllers\Guru\RiwayatUnduhanController;
use Illuminate\Support\Facades\Route;

// ==================== GUEST ====================

Route::get('/', [HomeController::class, 'index'])
    ->name('guest.home');

Route::get('/tentang', function () {
    return view('guest.tentang.index');
})->name('guest.tentang');

Route::get('/paket-langganan', [GuestPaketLanggananController::class, 'index'])
    ->name('guest.paket-langganan');

Route::get('/preview-materi', [PreviewMateriController::class, 'index'])
    ->name('guest.preview-materi');

Route::get('/preview-materi/detail/{id?}', [PreviewMateriController::class, 'show'])
    ->name('guest.preview-materi.show');

Route::get('/faq', [GuestFaqController::class, 'index'])
    ->name('guest.faq');

// ==================== DASHBOARD ====================

Route::get('/dashboard', DashboardController::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// ==================== GURU ====================

Route::middleware(['auth'])
    ->prefix('guru')
    ->name('guru.')
    ->group(function () {
        Route::get('/dashboard', [GuruDashboardController::class, 'index'])
            ->name('dashboard.index');

        Route::get('/repository', [GuruRepositoryController::class, 'index'])
            ->name('repository.index');

        Route::get('/repository/{repository}', [GuruRepositoryController::class, 'show'])
            ->name('repository.show');

        Route::get('/repository/{repository}/download', [GuruRepositoryController::class, 'download'])
            ->name('repository.download');

        // Riwayat Download
        Route::get('/riwayat-download', [RiwayatUnduhanController::class, 'index'])
            ->name('riwayat-download.index');
    });

// ==================== PROFIL ====================

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

// ==================== ADMIN ====================

Route::middleware(['auth', 'role:Super Admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');

    Route::get('/admin/profile', [AdminProfileController::class, 'index'])
        ->name('admin.profile');

    Route::put('/admin/profile', [AdminProfileController::class, 'update'])
        ->name('admin.profile.update');

    Route::get('/admin/ui-kit', function () {
        return view('admin.ui-kit');
    })->name('admin.ui-kit');

    Route::get('/admin/repository/{repository}/download', [RepositoryController::class, 'download'])
        ->name('admin.repository.download');

    Route::resource('admin/repository', RepositoryController::class)
        ->names('admin.repository');

    Route::resource('admin/kurikulum', KurikulumController::class)
        ->names('admin.kurikulum');

    Route::resource('admin/paket-langganan', PaketLanggananController::class)
        ->names('admin.paket-langganan');

    Route::resource('/admin/semester', SemesterController::class)
        ->names('admin.semester');

    Route::resource('/admin/kelas', KelasController::class)
        ->parameters(['kelas' => 'kelas'])
        ->names('admin.kelas');

    Route::resource('/admin/mata-pelajaran', MataPelajaranController::class)
        ->names('admin.mata-pelajaran');

    Route::resource('/admin/kategori-dokumen', KategoriDokumenController::class)
        ->names('admin.kategori-dokumen');

    Route::resource('/admin/jenis-dokumen', JenisDokumenController::class)
        ->parameters(['jenis-dokumen' => 'jenisDokumen'])
        ->names('admin.jenis-dokumen');

    Route::resource('admin/faq', FaqController::class)
        ->names('admin.faq');
});

require __DIR__.'/auth.php';
