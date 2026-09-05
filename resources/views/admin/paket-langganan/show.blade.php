@extends('admin.layouts.admin')

@section('title', 'Detail Paket: ' . $paketLangganan->nama)
@section('page-title', 'Detail Paket Langganan')
@section('page-description', 'Informasi lengkap spesifikasi dan metrik paket langganan.')

@section('page-breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}" class="text-secondary text-decoration-none">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.paket-langganan.index') }}" class="text-secondary text-decoration-none">Paket Langganan</a>
            </li>
            <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">
                Detail Paket
            </li>
        </ol>
    </nav>
@endsection

@section('page-actions')
    <a href="{{ route('admin.paket-langganan.edit', $paketLangganan) }}" class="btn btn-primary rounded-pill px-4">
        <i class="ti ti-pencil me-1"></i>
        Edit Paket
    </a>
    <a href="{{ route('admin.paket-langganan.index') }}" class="btn btn-light border rounded-pill px-4">
        <i class="ti ti-arrow-left me-1"></i>
        Kembali
    </a>
@endsection

@section('content')

    <div class="row g-4">

        {{-- Left Column: Main Info --}}
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header py-3 d-flex align-items-center justify-content-between">
                    <h3 class="card-title">Informasi Paket</h3>
                    @if($paketLangganan->status === 'aktif')
                        <span class="badge bg-success-lt text-success">
                            <i class="ti ti-check me-1"></i>
                            Aktif
                        </span>
                    @else
                        <span class="badge bg-secondary-lt text-secondary">
                            Tidak Aktif
                        </span>
                    @endif
                </div>

                <div class="card-body p-4">
                    <div class="mb-4">
                        <div class="text-secondary small fw-bold text-uppercase mb-1" style="letter-spacing: 0.05em;">
                            Nama Paket
                        </div>
                        <h2 class="fw-bold text-dark mb-0">
                            {{ $paketLangganan->nama }}
                        </h2>
                    </div>

                    <div class="mb-4">
                        <div class="text-secondary small fw-bold text-uppercase mb-1" style="letter-spacing: 0.05em;">
                            Deskripsi
                        </div>
                        <div class="text-muted bg-light p-3 rounded-3 border">
                            {{ $paketLangganan->deskripsi ?: 'Tidak ada deskripsi tambahan untuk paket ini.' }}
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="p-3 border rounded-3 bg-white">
                                <div class="text-secondary small fw-bold text-uppercase mb-1" style="letter-spacing: 0.05em;">
                                    Tingkat Kelas
                                </div>
                                <div class="fw-bold text-dark fs-4">
                                    {{ $paketLangganan->kelas->nama ?? '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="p-3 border rounded-3 bg-white">
                                <div class="text-secondary small fw-bold text-uppercase mb-1" style="letter-spacing: 0.05em;">
                                    Semester
                                </div>
                                <div class="fw-bold text-dark fs-4">
                                    {{ $paketLangganan->semester?->nama ?? 'Semua Semester' }}
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="p-3 border rounded-3 bg-white">
                                <div class="text-secondary small fw-bold text-uppercase mb-1" style="letter-spacing: 0.05em;">
                                    Biaya Berlangganan
                                </div>
                                <div class="fw-bold text-danger fs-3">
                                    Rp {{ number_format($paketLangganan->harga, 0, ',', '.') }}
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="p-3 border rounded-3 bg-white">
                                <div class="text-secondary small fw-bold text-uppercase mb-1" style="letter-spacing: 0.05em;">
                                    Masa Aktif
                                </div>
                                <div class="fw-bold text-dark fs-4">
                                    {{ $paketLangganan->durasi_bulan }} Bulan
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-light py-3 d-flex align-items-center gap-2">
                    <a href="{{ route('admin.paket-langganan.edit', $paketLangganan) }}" class="btn btn-primary rounded-pill px-4">
                        <i class="ti ti-pencil me-1"></i>
                        Edit Data Paket
                    </a>
                    <a href="{{ route('admin.paket-langganan.index') }}" class="btn btn-light border rounded-pill px-4">
                        Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>

        {{-- Right Column: Metrics & Summary --}}
        <div class="col-lg-4">
            <div class="row g-3">

                {{-- Metric 1: Total Pelanggan --}}
                <div class="col-12">
                    <div class="card-stat-modern">
                        <div class="d-flex align-items-center gap-3">
                            <div class="stat-icon-box tint-blue">
                                <i class="ti ti-users"></i>
                            </div>
                            <div>
                                <div class="stat-label">TOTAL PELANGGAN</div>
                                <div class="stat-number">{{ $paketLangganan->langganans->count() }}</div>
                                <div class="stat-subtext">Guru aktif menggunakan paket ini</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Metric 2: Durasi --}}
                <div class="col-12">
                    <div class="card-stat-modern">
                        <div class="d-flex align-items-center gap-3">
                            <div class="stat-icon-box tint-green">
                                <i class="ti ti-calendar"></i>
                            </div>
                            <div>
                                <div class="stat-label">DURASI AKSES</div>
                                <div class="stat-number">{{ $paketLangganan->durasi_bulan }} <span class="fs-4 fw-normal text-muted">Bulan</span></div>
                                <div class="stat-subtext">Masa berlaku sejak pembayaran terverifikasi</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Metric 3: Estimasi Per Bulan --}}
                <div class="col-12">
                    <div class="card-stat-modern">
                        <div class="d-flex align-items-center gap-3">
                            <div class="stat-icon-box tint-orange">
                                <i class="ti ti-tag"></i>
                            </div>
                            <div>
                                <div class="stat-label">TARIF EFEKTIF / BULAN</div>
                                @php
                                    $perBulan = $paketLangganan->durasi_bulan > 0 ? round($paketLangganan->harga / $paketLangganan->durasi_bulan) : $paketLangganan->harga;
                                @endphp
                                <div class="stat-number fs-3">Rp {{ number_format($perBulan, 0, ',', '.') }}</div>
                                <div class="stat-subtext">Nilai investasi edukasi per bulan</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection