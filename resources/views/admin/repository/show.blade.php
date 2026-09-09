@extends('admin.layouts.admin')

@section('title', 'Detail Repository: ' . $repository->judul)
@section('page-title', 'Detail Repository')
@section('page-description', 'Informasi lengkap spesifikasi dan berkas dokumen pembelajaran.')

@section('page-breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}" class="text-secondary text-decoration-none">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <span class="text-secondary">Layanan</span>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.repository.index') }}" class="text-secondary text-decoration-none">Repository</a>
            </li>
            <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">
                Detail
            </li>
        </ol>
    </nav>
@endsection

@section('page-actions')
    <a href="{{ route('admin.repository.edit', $repository) }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
        <i class="ti ti-pencil me-1"></i>
        Edit Repository
    </a>
    <a href="{{ route('admin.repository.index') }}" class="btn btn-light border rounded-pill px-4">
        <i class="ti ti-arrow-left me-1"></i>
        Kembali
    </a>
    
@endsection

@section('content')

    {{-- Alert Danger / Error --}}
    @if(session('danger') || session('error'))
        <div class="alert alert-danger alert-dismissible shadow-sm border-0 mb-4" role="alert">
            <div class="d-flex align-items-center">
                <i class="ti ti-alert-circle fs-2 me-2 text-danger"></i>
                <div class="fw-medium">
                    {{ session('danger') ?? session('error') }}
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
        </div>
    @endif

    <div class="row g-4">

        {{-- Left Column: Main Info --}}
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header py-3 bg-white border-bottom d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <h3 class="card-title fw-bold text-dark mb-0">Informasi Dokumen</h3>
                    <div class="d-flex align-items-center gap-2">
                        @if($repository->akses === 'gratis')
                            <span class="badge bg-success-lt text-success">
                                <i class="ti ti-gift me-1"></i> Gratis
                            </span>
                        @else
                            <span class="badge bg-warning-lt text-warning">
                                <i class="ti ti-crown me-1"></i> Premium
                            </span>
                        @endif

                        @if($repository->status === 'dipublikasikan')
                            <span class="badge bg-success-lt text-success">
                                <i class="ti ti-check me-1"></i> Dipublikasikan
                            </span>
                        @elseif($repository->status === 'draft')
                            <span class="badge bg-secondary-lt text-secondary">
                                <i class="ti ti-pencil me-1"></i> Draft
                            </span>
                        @else
                            <span class="badge bg-danger-lt text-danger">
                                <i class="ti ti-archive me-1"></i> Diarsipkan
                            </span>
                        @endif
                    </div>
                </div>

                <div class="card-body p-4">
                    {{-- Judul --}}
                    <div class="mb-4">
                        <div class="text-secondary small fw-bold text-uppercase mb-1" style="letter-spacing: 0.05em;">
                            Judul Repository
                        </div>
                        <h2 class="fw-bold text-dark mb-0">
                            {{ $repository->judul }}
                        </h2>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-4">
                        <div class="text-secondary small fw-bold text-uppercase mb-1" style="letter-spacing: 0.05em;">
                            Deskripsi Materi
                        </div>
                        <div class="text-muted bg-light p-3 rounded-3 border">
                            {{ $repository->deskripsi ?: 'Tidak ada deskripsi tambahan untuk dokumen ini.' }}
                        </div>
                    </div>

                    {{-- Spesifikasi Pembelajaran --}}
                    <div class="row g-3 mb-4">
                        <div class="col-sm-6">
                            <div class="p-3 border rounded-3 bg-white">
                                <div class="text-secondary small fw-bold text-uppercase mb-1" style="letter-spacing: 0.05em;">
                                    Kurikulum
                                </div>
                                <div class="fw-bold text-dark fs-4">
                                    {{ $repository->kurikulum->nama ?? '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="p-3 border rounded-3 bg-white">
                                <div class="text-secondary small fw-bold text-uppercase mb-1" style="letter-spacing: 0.05em;">
                                    Semester
                                </div>
                                <div class="fw-bold text-dark fs-4">
                                    {{ $repository->semester->nama ?? '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="p-3 border rounded-3 bg-white">
                                <div class="text-secondary small fw-bold text-uppercase mb-1" style="letter-spacing: 0.05em;">
                                    Kelas
                                </div>
                                <div class="fw-bold text-dark fs-4">
                                    {{ $repository->kelas->nama ?? '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="p-3 border rounded-3 bg-white">
                                <div class="text-secondary small fw-bold text-uppercase mb-1" style="letter-spacing: 0.05em;">
                                    Mata Pelajaran
                                </div>
                                <div class="fw-bold text-dark fs-4">
                                    {{ $repository->mataPelajaran->nama ?? '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="p-3 border rounded-3 bg-white">
                                <div class="text-secondary small fw-bold text-uppercase mb-1" style="letter-spacing: 0.05em;">
                                    Jenis Dokumen
                                </div>
                                <div class="fw-bold text-dark fs-4">
                                    {{ $repository->jenisDokumen->nama ?? '-' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Informasi Berkas Dokumen --}}
                    <div class="p-3 bg-light border rounded-3">
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar avatar-md bg-primary-subtle text-primary rounded-circle flex-shrink-0">
                                    <i class="ti ti-file-download fs-2"></i>
                                </div>
                                <div>
                                    <div class="text-secondary small fw-medium">Nama Berkas:</div>
                                    <div class="fw-bold text-dark fs-4 text-break">{{ $repository->nama_file }}</div>
                                    <div class="text-secondary small mt-1">
                                        Tipe File: <span class="badge bg-light text-secondary border text-uppercase">{{ $repository->tipe_file }}</span>
                                    </div>
                                </div>
                            </div>

                            @if($repository->file)
                                <a href="{{ route('admin.repository.download', $repository) }}" class="btn btn-success rounded-pill px-4 shadow-sm">
                                    <i class="ti ti-download me-1"></i>
                                    Download File
                                </a>
                            @endif
                        </div>
                    </div>

                </div>

                {{-- Footer Actions --}}
                <div class="card-footer bg-light py-3 d-flex align-items-center gap-2">
                    <a href="{{ route('admin.repository.edit', $repository) }}" class="btn btn-primary rounded-pill px-4">
                        <i class="ti ti-pencil me-1"></i>
                        Edit Data Repository
                    </a>
                    <a href="{{ route('admin.repository.index') }}" class="btn btn-light border rounded-pill px-4">
                        Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>

        {{-- Right Column: Metrics & Summary --}}
        <div class="col-lg-4">
            <div class="row g-3">

                {{-- Metric 1: Hak Akses --}}
                <div class="col-12">
                    <div class="card-stat-modern">
                        <div class="d-flex align-items-center gap-3">
                            <div class="stat-icon-box {{ $repository->akses === 'premium' ? 'tint-orange' : 'tint-green' }}">
                                <i class="ti {{ $repository->akses === 'premium' ? 'ti-crown' : 'ti-gift' }}"></i>
                            </div>
                            <div>
                                <div class="stat-label">HAK AKSES DOKUMEN</div>
                                <div class="stat-number text-uppercase fs-3">
                                    {{ $repository->akses }}
                                </div>
                                <div class="stat-subtext">
                                    {{ $repository->akses === 'premium' ? 'Khusus anggota berlangganan aktif' : 'Dapat diakses oleh seluruh pengguna' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Metric 2: Status Publikasi --}}
                <div class="col-12">
                    <div class="card-stat-modern">
                        <div class="d-flex align-items-center gap-3">
                            <div class="stat-icon-box {{ $repository->status === 'dipublikasikan' ? 'tint-blue' : 'tint-purple' }}">
                                <i class="ti {{ $repository->status === 'dipublikasikan' ? 'ti-broadcast' : 'ti-archive' }}"></i>
                            </div>
                            <div>
                                <div class="stat-label">STATUS TAYANG</div>
                                <div class="stat-number text-capitalize fs-3">
                                    {{ $repository->status }}
                                </div>
                                <div class="stat-subtext">
                                    {{ $repository->status === 'dipublikasikan' ? 'Tersedia di katalog materi guru' : 'Belum dipublikasikan secara umum' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Metric 3: Riwayat Waktu --}}
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header py-3 bg-white border-bottom">
                            <h4 class="card-title fw-bold text-dark mb-0">
                                <i class="ti ti-clock me-2 text-primary"></i>Informasi Waktu
                            </h4>
                        </div>
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                <span class="text-secondary small">Tanggal Dibuat:</span>
                                <span class="fw-semibold text-dark small">
                                    {{ $repository->created_at ? $repository->created_at->translatedFormat('d M Y, H:i') : '-' }}
                                </span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center py-2">
                                <span class="text-secondary small">Terakhir Diperbarui:</span>
                                <span class="fw-semibold text-dark small">
                                    {{ $repository->updated_at ? $repository->updated_at->translatedFormat('d M Y, H:i') : '-' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection
