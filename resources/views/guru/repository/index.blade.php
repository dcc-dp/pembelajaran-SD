@extends('guru.layouts.guru')

@section('title', 'Repository Pembelajaran')

@section('content')
<div class="guru-repository-wrapper d-flex flex-column gap-4">

    {{-- Alert Messages --}}
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

    {{-- Page Header --}}
    <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between gap-2 pb-1">
        <div>
            <h1 class="page-title text-dark fw-bold mb-1" style="font-size: 1.55rem; letter-spacing: -0.02em;">
                Repository Pembelajaran
            </h1>
            <p class="text-secondary small mb-0">
                Katalog modul ajar, RPP, LKPD, dan administrasi guru terstandar Kurikulum Merdeka & K13.
            </p>
        </div>
        <div class="d-flex align-items-center gap-2 flex-shrink-0">
            <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2 rounded-2 fw-semibold small">
                <i class="ti ti-folders me-1"></i> Perangkat Ajar SD
            </span>
        </div>
    </div>

    {{-- Filter Card (Unified Clean Layout) --}}
    <div class="guru-filter-card">
        {{-- Card Header: Tab Semester & Akses Terintegrasi --}}
        <div class="guru-filter-card-header">
            <ul class="guru-filter-nav-list">
                <li>
                    <a href="{{ request()->fullUrlWithQuery(['semester_id' => null, 'page' => 1]) }}"
                       class="guru-filter-nav-btn {{ !request('semester_id') && request('akses') !== 'milik_saya' ? 'active' : '' }}">
                        <i class="ti ti-books"></i>
                        <span>Semua Semester</span>
                        <span class="badge-pill-count">{{ $totalTersedia }}</span>
                    </a>
                </li>
                @foreach($semesters as $sem)
                    <li>
                        <a href="{{ request()->fullUrlWithQuery(['semester_id' => $sem->id, 'akses' => null, 'page' => 1]) }}"
                           class="guru-filter-nav-btn {{ request('semester_id') == $sem->id && request('akses') !== 'milik_saya' ? 'active' : '' }}">
                            <i class="ti ti-calendar"></i>
                            <span>{{ $sem->nama }}</span>
                        </a>
                    </li>
                @endforeach
                <li>
                    <a href="{{ request()->fullUrlWithQuery(['akses' => request('akses') === 'milik_saya' ? null : 'milik_saya', 'page' => 1]) }}"
                       class="guru-filter-nav-btn {{ request('akses') === 'milik_saya' ? 'active' : '' }}">
                        <i class="ti ti-circle-check"></i>
                        <span>Akses Saya</span>
                        <span class="badge-pill-count">{{ $totalAksesSaya }}</span>
                    </a>
                </li>
            </ul>

            <div class="text-secondary small fw-medium d-none d-sm-block">
                Total <strong>{{ $repositories->total() }}</strong> materi ditemukan
            </div>
        </div>

        {{-- Card Body: Filter Inputs --}}
        <div class="guru-filter-card-body">
            <form method="GET" action="{{ route('guru.repository.index') }}" id="guru-repo-filter-form">
                @if(request('akses'))
                    <input type="hidden" name="akses" value="{{ request('akses') }}">
                @endif
                @if(request('semester_id'))
                    <input type="hidden" name="semester_id" value="{{ request('semester_id') }}">
                @endif

                <div class="row g-2 align-items-center">
                    {{-- Search Box --}}
                    <div class="col-12 col-md-5">
                        <div class="input-icon">
                            <span class="input-icon-addon">
                                <i class="ti ti-search text-muted"></i>
                            </span>
                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                class="form-control"
                                placeholder="Cari judul materi, topik, atau kata kunci..."
                            >
                        </div>
                    </div>

                    {{-- Dropdown Kelas --}}
                    <div class="col-6 col-sm-4 col-md-2">
                        <select name="kelas_id" class="form-select" onchange="this.form.submit()">
                            <option value="">Semua Kelas</option>
                            @foreach($kelas as $k)
                                <option value="{{ $k->id }}" {{ request('kelas_id') == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Dropdown Mata Pelajaran --}}
                    <div class="col-6 col-sm-4 col-md-3">
                        <select name="mata_pelajaran_id" class="form-select" onchange="this.form.submit()">
                            <option value="">Semua Mapel</option>
                            @foreach($mataPelajarans as $mapel)
                                <option value="{{ $mapel->id }}" {{ request('mata_pelajaran_id') == $mapel->id ? 'selected' : '' }}>
                                    {{ $mapel->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Dropdown Jenis Dokumen --}}
                    <div class="col-12 col-sm-4 col-md-2">
                        <select name="jenis_dokumen_id" class="form-select" onchange="this.form.submit()">
                            <option value="">Semua Jenis</option>
                            @foreach($jenisDokumens as $jenis)
                                <option value="{{ $jenis->id }}" {{ request('jenis_dokumen_id') == $jenis->id ? 'selected' : '' }}>
                                    {{ $jenis->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Pilihan Cepat Jenis Perangkat Ajar (Sesuai Kategori Standar: Sampul, ATP, Prota, Prosem, KKTP, Jurnal, Modul) --}}
                @if($jenisDokumens->count() > 0)
                    <div class="d-flex align-items-center gap-2 flex-wrap pt-3 mt-3 border-top">
                        <span class="text-secondary small fw-semibold me-1">
                            <i class="ti ti-printer me-1 text-danger"></i>Perangkat Ajar:
                        </span>
                        <a href="{{ request()->fullUrlWithQuery(['jenis_dokumen_id' => null, 'page' => 1]) }}"
                           class="btn btn-sm rounded-pill px-3 {{ !request('jenis_dokumen_id') ? 'btn-danger text-white fw-semibold' : 'btn-outline-secondary' }}">
                            Semua
                        </a>
                        @foreach($jenisDokumens as $jenis)
                            <a href="{{ request()->fullUrlWithQuery(['jenis_dokumen_id' => $jenis->id, 'page' => 1]) }}"
                               class="btn btn-sm rounded-pill px-3 {{ request('jenis_dokumen_id') == $jenis->id ? 'btn-danger text-white fw-semibold' : 'btn-outline-secondary' }}">
                                {{ $jenis->nama }}
                            </a>
                        @endforeach
                    </div>
                @endif

                {{-- Status Filter Aktif & Reset Link --}}
                @if(request()->hasAny(['search', 'kelas_id', 'semester_id', 'mata_pelajaran_id', 'jenis_dokumen_id', 'akses']))
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 pt-3 mt-3 border-top">
                        <div class="d-flex align-items-center gap-1.5 flex-wrap small">
                            <span class="text-secondary fw-semibold me-1">Filter Aktif:</span>
                            @if(request('semester_id'))
                                @php $namaSemester = $semesters->firstWhere('id', request('semester_id'))?->nama; @endphp
                                <span class="guru-active-chip">
                                    <i class="ti ti-calendar me-1"></i> {{ $namaSemester }}
                                </span>
                            @endif
                            @if(request('search'))
                                <span class="guru-active-chip">
                                    Kata Kunci: "{{ request('search') }}"
                                </span>
                            @endif
                            @if(request('kelas_id'))
                                @php $namaKelas = $kelas->firstWhere('id', request('kelas_id'))?->nama; @endphp
                                <span class="guru-active-chip">
                                    {{ $namaKelas }}
                                </span>
                            @endif
                            @if(request('mata_pelajaran_id'))
                                @php $namaMapel = $mataPelajarans->firstWhere('id', request('mata_pelajaran_id'))?->nama; @endphp
                                <span class="guru-active-chip">
                                    {{ $namaMapel }}
                                </span>
                            @endif
                            @if(request('jenis_dokumen_id'))
                                @php $namaJenis = $jenisDokumens->firstWhere('id', request('jenis_dokumen_id'))?->nama; @endphp
                                <span class="guru-active-chip">
                                    {{ $namaJenis }}
                                </span>
                            @endif
                            @if(request('akses') === 'milik_saya')
                                <span class="guru-active-chip">
                                    <i class="ti ti-circle-check me-1"></i> Akses Saya
                                </span>
                            @endif
                        </div>

                        <a href="{{ route('guru.repository.index') }}"
                           class="text-danger small fw-semibold text-decoration-none d-inline-flex align-items-center gap-1">
                            <i class="ti ti-x"></i> Reset Filter
                        </a>
                    </div>
                @endif
            </form>
        </div>
    </div>

    {{-- Grid Materi Pembelajaran --}}
    @if($repositories->count() > 0)
        <div class="row g-4">
            @foreach($repositories as $item)
                @php
                    $isSubscribed = in_array($item->semester_id, $activeSubscribedSemesterIds) || auth()->user()->hasRole('Super Admin');
                    $canAccess = ($item->akses === 'gratis') || $isSubscribed;
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
                    <div class="guru-preview-card">
                        
                        {{-- Card Header Cover (Tinggi Proporsional 190px) --}}
                        @if($item->sampul_url)
                            <div class="guru-card-cover has-image">
                                <img src="{{ $item->sampul_url }}" alt="{{ $item->judul }}" class="guru-card-img-cover">
                                <div class="guru-card-img-overlay"></div>
                                <div class="guru-cover-top">
                                    <span class="badge-doc-format {{ $formatClass }}">
                                        <i class="ti ti-file-text me-1"></i> {{ $formatLabel }}
                                    </span>

                                    {{-- Status Berlangganan / Akses Badge --}}
                                    @if($item->akses === 'gratis')
                                        <span class="badge-sub-status free">
                                            <i class="ti ti-lock-open"></i> Gratis
                                        </span>
                                    @elseif($isSubscribed)
                                        <span class="badge-sub-status active">
                                            <i class="ti ti-circle-check"></i> Akses Aktif
                                        </span>
                                    @else
                                        <span class="badge-sub-status locked">
                                            <i class="ti ti-lock"></i> Perlu Langganan
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="guru-card-cover" style="background: {{ $item->thematic_theme['gradient'] }};">
                                <div class="preview-thematic-pattern"></div>
                                <div class="guru-cover-top">
                                    <span class="badge-doc-format {{ $formatClass }}">
                                        <i class="ti ti-file-text me-1"></i> {{ $formatLabel }}
                                    </span>

                                    {{-- Status Berlangganan / Akses Badge --}}
                                    @if($item->akses === 'gratis')
                                        <span class="badge-sub-status free">
                                            <i class="ti ti-lock-open"></i> Gratis
                                        </span>
                                    @elseif($isSubscribed)
                                        <span class="badge-sub-status active">
                                            <i class="ti ti-circle-check"></i> Akses Aktif
                                        </span>
                                    @else
                                        <span class="badge-sub-status locked">
                                            <i class="ti ti-lock"></i> Perlu Langganan
                                        </span>
                                    @endif
                                </div>

                                <div class="guru-thematic-center">
                                    <div class="guru-thematic-icon-box">
                                        <i class="{{ $item->thematic_theme['icon'] }}"></i>
                                    </div>
                                    <span class="guru-thematic-mapel-pill">
                                        {{ $item->mataPelajaran?->nama ?? 'Perangkat Ajar' }}
                                    </span>
                                </div>
                            </div>
                        @endif

                        {{-- Card Body --}}
                        <div class="p-4 d-flex flex-column flex-grow-1 justify-content-between">
                            <div>
                                {{-- Meta Badges Row (Mata Pelajaran, Kelas, dan Status Langganan) --}}
                                <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                                    <span class="badge bg-danger-subtle text-danger fw-semibold px-2 py-1 rounded-pill">
                                        {{ $item->mataPelajaran?->nama ?? 'Umum' }}
                                    </span>
                                    <span class="badge bg-secondary-subtle text-secondary fw-semibold px-2 py-1 rounded-pill">
                                        {{ $item->kelas?->nama ?? 'Semua Kelas' }} &bull; {{ $item->semester?->nama ?? 'Semester 1' }}
                                    </span>
                                    @if($item->akses === 'gratis')
                                        <span class="badge bg-success-subtle text-success fw-semibold px-2 py-1 rounded-pill">
                                            <i class="ti ti-lock-open me-1"></i> Gratis
                                        </span>
                                    @elseif($isSubscribed)
                                        <span class="badge bg-success-subtle text-success fw-semibold px-2 py-1 rounded-pill">
                                            <i class="ti ti-circle-check me-1"></i> Langganan Aktif
                                        </span>
                                    @else
                                        <span class="badge bg-warning-subtle text-warning-emphasis fw-semibold px-2 py-1 rounded-pill">
                                            <i class="ti ti-lock me-1"></i> Perlu Langganan
                                        </span>
                                    @endif
                                </div>

                                {{-- Judul Dokumen (Besar, Bold, Bersih) --}}
                                <h3 class="fw-bold text-dark fs-3 mb-2" style="line-height: 1.35; min-height: 2.7rem;">
                                    <a href="{{ route('guru.repository.show', $item) }}" class="text-dark text-decoration-none hover-primary">
                                        {{ $item->judul }}
                                    </a>
                                </h3>

                                {{-- Deskripsi Ringkas --}}
                                <p class="text-secondary small mb-3" style="line-height: 1.6; min-height: 2.8rem;">
                                    {{ Str::limit($item->deskripsi ?: 'Perangkat ajar terstandarisasi untuk mendukung kegiatan belajar mengajar aktif dan terstruktur.', 95) }}
                                </p>
                            </div>

                            {{-- Footer Aksi --}}
                            <div class="pt-3 border-top d-flex align-items-center justify-content-between mt-auto">
                                <small class="text-muted d-flex align-items-center gap-1">
                                    <i class="ti ti-clock"></i>
                                    <span>{{ $item->created_at?->format('d M Y') ?? 'Terbaru' }}</span>
                                </small>

                                <div class="d-flex align-items-center gap-2" style="gap: 8px !important;">
                                    @if($canAccess)
                                        <a href="{{ route('guru.repository.show', $item) }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3 fw-semibold">
                                            Baca Materi
                                        </a>
                                        <a href="{{ route('guru.repository.show', [$item, 'print' => 1]) }}" class="btn btn-danger btn-sm rounded-pill px-3 fw-semibold d-inline-flex align-items-center gap-1 shadow-xs" title="Cetak Dokumen Langsung">
                                            <i class="ti ti-printer"></i> Cetak
                                        </a>
                                    @else
                                        <a href="{{ route('guru.repository.show', $item) }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3 fw-semibold">
                                            Pratinjau
                                        </a>
                                        <a href="{{ route('guru.langganan.index') }}" class="btn btn-warning text-dark btn-sm rounded-pill px-3 fw-semibold d-inline-flex align-items-center gap-1 shadow-xs">
                                            <i class="ti ti-lock"></i> Langganan
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination Nav --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 pt-3">
            <div class="text-secondary small">
                Menampilkan <strong>{{ $repositories->firstItem() }}</strong> - <strong>{{ $repositories->lastItem() }}</strong> dari <strong>{{ $repositories->total() }}</strong> materi
            </div>
            <div>
                {{ $repositories->links() }}
            </div>
        </div>
    @else
        {{-- Empty State (Bersih & Rapi) --}}
        <div class="bg-white rounded-3 p-5 text-center border shadow-sm my-3">
            <div class="avatar avatar-xl rounded-circle bg-light text-secondary mb-3 mx-auto">
                <i class="ti ti-folder-off fs-1 text-muted"></i>
            </div>
            <h3 class="fw-bold text-dark mb-1">Materi Tidak Ditemukan</h3>
            <p class="text-secondary small mb-3" style="max-width: 420px; margin: 0 auto;">
                Tidak ada dokumen yang cocok dengan filter atau kata kunci yang Anda masukkan.
            </p>
            <a href="{{ route('guru.repository.index') }}" class="btn btn-outline-secondary rounded-pill px-4 btn-sm">
                <i class="ti ti-refresh me-1"></i> Reset Semua Filter
            </a>
        </div>
    @endif

</div>
@endsection
