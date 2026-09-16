@extends('guru.layouts.guru')

@section('title', 'Dashboard Guru')

@section('content')
<div class="d-flex flex-column gap-4">

    {{-- ====================================================================
         ROW 1: WELCOME HERO BANNER (COL 8) & SUBSCRIPTION CARD (COL 4)
         ==================================================================== --}}
    <div class="row g-4 align-items-stretch">

        {{-- Hero Welcome Card --}}
        <div class="col-lg-8">
            <div class="guru-hero-card h-100 d-flex flex-column justify-content-between">
                <div class="row align-items-center">
                    <div class="col-md-7">
                        <h2 class="guru-hero-title mb-1">
                            Selamat Datang, {{ auth()->user()?->nama ?? 'Al Fina' }}
                        </h2>
                        <div class="guru-hero-school">
                            {{ auth()->user()?->nama_sekolah ?? 'SDN 01 Menteng' }}
                        </div>
                        <p class="guru-hero-quote">
                            "Pendidikan adalah senjata paling mematikan di dunia, karena dengan pendidikan, Anda dapat mengubah dunia." — Nelson Mandela
                        </p>
                        <div class="d-flex flex-wrap align-items-center gap-2 mt-3">
                            <a href="#" class="btn-hero-solid">
                                <i class="ti ti-compass"></i>
                                <span>Jelajahi Repository</span>
                            </a>
                            <a href="#" class="btn-hero-outline">
                                <i class="ti ti-refresh"></i>
                                <span>Perpanjang Langganan</span>
                            </a>
                        </div>
                    </div>

                    {{-- Hero Illustration Graphic --}}
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

        {{-- Subscription Status Card --}}
        <div class="col-lg-4">
            <div class="guru-sub-card">
                <div>
                    <div class="guru-sub-header">
                        <div>
                            <div class="guru-sub-title">SD Learning Center</div>
                            <div class="guru-sub-title text-primary">Premium</div>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="guru-sub-badge-active">● AKTIF</span>
                            <i class="ti ti-rosette fs-1 text-warning"></i>
                        </div>
                    </div>

                    <div class="my-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="text-secondary small fw-semibold">Sisa Waktu Langganan</span>
                            <span class="fw-bold text-dark small">45 Hari lagi</span>
                        </div>
                        <div class="guru-progress-bar-custom">
                            <div class="guru-progress-fill" style="width: 70%;"></div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center text-secondary small pt-2 border-top">
                        <div>
                            <div class="text-muted" style="font-size: 0.675rem; text-transform: uppercase;">Mulai</div>
                            <div class="fw-bold text-dark">12 Jan 2024</div>
                        </div>
                        <div class="text-end">
                            <div class="text-muted" style="font-size: 0.675rem; text-transform: uppercase;">Selesai</div>
                            <div class="fw-bold text-dark">12 Jan 2025</div>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="#" class="btn-sub-renew">
                        <i class="ti ti-refresh"></i>
                        <span>Renew Subscription</span>
                    </a>
                </div>
            </div>
        </div>

    </div>

    {{-- ====================================================================
         ROW 2: 4 SUMMARY STAT CARDS (SESUAI SCHEMA DATABASE)
         ==================================================================== --}}
    <div class="row g-3">

        {{-- Stat 1: Total Repository --}}
        <div class="col-sm-6 col-lg-3">
            <div class="guru-stat-card">
                <div class="guru-stat-icon red">
                    <i class="ti ti-folders"></i>
                </div>
                <div>
                    <div class="guru-stat-label">Total Repository</div>
                    <div class="guru-stat-value">1,284</div>
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
                    <div class="guru-stat-value">342</div>
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
                    <div class="guru-stat-value text-success" style="font-size: 1.35rem;">Aktif</div>
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
                    <div class="guru-stat-value">45 Hari</div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
