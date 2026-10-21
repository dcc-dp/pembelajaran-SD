@extends('guest.layouts.guest')

@section('title', 'Preview Perangkat Ajar')

@section('content')

<section class="py-5 py-md-6 bg-white border-bottom position-relative">
    <div class="container-xl">
        <div class="text-center mx-auto" style="max-width: 840px;">
            <div class="mb-3">
                <span class="about-platform-badge">
                    Pusat Sumber Daya Guru
                </span>
            </div>
            <h1 class="hero-title text-dark mb-3">
                Lihat Preview Perangkat Ajar <br class="d-none d-md-inline"><span style="color: #b7141b;">Sebelum Berlangganan</span>
            </h1>
            <p class="hero-desc text-secondary mx-auto mb-0" style="max-width: 780px; line-height: 1.8;">
                Pastikan kualitas materi sesuai dengan kebutuhan Anda. Eksplorasi sampel modul ajar, materi presentasi, dan bank soal terpilih secara gratis sebelum memilih paket langganan.
            </p>
        </div>
    </div>
</section>

<!-- FILTER DAN DAFTAR MATERI -->
<section class="py-5 py-md-6" id="katalog-materi" style="background-color: #f8fafc;">
    <div class="container-xl">

        <div class="preview-filter-card mb-4 mb-md-5">
            <form action="{{ route('guest.preview-materi') }}" method="GET" class="row g-3 align-items-end">
                {{-- Filter Semester --}}
                <div class="col-12 col-sm-6 col-lg-3">
                    <label class="form-label small fw-semibold text-secondary mb-1">Semester</label>
                    <select name="semester_id" class="form-select rounded-3">
                        <option value="">Semua Semester</option>
                        @foreach($semesterList as $semester)
                            <option value="{{ $semester->id }}" {{ request('semester_id') == $semester->id ? 'selected' : '' }}>
                                {{ $semester->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-sm-6 col-lg-3">
                    <label class="form-label small fw-semibold text-secondary mb-1">Kelas</label>
                    <select name="kelas_id" class="form-select rounded-3">
                        <option value="">Semua Kelas</option>
                        @foreach($kelasList as $kelas)
                            <option value="{{ $kelas->id }}" {{ request('kelas_id') == $kelas->id ? 'selected' : '' }}>
                                {{ $kelas->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-sm-6 col-lg-3">
                    <label class="form-label small fw-semibold text-secondary mb-1">Mata Pelajaran</label>
                    <select name="mata_pelajaran_id" class="form-select rounded-3">
                        <option value="">Semua Mapel</option>
                        @foreach($mataPelajaranList as $mapel)
                            <option value="{{ $mapel->id }}" {{ request('mata_pelajaran_id') == $mapel->id ? 'selected' : '' }}>
                                {{ $mapel->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-sm-6 col-lg-3 d-flex gap-2">
                    <button type="submit" class="btn btn-sd-orange flex-grow-1 rounded-3">
                        <i class="ti ti-search me-1"></i> Tampilkan Preview
                    </button>
                    @if(request()->hasAny(['semester_id', 'kelas_id', 'mata_pelajaran_id', 'search']))
                        <a href="{{ route('guest.preview-materi') }}" class="btn btn-outline-secondary rounded-3" title="Reset Filter">
                            <i class="ti ti-refresh"></i>
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2 mb-4">
            <div>
                <h2 class="section-title text-dark mb-0">Sampel Materi Pilihan</h2>
                <br>
                <p class="text-secondary small mb-0">Temukan perangkat ajar yang ingin Anda telaah secara langsung</p>
            </div>
            <div class="text-sm-end text-muted small">
                Menampilkan <strong>{{ $repositories->total() }}</strong> hasil
            </div>
        </div>

        <div class="row g-4">
            @forelse($repositories as $item)
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
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="preview-item-card">
                        {{-- Card Header Cover --}}
                        @if($item->sampul_url)
                            <div class="preview-card-cover has-image">
                                <img src="{{ $item->sampul_url }}" alt="{{ $item->judul }}" class="preview-card-img-cover">
                                <div class="preview-card-img-overlay"></div>
                                <div class="preview-cover-top">
                                    <span class="badge-doc-format {{ $formatClass }}">
                                        <i class="ti ti-file-text me-1"></i> {{ $formatLabel }}
                                    </span>
                                    <span class="badge-preview-tag">
                                        <i class="ti ti-eye me-1"></i> Preview
                                    </span>
                                </div>
                            </div>
                        @else
                            <div class="preview-card-cover has-fallback" style="background: {{ $item->thematic_theme['gradient'] }};">
                                <div class="preview-thematic-pattern"></div>
                                <div class="preview-cover-top">
                                    <span class="badge-doc-format {{ $formatClass }}">
                                        <i class="ti ti-file-text me-1"></i> {{ $formatLabel }}
                                    </span>
                                    <span class="badge-preview-tag">
                                        <i class="ti ti-eye me-1"></i> Preview
                                    </span>
                                </div>

                                <div class="preview-thematic-center">
                                    <div class="preview-thematic-icon-box">
                                        <i class="{{ $item->thematic_theme['icon'] }}"></i>
                                    </div>
                                    <span class="preview-thematic-mapel-pill">
                                        {{ $item->mataPelajaran?->nama ?? 'Perangkat Ajar' }}
                                    </span>
                                </div>
                            </div>
                        @endif

                        <div class="p-4 d-flex flex-column flex-grow-1 justify-content-between">
                            <div>
                                <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                                    <span class="badge bg-danger-subtle text-danger fw-semibold px-2 py-1">
                                        {{ $item->mataPelajaran?->nama ?? 'Umum' }}
                                    </span>
                                    <span class="badge bg-secondary-subtle text-secondary fw-semibold px-2 py-1">
                                        {{ $item->kelas?->nama ?? 'Semua Kelas' }} &bull; {{ $item->semester?->nama ?? 'Semester 1' }}
                                    </span>
                                </div>

                                <h3 class="fw-bold text-dark fs-3 mb-2" style="line-height: 1.35; min-height: 2.7rem;">
                                    {{ $item->judul }}
                                </h3>

                                <p class="text-secondary small mb-3" style="line-height: 1.6; min-height: 3rem;">
                                    {{ Str::limit($item->deskripsi ?: 'Perangkat ajar terstandarisasi untuk mendukung kegiatan belajar mengajar aktif dan terstruktur.', 85) }}
                                </p>
                            </div>

                            <div class="pt-3 border-top d-flex align-items-center justify-content-between mt-auto">
                                <small class="text-muted d-flex align-items-center gap-1">
                                    <i class="ti ti-clock"></i>
                                    <span>{{ $item->updated_at ? (is_string($item->updated_at) ? $item->updated_at : $item->updated_at->format('d M Y')) : 'Terbaru' }}</span>
                                </small>
                                <a href="{{ route('guest.preview-materi.show', $item->id) }}" class="btn btn-outline-danger btn-sm rounded-pill px-3 fw-semibold">
                                    Lihat Preview
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="bg-white border rounded-3 p-5 text-center my-3">
                        <div class="avatar avatar-xl rounded-circle bg-danger-subtle text-danger mb-3 mx-auto">
                            <i class="ti ti-folder-off fs-1"></i>
                        </div>
                        <h4 class="fw-bold text-dark mb-2">Belum Ada Materi yang Sesuai</h4>
                        <p class="text-secondary small mb-4" style="max-width: 440px; margin: 0 auto;">
                            Tidak ditemukan sampel perangkat ajar berdasarkan filter yang Anda pilih. Coba sesuaikan filter atau reset untuk melihat semua materi.
                        </p>
                        <a href="{{ route('guest.preview-materi') }}" class="btn btn-sd-orange rounded-pill px-4">
                            Tampilkan Semua Materi
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        @if($repositories->hasPages())
            <div class="d-flex justify-content-center mt-5">
                {{ $repositories->links() }}
            </div>
        @endif

    </div>
</section>


<section class="py-5 py-md-6 border-top" style="background-color: #f8fafc;">
    <div class="container-xl">
        <div class="cta-banner-gradient text-center">
            <h2 class="cta-banner-title text-white mb-3 mx-auto" style="max-width: 650px;">
                Puas dengan Kualitas Materi Kami?
            </h2>
            <p class="cta-banner-desc text-white-50 mb-4 mx-auto" style="max-width: 580px;">
                Dapatkan akses tak terbatas ke ribuan perangkat ajar lainnya dengan berlangganan paket tahunan sekarang juga.
            </p>
            <div class="d-flex flex-column flex-sm-row justify-content-center align-items-center gap-3">
                <a href="{{ route('guest.paket-langganan') }}" class="btn-cta-white shadow px-4 py-2 py-md-3">
                    Berlangganan Sekarang <i class="ti ti-arrow-right ms-1"></i>
                </a>
                <a href="{{ route('register') }}" class="btn btn-outline-light rounded-pill px-4 py-2 py-md-3 fw-semibold">
                    Daftar Akun Baru
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
