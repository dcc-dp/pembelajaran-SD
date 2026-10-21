@extends('guru.layouts.guru')

@section('title', $repository->judul . ' - Repository Guru')

@section('content')
<div class="guru-repository-detail d-flex flex-column gap-4">

    {{-- Breadcrumb & Back Nav --}}
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
        <a href="{{ route('guru.repository.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3 fw-semibold">
            <i class="ti ti-arrow-left me-1"></i> Kembali ke Repository
        </a>

        <div class="d-flex align-items-center gap-2">
            @if($canAccess)
                <span class="badge bg-success-subtle text-success px-3 py-1.5 rounded-pill fw-semibold">
                    <i class="ti ti-circle-check me-1"></i> Akses Terbuka (Siap Diunduh)
                </span>
            @else
                <span class="badge bg-warning-subtle text-warning px-3 py-1.5 rounded-pill fw-semibold">
                    <i class="ti ti-lock me-1"></i> Materi Premium Terkunci
                </span>
            @endif
        </div>
    </div>

    {{-- Alert Flash Messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 rounded-3 mb-0" role="alert">
            <div class="d-flex align-items-center gap-2">
                <i class="ti ti-circle-check fs-2 text-success"></i>
                <div class="fw-semibold text-dark">{{ session('success') }}</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 rounded-3 mb-0" role="alert">
            <div class="d-flex align-items-center gap-2">
                <i class="ti ti-alert-triangle fs-2 text-danger"></i>
                <div class="fw-semibold text-dark">{{ session('error') }}</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Main 2-Column Layout (Lapang & Tidak Menumpuk) --}}
    <div class="row g-4 align-items-start">

        {{-- Kolom Kiri: Viewer Dokumen & Pratinjau (8 Col) --}}
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                {{-- Viewer Header --}}
                <div class="card-header bg-white border-bottom py-3 px-4 d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-danger text-white rounded-2 px-2 py-1 small fw-bold">
                            {{ strtoupper($repository->tipe_file ?: 'PDF') }}
                        </span>
                        <h2 class="card-title fw-bold text-dark mb-0 fs-3 text-truncate" style="max-width: 500px;">
                            {{ $repository->judul }}
                        </h2>
                    </div>

                    @if($isPdf && $canAccess)
                        {{-- PDF Controls Bar Ringkas --}}
                        <div class="d-flex align-items-center gap-2 bg-light px-2 py-1 rounded-pill border" id="pdf-controls">
                            <button type="button" class="btn btn-sm btn-icon btn-white rounded-circle shadow-xs" id="pdf-prev-page" title="Halaman Sebelumnya">
                                <i class="ti ti-chevron-left"></i>
                            </button>
                            <span class="text-secondary small fw-semibold px-2" style="font-size: 0.8rem;">
                                Hal <span id="pdf-current-page">1</span> / <span id="pdf-total-pages">-</span>
                            </span>
                            <button type="button" class="btn btn-sm btn-icon btn-white rounded-circle shadow-xs" id="pdf-next-page" title="Halaman Berikutnya">
                                <i class="ti ti-chevron-right"></i>
                            </button>
                            <span class="border-start mx-1" style="height: 16px;"></span>
                            <button type="button" class="btn btn-sm btn-icon btn-white rounded-circle shadow-xs" id="pdf-zoom-out" title="Perkecil">
                                <i class="ti ti-zoom-out"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-icon btn-white rounded-circle shadow-xs" id="pdf-zoom-in" title="Perbesar">
                                <i class="ti ti-zoom-in"></i>
                            </button>
                        </div>
                    @endif
                </div>

                {{-- Viewer Body Container --}}
                <div class="card-body p-0 bg-light position-relative" style="min-height: 580px;">

                    @if($isPdf && $fileUrl)
                        {{-- Viewer PDF Interaktif --}}
                        <div class="p-4 d-flex flex-column align-items-center overflow-auto" id="guru-pdf-scroll-container" style="max-height: 720px;">

                            @if($canAccess)
                                {{-- KONDISI 1: Akses Terbuka (Full Pages Reader) --}}
                                <div class="bg-white shadow-sm rounded-2 position-relative border" id="pdf-canvas-wrapper" style="max-width: 100%;">
                                    <canvas id="pdf-render-canvas" style="display: block; max-width: 100%; height: auto;"></canvas>
                                </div>
                                <div id="pdf-loading-indicator" class="text-center py-5">
                                    <div class="spinner-border text-danger mb-2" role="status"></div>
                                    <div class="text-secondary small">Memuat lembar dokumen...</div>
                                </div>
                            @else
                                {{-- KONDISI 2: Terkunci (Halaman 1 Sampel, Halaman 2 Gembok Blur) --}}
                                <div class="d-flex flex-column align-items-center gap-4 w-100">
                                    {{-- Halaman 1: Sampel Terbuka --}}
                                    <div class="bg-white shadow-sm rounded-2 position-relative border p-2" style="max-width: 100%;">
                                        <div class="badge bg-dark bg-opacity-75 text-white position-absolute top-0 start-0 m-2 px-2 py-0.5 rounded-1 small">
                                            Halaman 1 (Pratinjau)
                                        </div>
                                        <canvas id="pdf-preview-page-1" style="display: block; max-width: 100%; height: auto;"></canvas>
                                    </div>

                                    {{-- Halaman 2: Terkunci Blur dengan Gembok --}}
                                    <div class="bg-white shadow-sm rounded-2 position-relative border overflow-hidden w-100" style="max-width: 600px; min-height: 380px;">
                                        <canvas id="pdf-preview-page-2" style="display: block; width: 100%; height: 380px; filter: blur(8px); opacity: 0.45;"></canvas>

                                        {{-- Lock Overlay Frosted --}}
                                        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column align-items-center justify-content-center p-4 text-center"
                                             style="background: rgba(255, 255, 255, 0.88); backdrop-filter: blur(4px);">
                                            <div class="avatar avatar-lg rounded-circle bg-warning-subtle text-warning mb-3 shadow-xs">
                                                <i class="ti ti-lock fs-1"></i>
                                            </div>
                                            <h4 class="fw-bold text-dark mb-1">Halaman Dokumen Terkunci</h4>
                                            <p class="text-secondary small mb-3" style="max-width: 360px; line-height: 1.5;">
                                                Aktifkan paket langganan untuk membaca seluruh lembar dokumen ini secara utuh dan mengunduh berkas aslinya.
                                            </p>
                                            <a href="{{ route('guest.paket-langganan') }}" class="btn btn-danger rounded-pill px-4 shadow-sm btn-sm fw-semibold">
                                                <i class="ti ti-sparkles me-1"></i> Berlangganan Sekarang
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                    @else
                        {{-- Non-PDF Document Fallback (Word / PPT / Excel / ZIP) --}}
                        <div class="p-5 d-flex flex-column align-items-center justify-content-center text-center" style="min-height: 520px;">
                            <div class="p-4 bg-white rounded-3 shadow-sm border mb-3 text-center" style="width: 120px; height: 120px; display: flex; align-items: center; justify-content: center;">
                                @if(in_array(strtolower($repository->tipe_file), ['doc', 'docx']))
                                    <i class="ti ti-file-text text-primary" style="font-size: 4rem;"></i>
                                @elseif(in_array(strtolower($repository->tipe_file), ['ppt', 'pptx']))
                                    <i class="ti ti-presentation text-warning" style="font-size: 4rem;"></i>
                                @elseif(in_array(strtolower($repository->tipe_file), ['xls', 'xlsx']))
                                    <i class="ti ti-table text-success" style="font-size: 4rem;"></i>
                                @else
                                    <i class="ti ti-file-archive text-danger" style="font-size: 4rem;"></i>
                                @endif
                            </div>

                            <h3 class="fw-bold text-dark mb-1">{{ $repository->nama_file }}</h3>
                            <div class="text-muted small mb-3">
                                Format Dokumen {{ strtoupper($repository->tipe_file) }}
                                @if($repository->ukuran_file)
                                    &bull; {{ number_format($repository->ukuran_file / 1024, 1) }} KB
                                @endif
                            </div>

                            @if($canAccess)
                                <div class="alert alert-success d-inline-flex align-items-center gap-2 rounded-pill px-3 py-1.5 small mb-3">
                                    <i class="ti ti-check"></i> Dokumen siap diunduh dan diedit di perangkat Anda
                                </div>
                                <div>
                                    <a href="{{ route('guru.repository.download', $repository) }}" class="btn btn-danger rounded-pill px-4 py-2 fw-semibold shadow-sm">
                                        <i class="ti ti-download me-1"></i> Unduh Berkas Asli
                                    </a>
                                </div>
                            @else
                                <div class="alert alert-warning d-inline-flex align-items-center gap-2 rounded-pill px-3 py-1.5 small mb-3">
                                    <i class="ti ti-lock"></i> Dokumen ini memerlukan paket langganan aktif
                                </div>
                                <div>
                                    <a href="{{ route('guest.paket-langganan') }}" class="btn btn-warning text-dark rounded-pill px-4 py-2 fw-semibold shadow-sm">
                                        <i class="ti ti-sparkles me-1"></i> Buka Akses / Beli Paket
                                    </a>
                                </div>
                            @endif
                        </div>
                    @endif

                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Aksi Download & Metadata Dokumen (4 Col) --}}
        <div class="col-lg-4 d-flex flex-column gap-3">

            {{-- 1. Kartu Status & Aksi Utama --}}
            <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                <div class="card-header bg-white border-bottom py-3">
                    <h3 class="card-title fw-bold text-dark mb-0 fs-4">
                        <i class="ti ti-download me-1.5 text-danger"></i> Akses & Unduhan
                    </h3>
                </div>
                <div class="card-body p-4">
                    @if($canAccess)
                        {{-- KONDISI AKSES TERBUKA --}}
                        <div class="bg-success-subtle p-3 rounded-3 mb-3 border border-success-subtle">
                            <div class="d-flex align-items-center gap-2 text-success fw-bold small mb-1">
                                <i class="ti ti-circle-check fs-3"></i> Akses Berkas Aktif
                            </div>
                            <p class="text-secondary small mb-0" style="line-height: 1.4;">
                                Anda memiliki izin penuh untuk mengunduh dan memanfaatkan perangkat ajar ini.
                            </p>
                        </div>

                        <a href="{{ route('guru.repository.download', $repository) }}"
                           class="btn btn-danger btn-lg w-100 rounded-pill py-2.5 fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2">
                            <i class="ti ti-download fs-2"></i>
                            <span>Download Berkas Asli</span>
                        </a>

                        @if($pernahDiunduh)
                            <div class="text-center text-muted small mt-2" style="font-size: 0.775rem;">
                                <i class="ti ti-history me-1"></i> Terakhir pernah Anda unduh sebelumnya
                            </div>
                        @endif
                    @else
                        {{-- KONDISI TERKUNCI (BUTUH LANGGANAN) --}}
                        <div class="bg-warning-subtle p-3 rounded-3 mb-3 border border-warning-subtle">
                            <div class="d-flex align-items-center gap-2 text-warning-emphasis fw-bold small mb-1">
                                <i class="ti ti-lock fs-3 text-warning"></i> Dokumen Terkunci
                            </div>
                            <p class="text-secondary small mb-0" style="line-height: 1.4;">
                                Berkas ini bertipe <strong>Premium</strong>. Diperlukan paket langganan aktif untuk mengunduh berkas lengkap.
                            </p>
                        </div>

                        @if($paketTerkait)
                            <div class="p-3 bg-light rounded-3 border mb-3">
                                <div class="text-muted small text-uppercase fw-bold" style="font-size: 0.675rem; letter-spacing: 0.05em;">
                                    Paket yang Mendukung
                                </div>
                                <div class="fw-bold text-dark fs-4 mb-1">
                                    {{ $paketTerkait->nama }}
                                </div>
                                <div class="fw-bold text-danger fs-3 mb-1">
                                    Rp {{ number_format($paketTerkait->harga, 0, ',', '.') }}
                                    <span class="text-muted small fw-normal">/ {{ $paketTerkait->durasi_bulan }} Bulan</span>
                                </div>
                                <div class="text-secondary small" style="font-size: 0.775rem;">
                                    Akses tanpa batas ke seluruh modul kelas ini.
                                </div>
                            </div>
                        @endif

                        <a href="{{ route('guest.paket-langganan') }}"
                           class="btn btn-danger btn-lg w-100 rounded-pill py-2.5 fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2">
                            <i class="ti ti-sparkles fs-2"></i>
                            <span>Beli Paket Langganan</span>
                        </a>

                        <button type="button" class="btn btn-outline-secondary w-100 rounded-pill mt-2 py-2 small disabled" style="opacity: 0.65;">
                            <i class="ti ti-lock me-1"></i> Download Terkunci
                        </button>
                    @endif
                </div>
            </div>

            {{-- 2. Kartu Metadata & Deskripsi --}}
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-white border-bottom py-3">
                    <h3 class="card-title fw-bold text-dark mb-0 fs-4">
                        <i class="ti ti-file-info me-1.5 text-danger"></i> Informasi Dokumen
                    </h3>
                </div>
                <div class="card-body p-4">
                    {{-- Grid 2 Kolom Bersih & Rapi --}}
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="text-muted small fw-semibold text-uppercase" style="font-size: 0.68rem; letter-spacing: 0.04em;">Mata Pelajaran</div>
                            <div class="fw-bold text-dark mt-1 text-truncate" title="{{ $repository->mataPelajaran?->nama }}">
                                {{ $repository->mataPelajaran?->nama ?? '-' }}
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="text-muted small fw-semibold text-uppercase" style="font-size: 0.68rem; letter-spacing: 0.04em;">Jenis Dokumen</div>
                            <div class="fw-bold text-dark mt-1 text-truncate" title="{{ $repository->jenisDokumen?->nama }}">
                                {{ $repository->jenisDokumen?->nama ?? '-' }}
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="text-muted small fw-semibold text-uppercase" style="font-size: 0.68rem; letter-spacing: 0.04em;">Kelas</div>
                            <div class="mt-1">
                                <span class="badge bg-danger-subtle text-danger fw-semibold px-2.5 py-1 rounded-pill">
                                    {{ $repository->kelas?->nama ?? 'Semua Kelas' }}
                                </span>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="text-muted small fw-semibold text-uppercase" style="font-size: 0.68rem; letter-spacing: 0.04em;">Semester</div>
                            <div class="mt-1">
                                <span class="badge bg-secondary-subtle text-secondary fw-semibold px-2.5 py-1 rounded-pill">
                                    {{ $repository->semester?->nama ?? 'Semua Semester' }}
                                </span>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="text-muted small fw-semibold text-uppercase" style="font-size: 0.68rem; letter-spacing: 0.04em;">Kurikulum</div>
                            <div class="fw-semibold text-dark small mt-1">
                                {{ $repository->kurikulum?->nama ?? '-' }}
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="text-muted small fw-semibold text-uppercase" style="font-size: 0.68rem; letter-spacing: 0.04em;">Format & Ukuran</div>
                            <div class="fw-semibold text-dark small mt-1">
                                {{ strtoupper($repository->tipe_file ?: 'PDF') }}
                                @if($repository->ukuran_file)
                                    &bull; {{ number_format($repository->ukuran_file / 1024, 1) }} KB
                                @endif
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="text-muted small fw-semibold text-uppercase" style="font-size: 0.68rem; letter-spacing: 0.04em;">Tanggal Terbit</div>
                            <div class="text-secondary small mt-0.5">
                                <i class="ti ti-calendar me-1"></i> {{ $repository->created_at?->format('d M Y') ?? '-' }}
                            </div>
                        </div>
                    </div>

                    {{-- Deskripsi Dokumen --}}
                    @if($repository->deskripsi)
                        <div class="pt-3 border-top mt-3">
                            <div class="text-muted small fw-semibold text-uppercase mb-1.5" style="font-size: 0.68rem; letter-spacing: 0.04em;">
                                Deskripsi Materi
                            </div>
                            <p class="text-secondary small mb-0" style="line-height: 1.65;">
                                {{ $repository->deskripsi }}
                            </p>
                        </div>
                    @endif
                </div>
            </div>

        </div>

    </div>

</div>
@endsection

@if($isPdf && $fileUrl)
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const fileUrl = "{{ $fileUrl }}";
    const canAccess = {{ $canAccess ? 'true' : 'false' }};

    if (!fileUrl || !window.pdfjsLib) return;
    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

    let pdfDoc = null;
    let pageNum = 1;
    let pageRendering = false;
    let pageNumPending = null;
    let scale = 1.35;

    if (canAccess) {
        // Mode Akses Terbuka: Viewer dengan Kontrol Halaman
        const canvas = document.getElementById('pdf-render-canvas');
        if (!canvas) return;
        const ctx = canvas.getContext('2d');
        const indicator = document.getElementById('pdf-loading-indicator');
        const pageNumDisplay = document.getElementById('pdf-current-page');
        const totalPagesDisplay = document.getElementById('pdf-total-pages');

        function renderPage(num) {
            pageRendering = true;
            pdfDoc.getPage(num).then(function (page) {
                const viewport = page.getViewport({ scale: scale });
                const dpr = window.devicePixelRatio || 1;

                canvas.height = viewport.height * dpr;
                canvas.width = viewport.width * dpr;
                canvas.style.width = viewport.width + 'px';
                canvas.style.height = viewport.height + 'px';

                const renderContext = {
                    canvasContext: ctx,
                    viewport: viewport,
                    transform: [dpr, 0, 0, dpr, 0, 0]
                };

                const renderTask = page.render(renderContext);
                renderTask.promise.then(function () {
                    pageRendering = false;
                    if (indicator) indicator.style.display = 'none';
                    if (pageNumPending !== null) {
                        renderPage(pageNumPending);
                        pageNumPending = null;
                    }
                });
            });

            if (pageNumDisplay) pageNumDisplay.textContent = num;
        }

        function queueRenderPage(num) {
            if (pageRendering) {
                pageNumPending = num;
            } else {
                renderPage(num);
            }
        }

        function onPrevPage() {
            if (pageNum <= 1) return;
            pageNum--;
            queueRenderPage(pageNum);
        }

        function onNextPage() {
            if (pageNum >= pdfDoc.numPages) return;
            pageNum++;
            queueRenderPage(pageNum);
        }

        document.getElementById('pdf-prev-page')?.addEventListener('click', onPrevPage);
        document.getElementById('pdf-next-page')?.addEventListener('click', onNextPage);
        document.getElementById('pdf-zoom-in')?.addEventListener('click', function () {
            scale = Math.min(scale + 0.2, 2.5);
            queueRenderPage(pageNum);
        });
        document.getElementById('pdf-zoom-out')?.addEventListener('click', function () {
            scale = Math.max(scale - 0.2, 0.7);
            queueRenderPage(pageNum);
        });

        pdfjsLib.getDocument(fileUrl).promise.then(function (doc) {
            pdfDoc = doc;
            if (totalPagesDisplay) totalPagesDisplay.textContent = doc.numPages;
            renderPage(pageNum);
        }).catch(function (err) {
            console.error('Gagal memuat PDF:', err);
            if (indicator) indicator.innerHTML = '<div class="text-danger small">Gagal memuat pratinjau PDF.</div>';
        });

    } else {
        // Mode Terkunci: Render Halaman 1 sebagai sampel, dan Halaman 2 (jika ada) di-render buram
        const canvas1 = document.getElementById('pdf-preview-page-1');
        const canvas2 = document.getElementById('pdf-preview-page-2');

        pdfjsLib.getDocument(fileUrl).promise.then(function (doc) {
            // Render Hal 1
            if (canvas1) {
                doc.getPage(1).then(function (page) {
                    const vp = page.getViewport({ scale: 1.15 });
                    const dpr = window.devicePixelRatio || 1;
                    canvas1.width = vp.width * dpr;
                    canvas1.height = vp.height * dpr;
                    canvas1.style.width = vp.width + 'px';
                    canvas1.style.height = vp.height + 'px';
                    page.render({
                        canvasContext: canvas1.getContext('2d'),
                        viewport: vp,
                        transform: [dpr, 0, 0, dpr, 0, 0]
                    });
                });
            }

            // Render Hal 2 (Buram)
            if (canvas2 && doc.numPages >= 2) {
                doc.getPage(2).then(function (page) {
                    const vp = page.getViewport({ scale: 1.15 });
                    const dpr = window.devicePixelRatio || 1;
                    canvas2.width = vp.width * dpr;
                    canvas2.height = vp.height * dpr;
                    page.render({
                        canvasContext: canvas2.getContext('2d'),
                        viewport: vp,
                        transform: [dpr, 0, 0, dpr, 0, 0]
                    });
                });
            }
        });
    }
});
</script>
@endpush
@endif
