@extends('guest.layouts.guest')

@section('title', 'Beranda')

@section('content')
{{-- ======================================================= --}}
{{-- 1. HERO SECTION                                         --}}
{{-- ======================================================= --}}
<section class="py-5 py-lg-6 position-relative">
    <div class="container-xl">
        <div class="row align-items-center g-5">
            {{-- Left column: Copywriting & Actions --}}
            <div class="col-lg-6">
                {{-- Platform Pill Badge --}}
                <div class="mb-3">
                    <span class="badge-sd-pill">
                        <i class="ti ti-crown fs-4"></i>
                        Platform Guru SD No. 1 di Indonesia
                    </span>
                </div>

                {{-- Main Heading --}}
                <h1 class="display-5 fw-extrabold text-dark lh-sm mb-3" style="letter-spacing: -0.02em;">
                    Semua Perangkat <span style="color: #b7141b;">Ajar SD</span><br>
                    dalam Satu Platform
                </h1>

                {{-- Description --}}
                <p class="text-secondary fs-4 mb-4 pb-2" style="line-height: 1.6; max-width: 520px;">
                    Akses CP, ATP, Modul Ajar, LKPD, Bank Soal, Rubrik Penilaian, dan Media Pembelajaran secara praktis melalui satu platform berlangganan.
                </p>

                {{-- CTA Buttons --}}
                <div class="d-flex flex-wrap align-items-center gap-3">
                    <a href="{{ route('guest.paket-langganan') }}" class="btn btn-sd-orange btn-lg rounded-pill px-4 shadow-sm">
                        Lihat Paket Langganan <i class="ti ti-arrow-right ms-1"></i>
                    </a>
                    <a href="{{ route('guest.preview-materi') }}" class="btn btn-sd-outline btn-lg rounded-pill px-4">
                        <i class="ti ti-eye me-2"></i> Lihat Preview Materi
                    </a>
                </div>
            </div>

            {{-- Right column: Teacher Illustration Image --}}
            <div class="col-lg-6">
                <div class="position-relative mx-auto text-center" style="max-width: 520px;">
                    <div class="hero-image-card">
                        <img
                            src="{{ asset('assets/guest/img/hero-teacher.png') }}"
                            alt="Ilustrasi Guru SD Learning Center"
                            class="img-fluid w-100 rounded-3"
                        >
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ======================================================= --}}
{{-- 2. MENGAPA MEMILIH SD LEARNING CENTER? (6 CARDS)        --}}
{{-- ======================================================= --}}
<section class="py-6">
    <div class="container-xl">
        <div class="text-center mb-4">
            <h2 class="display-6 fw-bold text-dark mb-1" style="letter-spacing: -0.02em;">
                Mengapa Memilih SD Learning Center?
            </h2>
            <div class="section-underline-bar"></div>
        </div>

        <div class="row g-4">
            {{-- Card 1: Materi Lengkap --}}
            <div class="col-md-6 col-lg-4">
                <div class="feature-card">
                    <div class="feature-icon-box icon-box-pink">
                        <i class="ti ti-book-2"></i>
                    </div>
                    <h3 class="fw-bold fs-3 text-dark mb-2">Materi Lengkap</h3>
                    <p class="text-secondary small mb-0" style="line-height: 1.6;">
                        Koleksi perangkat ajar paling komprehensif mulai dari Kelas 1 hingga Kelas 6 SD.
                    </p>
                </div>
            </div>

            {{-- Card 2: Update Kurikulum --}}
            <div class="col-md-6 col-lg-4">
                <div class="feature-card">
                    <div class="feature-icon-box icon-box-peach">
                        <i class="ti ti-history"></i>
                    </div>
                    <h3 class="fw-bold fs-3 text-dark mb-2">Update Kurikulum</h3>
                    <p class="text-secondary small mb-0" style="line-height: 1.6;">
                        Konten selalu diperbarui mengikuti standar Kurikulum Merdeka dan regulasi terbaru Kemendikbud.
                    </p>
                </div>
            </div>

            {{-- Card 3: Mudah Digunakan --}}
            <div class="col-md-6 col-lg-4">
                <div class="feature-card">
                    <div class="feature-icon-box icon-box-olive">
                        <i class="ti ti-pointer"></i>
                    </div>
                    <h3 class="fw-bold fs-3 text-dark mb-2">Mudah Digunakan</h3>
                    <p class="text-secondary small mb-0" style="line-height: 1.6;">
                        Antarmuka yang bersih dan intuitif, dirancang khusus untuk memudahkan navigasi bapak/ibu guru.
                    </p>
                </div>
            </div>

            {{-- Card 4: Download Cepat --}}
            <div class="col-md-6 col-lg-4">
                <div class="feature-card">
                    <div class="feature-icon-box icon-box-pink">
                        <i class="ti ti-download"></i>
                    </div>
                    <h3 class="fw-bold fs-3 text-dark mb-2">Download Cepat</h3>
                    <p class="text-secondary small mb-0" style="line-height: 1.6;">
                        Server berkecepatan tinggi memastikan Anda dapat mengunduh dokumen dalam hitungan detik.
                    </p>
                </div>
            </div>

            {{-- Card 5: Akses Berlangganan --}}
            <div class="col-md-6 col-lg-4">
                <div class="feature-card">
                    <div class="feature-icon-box icon-box-peach">
                        <i class="ti ti-key"></i>
                    </div>
                    <h3 class="fw-bold fs-3 text-dark mb-2">Akses Berlangganan</h3>
                    <p class="text-secondary small mb-0" style="line-height: 1.6;">
                        Akses tanpa batas ke seluruh materi tanpa biaya tambahan selama masa langganan aktif.
                    </p>
                </div>
            </div>

            {{-- Card 6: Untuk Guru Indonesia --}}
            <div class="col-md-6 col-lg-4">
                <div class="feature-card">
                    <div class="feature-icon-box icon-box-olive">
                        <i class="ti ti-award"></i>
                    </div>
                    <h3 class="fw-bold fs-3 text-dark mb-2">Untuk Guru Indonesia</h3>
                    <p class="text-secondary small mb-0" style="line-height: 1.6;">
                        Dibuat oleh guru untuk guru. Memahami tantangan spesifik di sekolah dasar Indonesia.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ======================================================= --}}
{{-- 3. STATS COUNTER SECTION (4 CARDS)                      --}}
{{-- ======================================================= --}}
<section class="py-5">
    <div class="container-xl">
        <div class="row g-3 g-md-4">
            {{-- Stat 1 --}}
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-number text-stat-red">1200+</div>
                    <div class="stat-label">Perangkat Ajar</div>
                </div>
            </div>

            {{-- Stat 2 --}}
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-number text-stat-red">500+</div>
                    <div class="stat-label">Guru Bergabung</div>
                </div>
            </div>

            {{-- Stat 3 --}}
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-number text-stat-dark">6 Jenis</div>
                    <div class="stat-label">Dokumen Utama</div>
                </div>
            </div>

            {{-- Stat 4 --}}
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-number text-stat-red">38</div>
                    <div class="stat-label">Provinsi Terjangkau</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ======================================================= --}}
{{-- 4. CTA BANNER (GRADIENT CARD)                           --}}
{{-- ======================================================= --}}
<section class="py-6">
    <div class="container-xl">
        <div class="cta-banner-gradient text-center">
            <h2 class="display-5 fw-bold text-white mb-3" style="max-width: 620px; margin: 0 auto; line-height: 1.25;">
                Mulai Persiapkan<br>Pembelajaran dengan Lebih<br>Mudah
            </h2>
            <p class="text-white-50 fs-4 mb-4 mx-auto" style="max-width: 560px; line-height: 1.6;">
                Hemat waktu persiapan Anda hingga 70% dan fokuslah pada apa yang paling penting: mengajar dan mendampingi siswa.
            </p>
            <div>
                <a href="{{ route('guest.paket-langganan') }}" class="btn-cta-white shadow">
                    Lihat Paket Langganan
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
