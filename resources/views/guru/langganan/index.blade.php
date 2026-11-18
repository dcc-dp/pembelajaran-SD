@extends('guru.layouts.guru')

@section('title', 'Langganan Saya')

@push('styles')
<style>
    .sub-section-card {
        background: #ffffff;
        border: 1px solid #f1f5f9;
        border-radius: 20px;
        box-shadow: 0 4px 24px rgba(15, 23, 42, 0.04);
        overflow: hidden;
    }

    /* Top Status Cards */
    .sub-status-card {
        background: #ffffff;
        border: 1px solid #eef2f6;
        border-radius: 20px;
        padding: 1.75rem;
        box-shadow: 0 4px 20px rgba(15, 23, 42, 0.035);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: relative;
        overflow: hidden;
    }

    .sub-status-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 28px rgba(15, 23, 42, 0.06);
    }

    .sub-status-icon {
        width: 46px;
        height: 46px;
        border-radius: 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.35rem;
        flex-shrink: 0;
    }

    .sub-status-icon.sem1 {
        background: linear-gradient(135deg, #fff1f2 0%, #ffe4e6 100%);
        color: #b7131a;
    }

    .sub-status-icon.sem2 {
        background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
        color: #1d4ed8;
    }

    /* Selectable Package Cards */
    .paket-plan-card {
        position: relative;
        background: #ffffff;
        border: 1.5px solid #e2e8f0;
        border-radius: 16px;
        padding: 1.35rem 1.5rem;
        cursor: pointer;
        transition: all 0.22s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .paket-plan-card:hover:not(.is-locked) {
        border-color: #cbd5e1;
        background: #fcfcfd;
        transform: translateY(-1px);
    }

    .paket-plan-card.active {
        background: linear-gradient(180deg, #fffafa 0%, #ffffff 100%);
        border: 2px solid #b7131a;
        box-shadow: 0 8px 24px rgba(183, 19, 26, 0.08);
    }

    .paket-plan-card.is-locked {
        background: #f8fafc;
        border: 1.5px dashed #cbd5e1;
        cursor: default;
        opacity: 0.88;
    }

    /* Custom Radio Indicator */
    .paket-radio {
        width: 22px;
        height: 22px;
        border-radius: 50%;
        border: 2px solid #cbd5e1;
        background: #ffffff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: all 0.2s ease;
        margin-top: 2px;
    }

    .paket-plan-card.active .paket-radio {
        border-color: #b7131a;
        background: #b7131a;
        box-shadow: 0 0 0 4px rgba(183, 19, 26, 0.12);
    }

    .paket-radio::after {
        content: "";
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #ffffff;
        opacity: 0;
        transform: scale(0.5);
        transition: all 0.2s ease;
    }

    .paket-plan-card.active .paket-radio::after {
        opacity: 1;
        transform: scale(1);
    }

    .paket-feature-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        font-size: 0.73rem;
        font-weight: 600;
        color: #475569;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        padding: 0.25rem 0.65rem;
        border-radius: 999px;
    }

    .paket-plan-card.active .paket-feature-pill {
        background: #fff1f2;
        border-color: #fecdd3;
        color: #9f1239;
    }

    /* Modern Info Banner */
    .sub-info-banner {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-left: 4px solid #3b82f6;
        border-radius: 12px;
        padding: 1rem 1.25rem;
        display: flex;
        align-items: flex-start;
        gap: 0.85rem;
    }

    /* Right Summary Box */
    .sub-summary-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 18px;
        padding: 1.75rem;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .sub-summary-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        padding: 0.65rem 0;
        border-bottom: 1px dashed #e2e8f0;
        font-size: 0.875rem;
    }

    .sub-summary-row:last-child {
        border-bottom: none;
    }

    .btn-checkout-modern {
        background: linear-gradient(135deg, #c81e25 0%, #991b1b 100%);
        color: #ffffff;
        border: none;
        border-radius: 14px;
        padding: 0.9rem 1.5rem;
        font-size: 0.95rem;
        font-weight: 700;
        width: 100%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.6rem;
        box-shadow: 0 6px 18px rgba(183, 19, 26, 0.25);
        transition: all 0.2s ease;
    }

    .btn-checkout-modern:hover {
        background: linear-gradient(135deg, #b7131a 0%, #7f1d1d 100%);
        color: #ffffff;
        transform: translateY(-1px);
        box-shadow: 0 10px 24px rgba(183, 19, 26, 0.32);
    }
</style>
@endpush

@section('content')
<div class="d-flex flex-column gap-4">

    {{-- Header --}}
    <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between gap-2">
        <div>
            <h1 class="page-title text-dark fw-bold mb-1" style="font-size: 1.55rem; letter-spacing: -0.02em;">
                Paket Langganan Saya
            </h1>
            <p class="text-secondary small mb-0">
                Kelola status akses materi pembelajaran Semester 1 & Semester 2 serta perpanjangan masa aktif paket.
            </p>
        </div>
        <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2 rounded-pill fw-semibold small">
            <i class="ti ti-crown me-1"></i> Akses Kelas 1–6 SD
        </span>
    </div>

    {{-- Alert Messages --}}
    @if(session('success'))
        <div class="p-3.5 bg-success-subtle border border-success-subtle rounded-3 shadow-xs d-flex align-items-center gap-3">
            <i class="ti ti-circle-check fs-2 text-success"></i>
            <div class="fw-semibold text-dark">{{ session('success') }}</div>
        </div>
    @endif

    @if(session('error'))
        <div class="p-3.5 bg-danger-subtle border border-danger-subtle rounded-3 shadow-xs d-flex align-items-center gap-3">
            <i class="ti ti-alert-triangle fs-2 text-danger"></i>
            <div class="fw-semibold text-dark">{{ session('error') }}</div>
        </div>
    @endif

    {{-- 2 Kartu Status Langganan: Semester 1 & Semester 2 --}}
    <div class="row g-4 align-items-stretch">
        {{-- Card Paket Semester 1 --}}
        @php
            $isSem1Active = $activeSubSem1 && $activeSubSem1->isAktif();
            $sisaSem1 = $paketSemester1 ? $user->getSisaHariSemester($paketSemester1->semester_id) : 0;
            $canRenewSem1 = $paketSemester1 ? $user->canRenewSemester($paketSemester1->semester_id) : true;
        @endphp
        <div class="col-lg-6">
            <div class="sub-status-card">
                <div>
                    <div class="d-flex align-items-center justify-content-between gap-3 mb-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="sub-status-icon sem1">
                                <i class="ti ti-book-2"></i>
                            </div>
                            <div>
                                <div class="text-muted fw-bold" style="font-size: 0.7rem; letter-spacing: 0.06em; text-transform: uppercase;">
                                    Paket Ganjil
                                </div>
                                <h3 class="fw-bold text-dark mb-0" style="font-size: 1.15rem;">
                                    {{ $paketSemester1?->nama ?? 'Paket Semester 1 (Kelas 1–6 SD)' }}
                                </h3>
                            </div>
                        </div>

                        @if($isSem1Active && $sisaSem1 <= \App\Models\Langganan::BATAS_HARI_PERPANJANG)
                            <span class="badge bg-warning-lt text-warning px-3 py-1.5 rounded-pill fw-bold">
                                ● H-{{ $sisaSem1 }} Berakhir
                            </span>
                        @elseif($isSem1Active)
                            <span class="badge bg-success-lt text-success px-3 py-1.5 rounded-pill fw-bold">
                                ● Aktif
                            </span>
                        @else
                            <span class="badge bg-secondary-lt text-secondary px-3 py-1.5 rounded-pill fw-semibold">
                                Belum Aktif
                            </span>
                        @endif
                    </div>

                    <p class="text-secondary small mb-3" style="line-height: 1.55;">
                        Mencakup akses baca & cetak seluruh perangkat ajar (Sampul, ATP, Prota, Prosem, KKTP, Jurnal, Modul) <strong>Kelas 1 s/d Kelas 6 Semester 1</strong>.
                    </p>

                    @if($isSem1Active)
                        <div class="p-3 bg-light rounded-3 border mb-3">
                            <div class="row g-2 text-center">
                                <div class="col-4 border-end">
                                    <div class="text-muted small fw-semibold" style="font-size: 0.68rem;">MULAI</div>
                                    <div class="fw-bold text-dark small">{{ $activeSubSem1->tanggal_mulai->format('d M Y') }}</div>
                                </div>
                                <div class="col-4 border-end">
                                    <div class="text-muted small fw-semibold" style="font-size: 0.68rem;">BERAKHIR</div>
                                    <div class="fw-bold text-dark small">{{ ($latestEndSem1 ?? $activeSubSem1->tanggal_berakhir)->format('d M Y') }}</div>
                                </div>
                                <div class="col-4">
                                    <div class="text-muted small fw-semibold" style="font-size: 0.68rem;">SISA MASA AKTIF</div>
                                    <div class="fw-bold {{ $sisaSem1 <= 7 ? 'text-danger' : 'text-success' }} small">
                                        {{ $sisaSem1 }} Hari
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="p-3 rounded-3 bg-light border d-flex align-items-center gap-2.5 small text-secondary mb-3">
                            <i class="ti ti-lock text-muted fs-3 flex-shrink-0"></i>
                            <span>Akses materi Semester 1 belum aktif. Pilih paket di bawah untuk membuka akses.</span>
                        </div>
                    @endif
                </div>

                <div class="d-flex align-items-center justify-content-between pt-3 border-top">
                    <div>
                        <div class="text-muted" style="font-size: 0.75rem;">Biaya Langganan</div>
                        <div class="fw-bold text-dark fs-3">
                            Rp {{ number_format($paketSemester1?->harga ?? 150000, 0, ',', '.') }}
                            <span class="text-muted fs-6 fw-normal">/ 12 Bulan</span>
                        </div>
                    </div>

                    @if($isSem1Active && ! $canRenewSem1)
                        <div class="text-end">
                            <a href="{{ route('guru.repository.index', ['semester_id' => $paketSemester1?->semester_id]) }}" class="btn btn-light border text-dark rounded-pill px-3.5 fw-semibold">
                                <i class="ti ti-folder-open me-1 text-danger"></i> Buka Materi
                            </a>
                            <div class="text-muted mt-1" style="font-size: 0.68rem;">
                                Perpanjangan dibuka H-7
                            </div>
                        </div>
                    @elseif($isSem1Active && $canRenewSem1)
                        <a href="#form-langganan" onclick="selectPaket({{ $paketSemester1?->id ?? 0 }})" class="btn btn-danger rounded-pill px-4 fw-semibold shadow-xs">
                            Perpanjang Paket
                        </a>
                    @else
                        <a href="#form-langganan" onclick="selectPaket({{ $paketSemester1?->id ?? 0 }})" class="btn btn-outline-danger rounded-pill px-4 fw-semibold">
                            Pilih Paket
                        </a>
                    @endif
                </div>
            </div>
        </div>

        {{-- Card Paket Semester 2 --}}
        @php
            $isSem2Active = $activeSubSem2 && $activeSubSem2->isAktif();
            $sisaSem2 = $paketSemester2 ? $user->getSisaHariSemester($paketSemester2->semester_id) : 0;
            $canRenewSem2 = $paketSemester2 ? $user->canRenewSemester($paketSemester2->semester_id) : true;
        @endphp
        <div class="col-lg-6">
            <div class="sub-status-card">
                <div>
                    <div class="d-flex align-items-center justify-content-between gap-3 mb-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="sub-status-icon sem2">
                                <i class="ti ti-books"></i>
                            </div>
                            <div>
                                <div class="text-muted fw-bold" style="font-size: 0.7rem; letter-spacing: 0.06em; text-transform: uppercase;">
                                    Paket Genap
                                </div>
                                <h3 class="fw-bold text-dark mb-0" style="font-size: 1.15rem;">
                                    {{ $paketSemester2?->nama ?? 'Paket Semester 2 (Kelas 1–6 SD)' }}
                                </h3>
                            </div>
                        </div>

                        @if($isSem2Active && $sisaSem2 <= \App\Models\Langganan::BATAS_HARI_PERPANJANG)
                            <span class="badge bg-warning-lt text-warning px-3 py-1.5 rounded-pill fw-bold">
                                ● H-{{ $sisaSem2 }} Berakhir
                            </span>
                        @elseif($isSem2Active)
                            <span class="badge bg-success-lt text-success px-3 py-1.5 rounded-pill fw-bold">
                                ● Aktif
                            </span>
                        @else
                            <span class="badge bg-secondary-lt text-secondary px-3 py-1.5 rounded-pill fw-semibold">
                                Belum Aktif
                            </span>
                        @endif
                    </div>

                    <p class="text-secondary small mb-3" style="line-height: 1.55;">
                        Mencakup akses baca & cetak seluruh perangkat ajar (Sampul, ATP, Prota, Prosem, KKTP, Jurnal, Modul) <strong>Kelas 1 s/d Kelas 6 Semester 2</strong>.
                    </p>

                    @if($isSem2Active)
                        <div class="p-3 bg-light rounded-3 border mb-3">
                            <div class="row g-2 text-center">
                                <div class="col-4 border-end">
                                    <div class="text-muted small fw-semibold" style="font-size: 0.68rem;">MULAI</div>
                                    <div class="fw-bold text-dark small">{{ $activeSubSem2->tanggal_mulai->format('d M Y') }}</div>
                                </div>
                                <div class="col-4 border-end">
                                    <div class="text-muted small fw-semibold" style="font-size: 0.68rem;">BERAKHIR</div>
                                    <div class="fw-bold text-dark small">{{ ($latestEndSem2 ?? $activeSubSem2->tanggal_berakhir)->format('d M Y') }}</div>
                                </div>
                                <div class="col-4">
                                    <div class="text-muted small fw-semibold" style="font-size: 0.68rem;">SISA MASA AKTIF</div>
                                    <div class="fw-bold {{ $sisaSem2 <= 7 ? 'text-danger' : 'text-success' }} small">
                                        {{ $sisaSem2 }} Hari
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="p-3 rounded-3 bg-light border d-flex align-items-center gap-2.5 small text-secondary mb-3">
                            <i class="ti ti-lock text-muted fs-3 flex-shrink-0"></i>
                            <span>Akses materi Semester 2 belum aktif. Pilih paket di bawah untuk membuka akses.</span>
                        </div>
                    @endif
                </div>

                <div class="d-flex align-items-center justify-content-between pt-3 border-top">
                    <div>
                        <div class="text-muted" style="font-size: 0.75rem;">Biaya Langganan</div>
                        <div class="fw-bold text-dark fs-3">
                            Rp {{ number_format($paketSemester2?->harga ?? 150000, 0, ',', '.') }}
                            <span class="text-muted fs-6 fw-normal">/ 12 Bulan</span>
                        </div>
                    </div>

                    @if($isSem2Active && ! $canRenewSem2)
                        <div class="text-end">
                            <a href="{{ route('guru.repository.index', ['semester_id' => $paketSemester2?->semester_id]) }}" class="btn btn-light border text-dark rounded-pill px-3.5 fw-semibold">
                                <i class="ti ti-folder-open me-1 text-primary"></i> Buka Materi
                            </a>
                            <div class="text-muted mt-1" style="font-size: 0.68rem;">
                                Perpanjangan dibuka H-7
                            </div>
                        </div>
                    @elseif($isSem2Active && $canRenewSem2)
                        <a href="#form-langganan" onclick="selectPaket({{ $paketSemester2?->id ?? 0 }})" class="btn btn-primary rounded-pill px-4 fw-semibold shadow-xs">
                            Perpanjang Paket
                        </a>
                    @else
                        <a href="#form-langganan" onclick="selectPaket({{ $paketSemester2?->id ?? 0 }})" class="btn btn-outline-primary rounded-pill px-4 fw-semibold">
                            Pilih Paket
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Pembelian / Perpanjangan Paket --}}
    @php
        $availablePakets = $semuaPaket->filter(fn($p) => $user->canRenewSemester($p->semester_id));
        $defaultPaket = $availablePakets->first() ?? $semuaPaket->first();
        $selectedPaketId = old('paket_langganan_id', $defaultPaket?->id);
    @endphp

    <div class="sub-section-card" id="form-langganan">
        <div class="p-4 p-lg-5">
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2 pb-4 mb-4 border-bottom">
                <div class="d-flex align-items-center gap-3">
                    <div class="sub-status-icon sem1">
                        <i class="ti ti-credit-card"></i>
                    </div>
                    <div>
                        <h3 class="fw-bold text-dark mb-1" style="font-size: 1.2rem;">
                            Pembelian & Perpanjangan Paket
                        </h3>
                        <p class="text-secondary small mb-0">
                            Pilih paket semester untuk diaktifkan. Paket yang sedang aktif baru dapat diperpanjang saat memasuki <strong>H-7 sebelum berakhir</strong>.
                        </p>
                    </div>
                </div>
            </div>

            <form action="{{ route('guru.langganan.store') }}" method="POST">
                @csrf

                {{-- Hidden Select for Form Submission --}}
                <select name="paket_langganan_id" id="paket_select" class="form-select d-none" required>
                    @foreach($semuaPaket as $p)
                        <option
                            value="{{ $p->id }}"
                            data-nama="{{ $p->nama }}"
                            data-semester="{{ $p->semester?->nama ?? 'Semester' }}"
                            data-harga="{{ $p->harga }}"
                            data-harga-formatted="Rp {{ number_format($p->harga, 0, ',', '.') }}"
                            data-durasi="{{ $p->durasi_bulan }} Bulan"
                            @selected($selectedPaketId == $p->id)
                        >
                            {{ $p->nama }}
                        </option>
                    @endforeach
                </select>

                <div class="row g-4 g-xl-5 align-items-stretch">
                    {{-- Kolom Kiri: Pilihan Paket --}}
                    <div class="col-lg-7 d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <span class="fw-bold text-dark" style="font-size: 0.95rem;">
                                    Daftar Paket Langganan
                                </span>
                                <span class="text-secondary small">Masa aktif 12 bulan per paket</span>
                            </div>

                            <div class="d-flex flex-column gap-3 mb-4">
                                @foreach($semuaPaket as $p)
                                    @php
                                        $canBuy = $user->canRenewSemester($p->semester_id);
                                        $sisaHariPaket = $user->getSisaHariSemester($p->semester_id);
                                        $isSelected = $canBuy && ($selectedPaketId == $p->id);
                                    @endphp
                                    <div
                                        class="paket-plan-card {{ $isSelected ? 'active' : '' }} {{ ! $canBuy ? 'is-locked' : '' }}"
                                        data-paket-id="{{ $p->id }}"
                                        data-can-buy="{{ $canBuy ? '1' : '0' }}"
                                        @if($canBuy)
                                            onclick="selectPaket({{ $p->id }})"
                                        @endif
                                    >
                                        <div class="d-flex align-items-start justify-content-between gap-3">
                                            <div class="d-flex align-items-start gap-3">
                                                @if($canBuy)
                                                    <div class="paket-radio"></div>
                                                @else
                                                    <div class="avatar avatar-xs bg-success-lt text-success rounded-circle flex-shrink-0 mt-0.5">
                                                        <i class="ti ti-check"></i>
                                                    </div>
                                                @endif

                                                <div>
                                                    <div class="d-flex flex-wrap align-items-center gap-2 mb-1">
                                                        <span class="fw-bold text-dark" style="font-size: 1.05rem;">
                                                            {{ $p->nama }}
                                                        </span>
                                                        @if(! $canBuy)
                                                            <span class="badge bg-success-lt text-success rounded-pill px-2.5 py-0.5 fw-bold">
                                                                Sudah Aktif ({{ $sisaHariPaket }} Hari)
                                                            </span>
                                                        @elseif($sisaHariPaket > 0 && $sisaHariPaket <= \App\Models\Langganan::BATAS_HARI_PERPANJANG)
                                                            <span class="badge bg-warning-lt text-warning rounded-pill px-2.5 py-0.5 fw-bold">
                                                                Dapat Diperpanjang (H-{{ $sisaHariPaket }})
                                                            </span>
                                                        @else
                                                            <span class="badge {{ $loop->first ? 'bg-danger-lt text-danger' : 'bg-blue-lt text-blue' }} rounded-pill px-2.5 py-0.5 fw-semibold">
                                                                {{ $p->semester?->nama ?? 'Semester' }}
                                                            </span>
                                                        @endif
                                                    </div>

                                                    @if(! $canBuy)
                                                        <p class="text-secondary small mb-0">
                                                            Paket ini sedang aktif. Perpanjangan baru akan dibuka otomatis pada <strong>H-7 sebelum masa aktif berakhir</strong>.
                                                        </p>
                                                    @else
                                                        <p class="text-secondary small mb-3">
                                                            Akses penuh seluruh perangkat ajar selama {{ $p->durasi_bulan }} bulan penuh.
                                                        </p>

                                                        <div class="d-flex flex-wrap gap-1.5">
                                                            <span class="paket-feature-pill">
                                                                <i class="ti ti-school"></i> Kelas 1–6 SD
                                                            </span>
                                                            <span class="paket-feature-pill">
                                                                <i class="ti ti-files"></i> 7 Jenis Dokumen
                                                            </span>
                                                            <span class="paket-feature-pill">
                                                                <i class="ti ti-printer"></i> Baca & Cetak Langsung
                                                            </span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="text-end flex-shrink-0">
                                                <div class="fw-bold {{ $canBuy ? 'text-danger' : 'text-secondary' }}" style="font-size: 1.25rem; letter-spacing: -0.02em;">
                                                    Rp {{ number_format($p->harga, 0, ',', '.') }}
                                                </div>
                                                <div class="text-muted small">per {{ $p->durasi_bulan }} bulan</div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            @error('paket_langganan_id')
                                <div class="text-danger small mb-3">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Info Ketentuan Perpanjangan H-7 --}}
                        <div class="sub-info-banner">
                            <i class="ti ti-info-circle text-primary fs-2 mt-0.5 flex-shrink-0"></i>
                            <div class="small">
                                <div class="fw-bold text-dark mb-0.5">Aturan Perpanjangan Paket (H-7)</div>
                                <div class="text-secondary" style="line-height: 1.55;">
                                    Perpanjangan paket dibuka mulai <strong>7 hari sebelum masa aktif berakhir (H-7)</strong> atau setelah masa aktif habis. Jika diperpanjang pada periode H-7, sisa hari Anda tidak hangus dan masa aktif 12 bulan baru otomatis disambung setelah tanggal berakhir sebelumnya.
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Kolom Kanan: Ringkasan Tagihan --}}
                    <div class="col-lg-5">
                        @if($availablePakets->isNotEmpty())
                            <div class="sub-summary-card">
                                <div>
                                    <div class="d-flex align-items-center justify-content-between pb-3 mb-2 border-bottom">
                                        <div>
                                            <h4 class="fw-bold text-dark mb-0" style="font-size: 1.05rem;">Ringkasan Tagihan</h4>
                                            <div class="text-secondary" style="font-size: 0.78rem;">Detail pesanan paket langganan</div>
                                        </div>
                                        <div class="avatar avatar-sm bg-white border rounded-3 text-danger shadow-xs">
                                            <i class="ti ti-receipt fs-3"></i>
                                        </div>
                                    </div>

                                    <div class="my-2">
                                        <div class="sub-summary-row">
                                            <span class="text-secondary">Paket Dipilih</span>
                                            <span class="fw-bold text-dark text-end" id="summary-paket-nama">
                                                {{ $defaultPaket?->nama ?? 'Paket Semester 1 (Kelas 1–6 SD)' }}
                                            </span>
                                        </div>

                                        <div class="sub-summary-row">
                                            <span class="text-secondary">Semester</span>
                                            <span class="badge bg-danger-lt text-danger fw-semibold px-2.5 py-1 rounded-pill" id="summary-paket-semester">
                                                {{ $defaultPaket?->semester?->nama ?? 'Semester 1' }}
                                            </span>
                                        </div>

                                        <div class="sub-summary-row">
                                            <span class="text-secondary">Cakupan Materi</span>
                                            <span class="fw-semibold text-dark">Kelas 1 s/d Kelas 6 SD</span>
                                        </div>

                                        <div class="sub-summary-row">
                                            <span class="text-secondary">Masa Aktif</span>
                                            <span class="fw-semibold text-dark" id="summary-paket-durasi">
                                                {{ $defaultPaket?->durasi_bulan ?? 12 }} Bulan
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="pt-3 border-top mt-3">
                                    <div class="d-flex justify-content-between align-items-baseline mb-3">
                                        <div>
                                            <div class="fw-bold text-dark">Total Pembayaran</div>
                                            <div class="text-muted" style="font-size: 0.72rem;">Akses penuh selama 1 tahun</div>
                                        </div>
                                        <div class="fw-bold text-danger" style="font-size: 1.6rem; letter-spacing: -0.02em;" id="summary-paket-harga">
                                            Rp {{ number_format($defaultPaket?->harga ?? 150000, 0, ',', '.') }}
                                        </div>
                                    </div>

                                    <button type="submit" class="btn-checkout-modern">
                                        <span>Selesaikan Pembayaran</span>
                                        <i class="ti ti-arrow-right fs-3"></i>
                                    </button>
                                </div>
                            </div>
                        @else
                            {{-- State ketika Semester 1 & Semester 2 keduanya masih aktif > 7 hari --}}
                            <div class="sub-summary-card text-center justify-content-center align-items-center py-5">
                                <div class="avatar avatar-lg bg-success-lt text-success rounded-circle mb-3">
                                    <i class="ti ti-shield-check fs-1"></i>
                                </div>
                                <h4 class="fw-bold text-dark mb-1">Seluruh Paket Semester Aktif</h4>
                                <p class="text-secondary small mb-4" style="max-width: 320px; line-height: 1.6;">
                                    Paket <strong>Semester 1</strong> dan <strong>Semester 2</strong> Anda saat ini masih aktif. Tombol perpanjangan akan otomatis tersedia saat memasuki <strong>H-7 sebelum masa aktif berakhir</strong>.
                                </p>
                                <a href="{{ route('guru.repository.index') }}" class="btn btn-danger rounded-pill px-4 py-2 fw-semibold shadow-xs">
                                    <i class="ti ti-books me-1.5"></i> Jelajahi Materi Pembelajaran
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Riwayat Langganan & Pembayaran --}}
    <div class="sub-section-card">
        <div class="px-4 py-3.5 border-bottom d-flex align-items-center justify-content-between">
            <h3 class="card-title fw-bold text-dark mb-0 fs-3">
                <i class="ti ti-history me-1.5 text-danger"></i>
                Riwayat Transaksi & Langganan
            </h3>
        </div>

        <div class="table-responsive">
            <table class="table table-vcenter card-table table-hover mb-0">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>No. Pesanan</th>
                        <th>Paket Langganan</th>
                        <th>Cakupan</th>
                        <th>Periode Akses</th>
                        <th>Total Bayar</th>
                        <th>Status Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($riwayatLangganan as $idx => $item)
                        @php
                            $pembayaran = $item->pembayarans->last();
                            $orderId = $pembayaran?->order_id ?? ('INV-' . ($pembayaran?->created_at?->format('Ymd') ?? date('Ymd')) . '-' . str_pad($pembayaran?->id ?? $item->id, 4, '0', STR_PAD_LEFT));
                        @endphp
                        <tr>
                            <td class="text-secondary">{{ $riwayatLangganan->firstItem() + $idx }}</td>
                            <td>
                                <span class="fw-semibold text-dark font-monospace small">{{ $orderId }}</span>
                                <div class="text-muted" style="font-size: 0.7rem;">
                                    {{ $pembayaran?->tanggal_pembayaran ? \Carbon\Carbon::parse($pembayaran->tanggal_pembayaran)->format('d M Y, H:i') : '-' }}
                                </div>
                            </td>
                            <td>
                                <div class="fw-bold text-dark">{{ $item->paketLangganan?->nama ?? 'Paket' }}</div>
                                <span class="badge bg-light text-secondary border small">
                                    {{ $item->paketLangganan?->semester?->nama ?? 'Semester' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle">
                                    Kelas 1 s/d 6 SD
                                </span>
                            </td>
                            <td>
                                <div class="fw-semibold text-dark small">{{ $item->tanggal_mulai?->format('d M Y') }} s/d {{ $item->tanggal_berakhir?->format('d M Y') }}</div>
                                @if($item->isAktif() && $pembayaran?->status === 'berhasil')
                                    <span class="badge bg-success-subtle text-success small">Sedang Aktif</span>
                                @elseif($item->tanggal_berakhir?->lt(now()))
                                    <span class="badge bg-secondary-subtle text-secondary small">Masa Akses Berakhir</span>
                                @else
                                    <span class="badge bg-warning-subtle text-warning small">Menunggu Pembayaran</span>
                                @endif
                            </td>
                            <td>
                                <span class="fw-bold text-dark">
                                    Rp {{ number_format($pembayaran?->jumlah ?? $item->paketLangganan?->harga ?? 150000, 0, ',', '.') }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex flex-wrap align-items-center gap-1.5">
                                    @if($pembayaran?->status === 'berhasil')
                                        <span class="badge bg-success-lt text-success fw-bold">
                                            <i class="ti ti-circle-check me-1"></i> Lunas ({{ $pembayaran->metode_pembayaran }})
                                        </span>
                                    @elseif($pembayaran?->status === 'gagal')
                                        <span class="badge bg-danger-lt text-danger fw-bold">
                                            <i class="ti ti-x me-1"></i> Dibatalkan
                                        </span>
                                    @else
                                        <span class="badge bg-warning-lt text-warning fw-bold">
                                            <i class="ti ti-clock me-1"></i> Menunggu
                                        </span>

                                        @if($pembayaran?->snap_token)
                                            <button
                                                type="button"
                                                onclick="bukaPopupMidtrans('{{ $pembayaran->snap_token }}', '{{ route('guru.langganan.check-status', $pembayaran->id) }}')"
                                                class="btn btn-sm btn-danger rounded-pill px-2.5 py-0.5 fw-semibold"
                                            >
                                                Bayar
                                            </button>
                                        @endif

                                        @if($pembayaran)
                                            <a
                                                href="{{ route('guru.langganan.check-status', $pembayaran->id) }}"
                                                class="btn btn-sm btn-outline-secondary rounded-pill px-2.5 py-0.5 fw-semibold"
                                            >
                                                Cek Status
                                            </a>
                                        @endif
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-secondary">
                                <div class="avatar avatar-md rounded-circle bg-light text-muted mb-2 mx-auto">
                                    <i class="ti ti-receipt-off fs-2"></i>
                                </div>
                                <div class="fw-semibold">Belum Ada Riwayat Transaksi</div>
                                <div class="small text-muted">Pilih paket semester 1 atau 2 di atas untuk mengaktifkan langganan.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($riwayatLangganan->hasPages())
            <div class="card-footer bg-white border-top py-3">
                {{ $riwayatLangganan->links() }}
            </div>
        @endif
    </div>

</div>

<script>
function selectPaket(paketId) {
    if (!paketId) return;

    const targetCard = document.querySelector('.paket-plan-card[data-paket-id="' + paketId + '"]');
    if (targetCard && targetCard.dataset.canBuy === '0') {
        return;
    }

    const select = document.getElementById('paket_select');
    if (select) {
        select.value = paketId;
        const selectedOption = select.options[select.selectedIndex];
        if (selectedOption) {
            const namaEl = document.getElementById('summary-paket-nama');
            const semEl = document.getElementById('summary-paket-semester');
            const hargaEl = document.getElementById('summary-paket-harga');
            const durasiEl = document.getElementById('summary-paket-durasi');

            if (namaEl) namaEl.textContent = selectedOption.dataset.nama;
            if (semEl) semEl.textContent = selectedOption.dataset.semester;
            if (hargaEl) hargaEl.textContent = selectedOption.dataset.hargaFormatted;
            if (durasiEl) durasiEl.textContent = selectedOption.dataset.durasi;
        }
    }

    document.querySelectorAll('.paket-plan-card').forEach(function (card) {
        if (card.dataset.canBuy === '0') return;
        if (parseInt(card.dataset.paketId) === parseInt(paketId)) {
            card.classList.add('active');
        } else {
            card.classList.remove('active');
        }
    });
}

function bukaPopupMidtrans(snapToken, checkStatusUrl) {
    if (!window.snap) {
        alert('Layanan pembayaran sedang dimuat, silakan tunggu beberapa detik lalu klik tombol Bayar.');
        return;
    }

    window.snap.pay(snapToken, {
        onSuccess: function () {
            window.location.href = checkStatusUrl;
        },
        onPending: function () {
            window.location.href = checkStatusUrl;
        },
        onError: function () {
            window.location.href = checkStatusUrl;
        },
        onClose: function () {
            // Popup ditutup oleh pengguna sebelum selesai bayar
        }
    });
}
</script>

@php
    $midtransClientKey = config('services.midtrans.client_key');
    $midtransSnapJsUrl = config('services.midtrans.is_production')
        ? 'https://app.midtrans.com/snap/snap.js'
        : 'https://app.sandbox.midtrans.com/snap/snap.js';
@endphp

@if($midtransClientKey)
    <script src="{{ $midtransSnapJsUrl }}" data-client-key="{{ $midtransClientKey }}"></script>
@endif

@if(session('snap_token') && session('pembayaran_id'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            bukaPopupMidtrans(
                @json(session('snap_token')),
                @json(route('guru.langganan.check-status', session('pembayaran_id')))
            );
        });
    </script>
@endif
@endsection
