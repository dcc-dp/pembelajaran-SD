@extends('guest.layouts.guest')

@section('title', 'Pilihan Paket Langganan')

@section('content')

<!-- INTRO -->
<section class="py-5 py-md-6 bg-white border-bottom position-relative">
    <div class="container-xl">
        <div class="text-center mx-auto" style="max-width: 840px;">
            <div class="mb-3">
                <span class="about-platform-badge">
                    Pilihan Paket Berlangganan
                </span>
            </div>
            <h1 class="hero-title text-dark mb-3">
                Akses Penuh Perangkat Ajar <br class="d-none d-md-inline"><span style="color: #b7141b;">Sekolah Dasar</span>
            </h1>
            <p class="hero-desc text-secondary mx-auto mb-0" style="max-width: 780px; line-height: 1.8;">
                Pilih paket berlangganan sesuai jenjang kelas dan kebutuhan mengajar Anda. Dapatkan akses lengkap tanpa sensor ke seluruh modul ajar, bank soal, dan perangkat evaluasi kurikulum merdeka.
            </p>
        </div>
    </div>
</section>


<!-- DAFTAR PAKET LANGGANAN -->
<section class="py-5 py-md-6" id="daftar-paket" style="background-color: #f8fafc;">
    <div class="container-xl">
        <div class="text-center mx-auto mb-5" style="max-width: 650px;">
            <h2 class="fw-bold text-dark fs-1 mb-2">Pilihan Paket Belajar</h2>
            <p class="text-secondary small mb-0">Daftar paket aktif yang dapat Anda pilih sesuai dengan kebutuhan pembelajaran di kelas.</p>
        </div>

        {{-- Grid Paket Langganan --}}
        <div class="row g-4 justify-content-center">
            @forelse($paketLangganans as $paket)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="pricing-card">
                        {{-- Badges Kelas & Semester --}}
                        <div class="pricing-card-badges">
                            <span class="badge bg-danger-subtle text-danger fw-semibold px-2 py-1">
                                <i class="ti ti-school me-1"></i> {{ $paket->kelas?->nama ?? 'Kelas SD' }}
                            </span>
                            <span class="badge bg-secondary-subtle text-secondary fw-semibold px-2 py-1">
                                <i class="ti ti-calendar me-1"></i> {{ $paket->semester?->nama ?? 'Semua Semester (1 Tahun)' }}
                            </span>
                        </div>

                        {{-- Nama Paket --}}
                        <h3 class="pricing-card-title">
                            {{ $paket->nama }}
                        </h3>

                        {{-- Deskripsi Paket --}}
                        <p class="pricing-card-desc">
                            {{ $paket->deskripsi ?: 'Akses lengkap perangkat ajar dan dokumen kurikulum merdeka sesuai jenjang kelas terpilih.' }}
                        </p>

                        {{-- Kotak Harga & Durasi --}}
                        <div class="pricing-price-box">
                            <div class="d-flex align-items-baseline">
                                <span class="pricing-price-amount">
                                    Rp {{ number_format($paket->harga, 0, ',', '.') }}
                                </span>
                                <span class="pricing-price-period">
                                    / {{ $paket->durasi_bulan }} Bulan
                                </span>
                            </div>
                            <div class="small text-secondary mt-1">
                                <i class="ti ti-clock text-danger me-1"></i> Masa aktif akses: <strong>{{ $paket->durasi_bulan }} Bulan</strong>
                            </div>
                        </div>

                        {{-- Fitur & Spesifikasi Paket --}}
                        <ul class="pricing-feature-list">
                            <li class="pricing-feature-item">
                                <i class="ti ti-check"></i>
                                <span>Akses modul ajar & materi {{ $paket->kelas?->nama ?? 'Kelas SD' }}</span>
                            </li>
                            <li class="pricing-feature-item">
                                <i class="ti ti-check"></i>
                                <span>Cakupan: <strong>{{ $paket->semester?->nama ?? 'Semua Semester (1 Tahun Penuh)' }}</strong></span>
                            </li>
                            <li class="pricing-feature-item">
                                <i class="ti ti-check"></i>
                                <span>Masa aktif penggunaan selama <strong>{{ $paket->durasi_bulan }} Bulan</strong></span>
                            </li>
                            <li class="pricing-feature-item">
                                <i class="ti ti-check"></i>
                                <span>Download format siap edit Word (.docx) & PDF</span>
                            </li>
                            <li class="pricing-feature-item">
                                <i class="ti ti-check"></i>
                                <span>Dokumen lengkap tanpa sensor & bebas watermark</span>
                            </li>
                        </ul>

                        {{-- Tombol Aksi --}}
                        <div class="mt-auto">
                            @auth
                                <a href="{{ route('guru.dashboard.index') }}" class="btn btn-sd-orange w-100 rounded-pill py-2 fw-semibold shadow-sm">
                                    Pilih Paket Ini <i class="ti ti-arrow-right ms-1"></i>
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-sd-orange w-100 rounded-pill py-2 fw-semibold shadow-sm">
                                    Pilih Paket Ini <i class="ti ti-arrow-right ms-1"></i>
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="card border-0 shadow-sm rounded-4 p-5 text-center bg-white my-3">
                        <div class="avatar avatar-xl bg-danger-subtle text-danger rounded-circle mx-auto mb-3" style="width: 72px; height: 72px;">
                            <i class="ti ti-package-off fs-1"></i>
                        </div>
                        <h4 class="fw-bold text-dark mb-2">Belum Ada Paket Langganan</h4>
                        <p class="text-secondary mx-auto mb-0" style="max-width: 520px;">
                            Saat ini belum ada paket langganan yang aktif. Silakan hubungi admin atau periksa kembali di lain waktu.
                        </p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- LANGKAH MUDAH BERLANGGANAN -->
<section class="py-5 py-md-6 bg-white border-bottom">
    <div class="container-xl">
        <div class="text-center mx-auto mb-5">
            <h2 class="fw-bold text-dark fs-1 mb-0">Langkah Mudah Berlangganan</h2>
        </div>

        <div class="subscription-steps-wrapper">
            <div class="row g-4">
                <div class="col-6 col-md-3">
                    <div class="subscription-step-item">
                        <div class="subscription-step-circle">
                            <i class="ti ti-shopping-cart"></i>
                        </div>
                        <h4 class="subscription-step-title">Pilih Paket</h4>
                        <p class="subscription-step-desc">Tentukan paket SD Learning Center Premium.</p>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="subscription-step-item">
                        <div class="subscription-step-circle">
                            <i class="ti ti-cash"></i>
                        </div>
                        <h4 class="subscription-step-title">Lakukan Pembayaran</h4>
                        <p class="subscription-step-desc">Bayar melalui metode yang tersedia.</p>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="subscription-step-item">
                        <div class="subscription-step-circle">
                            <i class="ti ti-shield-check"></i>
                        </div>
                        <h4 class="subscription-step-title">Verifikasi</h4>
                        <p class="subscription-step-desc">Akun aktif otomatis atau via unggah bukti.</p>
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <div class="subscription-step-item">
                        <div class="subscription-step-circle">
                            <i class="ti ti-school"></i>
                        </div>
                        <h4 class="subscription-step-title">Mulai Akses</h4>
                        <p class="subscription-step-desc">Nikmati seluruh materi perangkat ajar.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- KENAPA HARUS BERLANGGANAN?  -->
<section class="py-5 py-md-6" style="background-color: #f8fafc;">
    <div class="container-xl">
        <div class="text-center mx-auto mb-5">
            <h2 class="fw-bold text-dark fs-1 mb-0">Kenapa Harus Berlangganan?</h2>
        </div>

        <div class="row g-4">
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="subscription-reason-card">
                    <div class="subscription-reason-icon tint-red">
                        <i class="ti ti-book-2"></i>
                    </div>
                    <h4 class="subscription-reason-title">Akses Penuh</h4>
                    <p class="subscription-reason-desc">Semua perangkat ajar untuk semua kelas tersedia dalam satu klik.</p>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3">
                <div class="subscription-reason-card">
                    <div class="subscription-reason-icon tint-amber">
                        <i class="ti ti-download"></i>
                    </div>
                    <h4 class="subscription-reason-title">Download Cepat</h4>
                    <p class="subscription-reason-desc">Unduh file modul ajar kapan saja tanpa batas kuota harian.</p>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3">
                <div class="subscription-reason-card">
                    <div class="subscription-reason-icon tint-red">
                        <i class="ti ti-rotate-clockwise"></i>
                    </div>
                    <h4 class="subscription-reason-title">Update Berkala</h4>
                    <p class="subscription-reason-desc">Materi selalu mengikuti perkembangan kurikulum nasional terbaru.</p>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3">
                <div class="subscription-reason-card">
                    <div class="subscription-reason-icon tint-amber">
                        <i class="ti ti-hand-click"></i>
                    </div>
                    <h4 class="subscription-reason-title">Praktis</h4>
                    <p class="subscription-reason-desc">Kelola administrasi kelas jadi lebih mudah dan hemat waktu.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
