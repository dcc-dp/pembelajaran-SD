@extends('guru.layouts.guru')

@section('title', 'Dashboard Guru')

@section('content')
<div class="d-flex flex-column gap-4">


    <div class="row g-4 align-items-stretch">

        <div class="col-lg-8">
            <div class="guru-hero-card h-100 d-flex flex-column justify-content-between">
                <div class="row align-items-center">
                    <div class="col-md-7">
                        <h2 class="guru-hero-title mb-1">
                            Selamat Datang, {{ auth()->user()?->nama}}
                        </h2>
                        <div class="guru-hero-school">
                            {{ auth()->user()?->nama_sekolah ?? "SMP 1 Kota Bogor" }}
                        </div>
                        <p class="guru-hero-quote">
                            "Pendidikan adalah senjata paling mematikan di dunia, karena dengan pendidikan, Anda dapat mengubah dunia." — Nelson Mandela
                        </p>
                        <div class="d-flex flex-wrap align-items-center gap-2 mt-3">
                            <a href="{{ route('guru.repository.index') }}" class="btn-hero-solid">
                                <i class="ti ti-compass"></i>
                                <span>Jelajahi Repository</span>
                            </a>
                            <a href="{{ route('guru.langganan.index') }}" class="btn-hero-outline">
                                <i class="ti ti-refresh"></i>
                                <span>Perpanjang Langganan</span>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-5 d-none d-md-flex justify-content-center">
                        <div class="p-3 bg-light rounded-3 border border-light text-center shadow-sm w-100" style="max-width: 250px; background: linear-gradient(135deg, #fff7ed 0%, #fef2f2 100%);">
                            <div class="d-flex align-items-center justify-content-center rounded-2 mb-2 p-3 bg-white shadow-xs">
                                <i class="ti ti-school text-danger" style="font-size: 3.5rem;"></i>
                            </div>
                            <div class="fw-bold text-dark small">Perangkat Ajar SD</div>
                            <div class="text-secondary" style="font-size: 0.7rem;">Kurikulum Merdeka & K13</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="guru-sub-card">
                <div>
                    <div class="guru-sub-header">
                        <div>
                            <div class="guru-sub-title">SD Learning Center</div>
                            <div class="guru-sub-title text-primary">Akses Pembelajaran</div>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            @if($hasAnyActiveSub ?? false)
                                <span class="guru-sub-badge-active">● AKTIF</span>
                                <i class="ti ti-rosette fs-1 text-warning"></i>
                            @else
                                <span class="badge bg-secondary-subtle text-secondary px-2 py-1 rounded-pill small">● NONAKTIF</span>
                            @endif
                        </div>
                    </div>

                    <div class="my-3">
                        <div class="small fw-semibold text-secondary mb-2">Cakupan Paket Anda:</div>
                        <div class="d-flex flex-column gap-2">
                            <div class="d-flex align-items-center justify-content-between p-2 rounded-2 bg-white border">
                                <span class="small fw-medium text-dark"><i class="ti ti-calendar me-1 text-primary"></i> Semester 1</span>
                                @if($activeSubSem1)
                                    <span class="badge bg-success-subtle text-success small">Aktif (s.d {{ \Carbon\Carbon::parse($activeSubSem1->tanggal_berakhir)->format('d M Y') }})</span>
                                @else
                                    <span class="badge bg-light text-muted small">Belum Aktif</span>
                                @endif
                            </div>
                            <div class="d-flex align-items-center justify-content-between p-2 rounded-2 bg-white border">
                                <span class="small fw-medium text-dark"><i class="ti ti-calendar me-1 text-primary"></i> Semester 2</span>
                                @if($activeSubSem2)
                                    <span class="badge bg-success-subtle text-success small">Aktif (s.d {{ \Carbon\Carbon::parse($activeSubSem2->tanggal_berakhir)->format('d M Y') }})</span>
                                @else
                                    <span class="badge bg-light text-muted small">Belum Aktif</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if(($sisaHari ?? 0) > 0)
                        <div class="my-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="text-secondary small fw-semibold">Sisa Waktu Langganan</span>
                                <span class="fw-bold text-dark small">{{ $sisaHari }} Hari lagi</span>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="mt-4">
                    <a href="{{ route('guru.langganan.index') }}" class="btn-sub-renew">
                        <i class="ti ti-refresh"></i>
                        <span>Kelola / Perpanjang Langganan</span>
                    </a>
                </div>
            </div>
        </div>

    </div>

    <div class="row g-3">

        {{-- Stat 1: Total Repository --}}
        <div class="col-sm-6 col-lg-3">
            <div class="guru-stat-card">
                <div class="guru-stat-icon red">
                    <i class="ti ti-folders"></i>
                </div>
                <div>
                    <div class="guru-stat-label">Total Repository</div>
                    <div class="guru-stat-value">{{ number_format($totalRepository ?? 0) }}</div>
                </div>
            </div>
        </div>

        {{-- Stat 2: Total Unduhan --}}
        <div class="col-sm-6 col-lg-3">
            <div class="guru-stat-card">
                <div class="guru-stat-icon orange">
                    <i class="ti ti-download"></i>
                </div>
                <div>
                    <div class="guru-stat-label">Total Unduhan</div>
                    <div class="guru-stat-value">{{ number_format($totalUnduhan ?? 0) }}</div>
                </div>
            </div>
        </div>

        {{-- Stat 3: Status Langganan --}}
        <div class="col-sm-6 col-lg-3">
            <div class="guru-stat-card">
                <div class="guru-stat-icon green">
                    <i class="ti ti-credit-card"></i>
                </div>
                <div>
                    <div class="guru-stat-label">Status Langganan</div>
                    <div class="guru-stat-value {{ ($hasAnyActiveSub ?? false) ? 'text-success' : 'text-danger' }}" style="font-size: 1.35rem;">
                        {{ ($hasAnyActiveSub ?? false) ? 'Aktif' : 'Tidak Aktif' }}
                    </div>
                </div>
            </div>
        </div>

        {{-- Stat 4: Sisa Masa Langganan --}}
        <div class="col-sm-6 col-lg-3">
            <div class="guru-stat-card">
                <div class="guru-stat-icon slate">
                    <i class="ti ti-clock"></i>
                </div>
                <div>
                    <div class="guru-stat-label">Sisa Masa Langganan</div>
                    <div class="guru-stat-value">{{ ($sisaHari ?? 0) > 0 ? $sisaHari . ' Hari' : '-' }}</div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
