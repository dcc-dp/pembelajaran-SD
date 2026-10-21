@extends('guest.layouts.guest')

@section('title', 'Preview: ' . ($document ? $document->judul : 'Dokumen Perangkat Ajar'))

@section('content')
<section class="py-4 py-md-5 bg-white border-bottom">
    <div class="container-xl">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="{{ route('guest.home') }}" class="text-decoration-none text-muted">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('guest.preview-materi') }}" class="text-decoration-none text-muted">Preview Materi</a></li>
                <li class="breadcrumb-item active text-danger fw-semibold" aria-current="page">{{ $document?->judul ?? 'Detail Dokumen' }}</li>
            </ol>
        </nav>

        @if($document)
            <div class="row g-4 g-lg-5 align-items-start">
                <div class="col-lg-8">
                    <div class="doc-viewer-wrapper">
                        <div class="doc-viewer-toolbar">
                            <div class="d-flex align-items-center text-truncate">
                                <i class="ti ti-file-text text-danger fs-3 me-2"></i>
                                <span class="fw-medium text-truncate">
                                    Preview: {{ $document->nama_file ?: ($document->judul . '.pdf') }}
                                </span>
                            </div>
                            <!-- <div class="d-flex align-items-center gap-2 small">
                                <span class="badge bg-dark border border-secondary text-white-50 px-2 py-1">
                                    <i class="ti ti-eye text-success me-1"></i> Hal. 1 Terbuka &bull; <i class="ti ti-lock text-danger ms-1 me-1"></i> Hal. 2 Terkunci
                                </span>
                            </div> -->
                        </div>

                        <div class="doc-viewer-scroll">
                            <div class="doc-page-section" id="doc-page-1-section">
                                <div class="d-flex justify-content-center mb-2">
                                    <span class="doc-page-indicator">
                                        <i class="ti ti-eye text-success"></i> Halaman 1 (Pratinjau Bebas)
                                    </span>
                                </div>
                                <div class="doc-page-paper position-relative" id="doc-page-1-wrapper">
                                    <div class="doc-watermark">PREVIEW SD LEARNING CENTER</div>

                                    <canvas id="pdf-canvas-1" class="doc-canvas" style="display: none;"></canvas>

                                <!-- HAL 1 -->
                                    <div id="doc-fallback-page-1" class="p-4 w-100">
                                        <div class="text-center mb-4 pb-3 border-bottom position-relative" style="z-index: 2;">
                                            <div class="fw-bold text-uppercase text-danger small mb-1" style="letter-spacing: 0.08em;">
                                                {{ $document->kurikulum?->nama ?? 'Kurikulum Merdeka' }}
                                            </div>
                                            <h2 class="fw-bold text-dark fs-2 mb-1">
                                                {{ $document->judul }}
                                            </h2>
                                            <div class="text-secondary small">
                                                {{ $document->mataPelajaran?->nama ?? 'Mata Pelajaran Umum' }} &bull; 
                                                {{ $document->kelas?->nama ?? 'Kelas SD' }} ({{ $document->semester?->nama ?? 'Semester 1' }})
                                            </div>
                                        </div>

                                        <div class="position-relative" style="z-index: 2;">
                                            <div class="mb-3">
                                                <span class="badge bg-danger-subtle text-danger fw-semibold">A. IDENTITAS & TUJUAN PEMBELAJARAN</span>
                                            </div>
                                            <div class="doc-paper-skeleton-bar" style="width: 92%;"></div>
                                            <div class="doc-paper-skeleton-bar" style="width: 100%;"></div>
                                            <div class="doc-paper-skeleton-bar" style="width: 85%;"></div>
                                            <div class="doc-paper-skeleton-bar" style="width: 95%;"></div>

                                            <div class="row g-3 my-3">
                                                <div class="col-6">
                                                    <div class="doc-paper-skeleton-box p-3">
                                                        <div class="fw-semibold text-muted small mb-1">Capaian Pembelajaran:</div>
                                                        <div class="doc-paper-skeleton-bar" style="width: 70%;"></div>
                                                        <div class="doc-paper-skeleton-bar" style="width: 90%;"></div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="doc-paper-skeleton-box p-3">
                                                        <div class="fw-semibold text-muted small mb-1">Profil Pelajar Pancasila:</div>
                                                        <div class="doc-paper-skeleton-bar" style="width: 60%;"></div>
                                                        <div class="doc-paper-skeleton-bar" style="width: 85%;"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3 mt-4">
                                                <span class="badge bg-danger-subtle text-danger fw-semibold">B. KEGIATAN PEMBELAJARAN (PENDAHULUAN)</span>
                                            </div>
                                            <div class="doc-paper-skeleton-bar" style="width: 98%;"></div>
                                            <div class="doc-paper-skeleton-bar" style="width: 92%;"></div>
                                            <div class="doc-paper-skeleton-bar" style="width: 86%;"></div>
                                            <div class="doc-paper-skeleton-bar" style="width: 78%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center py-1">
                                <span class="badge bg-dark text-white-50 small rounded-pill px-3 py-1 shadow-sm">
                                    <i class="ti ti-arrow-down me-1"></i> Gulir ke bawah untuk melihat halaman 2
                                </span>
                            </div>

                            <!-- TERKUNCI SETELAH DISCROLL -->
                            <div class="doc-page-section" id="doc-page-2-section">
                                <div class="d-flex justify-content-center mb-2">
                                    <span class="doc-page-indicator">
                                        <i class="ti ti-lock text-danger"></i> Halaman 2 (Terkunci)
                                    </span>
                                </div>
                                <div class="doc-page-paper doc-page-locked position-relative" id="doc-page-2-wrapper">
                                    <div class="doc-watermark">PREVIEW SD LEARNING CENTER</div>

                                    <canvas id="pdf-canvas-2" class="doc-canvas-blurred" style="display: none;"></canvas>

                                    <div id="doc-fallback-page-2" class="p-4 w-100" style="filter: blur(5px); opacity: 0.35; user-select: none;">
                                        <div class="mb-3">
                                            <span class="badge bg-secondary-subtle text-secondary">C. KEGIATAN INTI & EVALUASI</span>
                                        </div>
                                        <div class="doc-paper-skeleton-bar" style="width: 88%;"></div>
                                        <div class="doc-paper-skeleton-bar" style="width: 95%;"></div>
                                        <div class="doc-paper-skeleton-bar" style="width: 75%;"></div>
                                        <div class="doc-paper-skeleton-box p-3 my-3"></div>
                                        <div class="doc-paper-skeleton-bar" style="width: 92%;"></div>
                                        <div class="doc-paper-skeleton-bar" style="width: 85%;"></div>
                                        <div class="doc-paper-skeleton-box p-3 my-3"></div>
                                        <div class="doc-paper-skeleton-bar" style="width: 80%;"></div>
                                    </div>

                                    <div class="doc-lock-modal">
                                        <div class="doc-lock-icon mx-auto">
                                            <i class="ti ti-lock"></i>
                                        </div>
                                        <h4 class="fw-bold text-dark mb-1 fs-3">Akses Terbatas</h4>
                                        <p class="text-secondary small mb-3">
                                            Halaman selanjutnya dan dokumen lengkap tanpa sensor hanya tersedia bagi pengguna yang telah berlangganan.
                                        </p>
                                        <a href="{{ route('guest.paket-langganan') }}" class="btn btn-sd-orange btn-sm rounded-pill px-4 shadow-sm">
                                            Buka Akses Berlangganan <i class="ti ti-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="doc-info-card">
                        {{-- Visual Cover / Fallback Header --}}
                        @if($document->sampul_url)
                            <div class="mb-4 rounded-3 overflow-hidden position-relative shadow-sm" style="height: 180px; background: #0f172a;">
                                <img src="{{ $document->sampul_url }}" alt="{{ $document->judul }}" style="width: 100%; height: 100%; object-fit: cover;">
                                <div class="position-absolute top-0 end-0 m-2">
                                    <span class="badge bg-white text-dark shadow-sm fw-semibold">
                                        <i class="ti ti-photo me-1"></i> Sampul Dokumen
                                    </span>
                                </div>
                            </div>
                        @else
                            <div class="mb-4 rounded-3 p-3 text-white position-relative shadow-sm d-flex flex-column align-items-center justify-content-center text-center overflow-hidden" style="height: 130px; background: {{ $document->thematic_theme['gradient'] }};">
                                <div class="preview-thematic-pattern"></div>
                                <div class="preview-thematic-icon-box mb-2" style="width: 44px; height: 44px; border-radius: 12px; margin-bottom: 0.35rem;">
                                    <i class="{{ $document->thematic_theme['icon'] }}" style="font-size: 1.4rem;"></i>
                                </div>
                                <span class="preview-thematic-mapel-pill" style="font-size: 0.7rem;">
                                    {{ $document->mataPelajaran?->nama ?? 'Perangkat Ajar' }}
                                </span>
                            </div>
                        @endif

                        <h3 class="fw-bold text-dark fs-2 mb-4">Informasi Dokumen</h3>

                        <div class="mb-3">
                            <div class="doc-meta-label">Judul Dokumen</div>
                            <div class="doc-meta-value fs-4 text-dark">{{ $document->judul }}</div>
                        </div>

                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <div class="doc-meta-label">Tipe Dokumen</div>
                                <div class="doc-meta-value">{{ $document->jenisDokumen?->nama ?? 'Perangkat Ajar' }}</div>
                            </div>
                            <div class="col-6">
                                <div class="doc-meta-label">Mata Pelajaran</div>
                                <div class="doc-meta-value">{{ $document->mataPelajaran?->nama ?? 'Umum' }}</div>
                            </div>
                        </div>

                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <div class="doc-meta-label">Kelas</div>
                                <div>
                                    <span class="badge bg-danger-subtle text-danger fw-semibold px-2 py-1">
                                        {{ $document->kelas?->nama ?? 'Semua Kelas' }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="doc-meta-label">Semester</div>
                                <div>
                                    <span class="badge bg-secondary-subtle text-secondary fw-semibold px-2 py-1">
                                        {{ $document->semester?->nama ?? 'Semua Semester' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="doc-meta-label">Deskripsi Singkat</div>
                            <p class="text-secondary small mb-0" style="line-height: 1.65;">
                                {{ $document->deskripsi ?: 'Modul ini disusun sesuai dengan kurikulum merdeka yang berfokus pada pemahaman konsep dan aktivitas bermakna bagi siswa sekolah dasar.' }}
                            </p>
                        </div>

                        <div class="doc-notice-box mb-4">
                            <div class="d-flex align-items-start gap-2">
                                <i class="ti ti-info-circle-filled text-warning fs-3 mt-1"></i>
                                <div>
                                    <div class="fw-bold text-dark small mb-1">Catatan Penting</div>
                                    <p class="text-secondary small mb-0" style="font-size: 0.8rem; line-height: 1.5;">
                                        Dokumen lengkap dapat diunduh dalam format Word (.docx) & PDF setelah Anda mengaktifkan paket langganan.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-column gap-2">
                            <a href="{{ route('guest.paket-langganan') }}" class="btn btn-sd-orange rounded-pill w-100 py-2 shadow-sm text-center">
                                Berlangganan Sekarang <i class="ti ti-arrow-right ms-1"></i>
                            </a>
                            <a href="{{ route('guest.preview-materi') }}" class="btn btn-sd-outline rounded-pill w-100 py-2 text-center">
                                <i class="ti ti-arrow-left me-1"></i> Kembali ke Daftar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <div class="avatar avatar-xl rounded-circle bg-danger-subtle text-danger mb-3 mx-auto">
                    <i class="ti ti-file-unknown fs-1"></i>
                </div>
                <h3 class="fw-bold text-dark mb-2">Dokumen Tidak Ditemukan</h3>
                <p class="text-secondary small mb-4">Dokumen yang Anda cari tidak tersedia atau belum dipublikasikan.</p>
                <a href="{{ route('guest.preview-materi') }}" class="btn btn-sd-orange rounded-pill px-4">
                    Lihat Semua Materi
                </a>
            </div>
        @endif
    </div>
</section>


<section class="py-4 py-md-5 bg-white border-bottom">
    <div class="container-xl">
        <div class="cta-banner-gradient text-center">
            <h2 class="cta-banner-title text-white mb-3 mx-auto" style="max-width: 650px;">
                Ingin Mengakses Dokumen Lengkap?
            </h2>
            <p class="cta-banner-desc text-white-50 mb-4 mx-auto" style="max-width: 580px;">
                Dapatkan akses tak terbatas ke ribuan materi pembelajaran berkualitas tinggi untuk membantu proses mengajar Anda lebih efektif dan efisien.
            </p>
            <div class="d-flex flex-column flex-sm-row justify-content-center align-items-center gap-3">
                <a href="{{ route('guest.paket-langganan') }}" class="btn-cta-white shadow px-4 py-2 py-md-3">
                    <i class="ti ti-package me-1"></i> Lihat Paket Langganan
                </a>
                <a href="{{ route('register') }}" class="btn btn-outline-light rounded-pill px-4 py-2 py-md-3 fw-semibold">
                    <i class="ti ti-user-plus me-1"></i> Daftar Sekarang
                </a>
            </div>
        </div>
    </div>
</section>

@if($materiLainnya->isNotEmpty())
<section class="py-5 py-md-6" style="background-color: #f8fafc;">
    <div class="container-xl">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="section-title text-dark mb-0">Preview Materi Lainnya</h2>
                <p class="text-secondary small mb-0">Eksplorasi sampel perangkat ajar pilihan lainnya</p>
            </div>
            <a href="{{ route('guest.preview-materi') }}" class="text-danger fw-semibold text-decoration-none small d-flex align-items-center gap-1">
                <span>Lihat Semua</span>
                <i class="ti ti-arrow-right"></i>
            </a>
        </div>

        <div class="row g-4">
            @foreach($materiLainnya as $item)
                @php
                    $ext = strtolower($item->tipe_file ?? pathinfo($item->nama_file, PATHINFO_EXTENSION));
                    $formatClass = match($ext) {
                        'pdf' => 'badge-doc-pdf',
                        'doc', 'docx' => 'badge-doc-word',
                        'ppt', 'pptx' => 'badge-doc-ppt',
                        default => 'badge-doc-pdf',
                    };
                    $formatLabel = strtoupper($ext ?: 'PDF');
                @endphp
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="preview-item-card">
                        @if($item->sampul_url)
                            <div class="preview-card-cover has-image" style="height: 145px;">
                                <img src="{{ $item->sampul_url }}" alt="{{ $item->judul }}" class="preview-card-img-cover">
                                <div class="preview-card-img-overlay"></div>
                                <div class="preview-cover-top">
                                    <span class="badge-doc-format {{ $formatClass }}">
                                        {{ $formatLabel }}
                                    </span>
                                    <span class="badge-preview-tag" style="font-size: 0.65rem; padding: 0.2rem 0.5rem;">
                                        Preview
                                    </span>
                                </div>
                            </div>
                        @else
                            <div class="preview-card-cover has-fallback" style="height: 145px; background: {{ $item->thematic_theme['gradient'] }};">
                                <div class="preview-thematic-pattern"></div>
                                <div class="preview-cover-top">
                                    <span class="badge-doc-format {{ $formatClass }}">
                                        {{ $formatLabel }}
                                    </span>
                                    <span class="badge-preview-tag" style="font-size: 0.65rem; padding: 0.2rem 0.5rem;">
                                        Preview
                                    </span>
                                </div>

                                <div class="preview-thematic-center">
                                    <div class="preview-thematic-icon-box" style="width: 44px; height: 44px; border-radius: 12px; margin-bottom: 0.25rem;">
                                        <i class="{{ $item->thematic_theme['icon'] }}" style="font-size: 1.4rem;"></i>
                                    </div>
                                    <span class="preview-thematic-mapel-pill" style="font-size: 0.65rem; padding: 0.15rem 0.6rem;">
                                        {{ $item->mataPelajaran?->nama ?? 'Perangkat Ajar' }}
                                    </span>
                                </div>
                            </div>
                        @endif

                        <div class="p-3 d-flex flex-column flex-grow-1 justify-content-between">
                            <div>
                                <div class="text-uppercase fw-bold text-danger mb-1" style="font-size: 0.7rem; letter-spacing: 0.05em;">
                                    {{ $item->mataPelajaran?->nama ?? 'Umum' }}
                                </div>
                                <h4 class="fw-bold text-dark fs-4 mb-2" style="line-height: 1.35; min-height: 2.4rem;">
                                    {{ $item->judul }}
                                </h4>
                            </div>
                            <div class="pt-2 border-top mt-2 d-flex justify-content-between align-items-center">
                                <span class="badge bg-secondary-subtle text-secondary small">
                                    {{ $item->kelas?->nama ?? 'Kelas SD' }}
                                </span>
                                <a href="{{ route('guest.preview-materi.show', $item->id) }}" class="btn btn-outline-danger btn-sm rounded-pill px-3 py-1" style="font-size: 0.75rem;">
                                    Lihat Preview
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection

@push('styles')
<style>
    .doc-page-paper.has-pdf {
        max-width: 100% !important;
        aspect-ratio: auto !important;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const fileUrl = "{{ $document && $document->file ? asset('storage/' . $document->file) : '' }}";
        const canvas1 = document.getElementById('pdf-canvas-1');
        const fallback1 = document.getElementById('doc-fallback-page-1');
        const canvas2 = document.getElementById('pdf-canvas-2');
        const fallback2 = document.getElementById('doc-fallback-page-2');
        const paper1 = document.getElementById('doc-page-1-wrapper');
        const paper2 = document.getElementById('doc-page-2-wrapper');
        const scrollContainer = document.querySelector('.doc-viewer-scroll');

        if (fileUrl && canvas1 && window.pdfjsLib) {
            pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

            let loadedPdf = null;
            let renderTask1 = null;
            let renderTask2 = null;

            function renderDocumentPages() {
                if (!loadedPdf || !scrollContainer) return;

                // Hitung ruang yang tersedia di dalam viewer agar 1 halaman muat penuh (fit container)
                const containerWidth = scrollContainer.clientWidth || 580;
                const containerHeight = scrollContainer.clientHeight || 640;

                // Alokasi padding dan ruang indikator badge (~42px)
                const availWidth = Math.max(containerWidth - 36, 260);
                const availHeight = Math.max(containerHeight - 74, 360);

                // 1. Render Halaman 1 (Pratinjau Bebas, tampil penuh tanpa terpotong baik Landscape maupun Portrait)
                loadedPdf.getPage(1).then(function (page1) {
                    const unscaledViewport = page1.getViewport({ scale: 1 });

                    // Skala proporsional agar 1 halaman tampil utuh tanpa terpotong
                    const scaleX = availWidth / unscaledViewport.width;
                    const scaleY = availHeight / unscaledViewport.height;
                    const fitScale = Math.min(scaleX, scaleY);

                    const displayWidth = Math.round(unscaledViewport.width * fitScale);
                    const displayHeight = Math.round(unscaledViewport.height * fitScale);

                    // Sesuaikan ukuran wrapper kertas mengikuti proporsi dokumen asli (Portrait maupun Landscape)
                    if (paper1) {
                        paper1.classList.add('has-pdf');
                        paper1.style.width = displayWidth + 'px';
                        paper1.style.height = displayHeight + 'px';
                        paper1.style.maxWidth = '100%';
                        paper1.style.aspectRatio = 'auto';
                    }
                    if (paper2 && loadedPdf.numPages < 2) {
                        paper2.classList.add('has-pdf');
                        paper2.style.width = displayWidth + 'px';
                        paper2.style.height = displayHeight + 'px';
                        paper2.style.maxWidth = '100%';
                        paper2.style.aspectRatio = 'auto';
                    }

                    // Render Canvas dengan High-DPI
                    const dpr = window.devicePixelRatio || 1;
                    const viewport1 = page1.getViewport({ scale: fitScale * dpr });

                    if (renderTask1) {
                        try { renderTask1.cancel(); } catch (e) {}
                    }

                    canvas1.width = viewport1.width;
                    canvas1.height = viewport1.height;
                    canvas1.style.width = displayWidth + 'px';
                    canvas1.style.height = displayHeight + 'px';
                    canvas1.style.maxWidth = '100%';
                    canvas1.style.display = 'block';

                    if (fallback1) fallback1.style.display = 'none';

                    const context1 = canvas1.getContext('2d');
                    renderTask1 = page1.render({
                        canvasContext: context1,
                        viewport: viewport1
                    });
                });

                // 2. Render Halaman 2 (Terkunci & Buram)
                if (canvas2 && loadedPdf.numPages >= 2) {
                    loadedPdf.getPage(2).then(function (page2) {
                        const unscaledViewport2 = page2.getViewport({ scale: 1 });
                        const scaleX2 = availWidth / unscaledViewport2.width;
                        const scaleY2 = availHeight / unscaledViewport2.height;
                        const fitScale2 = Math.min(scaleX2, scaleY2);

                        const displayWidth2 = Math.round(unscaledViewport2.width * fitScale2);
                        const displayHeight2 = Math.round(unscaledViewport2.height * fitScale2);

                        if (paper2) {
                            paper2.classList.add('has-pdf');
                            paper2.style.width = displayWidth2 + 'px';
                            paper2.style.height = displayHeight2 + 'px';
                            paper2.style.maxWidth = '100%';
                            paper2.style.aspectRatio = 'auto';
                        }

                        const dpr = window.devicePixelRatio || 1;
                        const viewport2 = page2.getViewport({ scale: fitScale2 * dpr });

                        if (renderTask2) {
                            try { renderTask2.cancel(); } catch (e) {}
                        }

                        canvas2.width = viewport2.width;
                        canvas2.height = viewport2.height;
                        canvas2.style.width = displayWidth2 + 'px';
                        canvas2.style.height = displayHeight2 + 'px';
                        canvas2.style.maxWidth = '100%';
                        canvas2.style.display = 'block';

                        if (fallback2) fallback2.style.display = 'none';

                        const context2 = canvas2.getContext('2d');
                        renderTask2 = page2.render({
                            canvasContext: context2,
                            viewport: viewport2
                        });
                    });
                }
            }

            pdfjsLib.getDocument(fileUrl).promise.then(function (pdf) {
                loadedPdf = pdf;
                renderDocumentPages();

                // Listener saat jendela di-resize / reflow kontainer agar orientasi & skala dokumen selalu tepat
                let resizeTimer;
                if (window.ResizeObserver && scrollContainer) {
                    const resizeObserver = new ResizeObserver(function () {
                        clearTimeout(resizeTimer);
                        resizeTimer = setTimeout(renderDocumentPages, 100);
                    });
                    resizeObserver.observe(scrollContainer);
                } else {
                    window.addEventListener('resize', function () {
                        clearTimeout(resizeTimer);
                        resizeTimer = setTimeout(renderDocumentPages, 200);
                    });
                }
            }).catch(function (err) {
                console.log('Pratinjau dokumen:', err);
            });
        }
    });
</script>
@endpush
