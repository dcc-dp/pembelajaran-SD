@extends('guest.layouts.guest')

@section('title', 'Beranda')

@section('content')

<!-- HERO -->
<section class="py-4 py-sm-5 py-lg-6 position-relative bg-white">
    <div class="container-xl">
        <div class="row align-items-center g-4 g-lg-5">
            <div class="col-lg-6">
                <div class="mb-3">
                    <span class="badge-sd-pill">
                        <i class="ti ti-crown fs-4 text-warning"></i>
                        Platform Guru SD No. 1 di Indonesia
                    </span>
                </div>

                <h1 class="hero-title text-dark mb-3">
                    Semua Perangkat <span style="color: #b7141b;">Ajar SD</span><br class="d-none d-md-inline"> dalam Satu Platform
                </h1>

                <p class="hero-desc text-secondary mb-4 pb-1" style="max-width: 520px;">
                    Akses CP, ATP, Modul Ajar, LKPD, Bank Soal, Rubrik Penilaian, dan Media Pembelajaran secara praktis melalui satu platform berlangganan.
                </p>

                <div class="d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center gap-3">
                    <a href="{{ route('guest.paket-langganan') }}" class="btn btn-sd-orange btn-lg rounded-pill px-4 shadow-sm text-center">
                        Lihat Paket Langganan <i class="ti ti-arrow-right ms-1"></i>
                    </a>
                    <a href="{{ route('guest.preview-materi') }}" class="btn btn-sd-outline btn-lg rounded-pill px-4 text-center">
                        <i class="ti ti-eye me-2"></i> Lihat Preview Materi
                    </a>
                </div>
            </div>

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

<!-- KEUNGGULAN -->
<section class="py-5 py-md-6 border-top border-bottom" style="background-color: #f8fafc;">
    <div class="container-xl">
        <div class="text-center mb-5 mx-auto" style="max-width: 650px;">
            <div class="mb-3">
                <span class="badge-sd-pill">
                    <i class="text-warning"></i> Keunggulan Utama
                </span>
            </div>
            <h2 class="section-title text-dark mb-2">
                Mengapa Memilih SD Learning Center?
            </h2>
            <p class="text-secondary small mx-auto mb-0" style="max-width: 540px; line-height: 1.7;">
                Dirancang khusus untuk membantu bapak/ibu guru menghemat waktu administrasi dan fokus memberikan pembelajaran terbaik di kelas.
            </p>
        </div>

        <div class="row g-3 g-md-4">
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="feature-card">
                    <div class="feature-icon-box icon-box-pink">
                        <i class="ti ti-book-2"></i>
                    </div>
                    <h3 class="fw-bold fs-3 text-dark mb-2">Materi Lengkap</h3>
                    <p class="text-secondary small mb-0" style="line-height: 1.6;">
                        Koleksi perangkat ajar paling komprehensif mulai dari Kelas 1 hingga Kelas 6 SD untuk semua mata pelajaran.
                    </p>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-4">
                <div class="feature-card">
                    <div class="feature-icon-box icon-box-peach">
                        <i class="ti ti-history"></i>
                    </div>
                    <h3 class="fw-bold fs-3 text-dark mb-2">Update Kurikulum</h3>
                    <p class="text-secondary small mb-0" style="line-height: 1.6;">
                        Konten selalu diperbarui mengikuti standar Kurikulum Merdeka dan regulasi terbaru dari Kemendikbudristek.
                    </p>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-4">
                <div class="feature-card">
                    <div class="feature-icon-box icon-box-olive">
                        <i class="ti ti-pointer"></i>
                    </div>
                    <h3 class="fw-bold fs-3 text-dark mb-2">Mudah Digunakan</h3>
                    <p class="text-secondary small mb-0" style="line-height: 1.6;">
                        Antarmuka yang bersih dan intuitif, dirancang khusus untuk memudahkan navigasi bapak/ibu guru di semua perangkat.
                    </p>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-4">
                <div class="feature-card">
                    <div class="feature-icon-box icon-box-pink">
                        <i class="ti ti-download"></i>
                    </div>
                    <h3 class="fw-bold fs-3 text-dark mb-2">Download Cepat</h3>
                    <p class="text-secondary small mb-0" style="line-height: 1.6;">
                        Server berkecepatan tinggi memastikan Anda dapat mengunduh dokumen Word & PDF dalam hitungan detik.
                    </p>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-4">
                <div class="feature-card">
                    <div class="feature-icon-box icon-box-peach">
                        <i class="ti ti-key"></i>
                    </div>
                    <h3 class="fw-bold fs-3 text-dark mb-2">Akses Berlangganan</h3>
                    <p class="text-secondary small mb-0" style="line-height: 1.6;">
                        Akses tanpa batas ke seluruh materi tanpa biaya tersembunyi selama masa langganan aktif.
                    </p>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-4">
                <div class="feature-card">
                    <div class="feature-icon-box icon-box-olive">
                        <i class="ti ti-award"></i>
                    </div>
                    <h3 class="fw-bold fs-3 text-dark mb-2">Untuk Guru Indonesia</h3>
                    <p class="text-secondary small mb-0" style="line-height: 1.6;">
                        Dibuat oleh guru untuk guru. Memahami tantangan spesifik yang dihadapi di lingkungan sekolah dasar Indonesia.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="py-5 bg-white">
    <div class="container-xl">
        <div class="row g-2 g-sm-3 g-md-4">
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-number text-stat-red">
                        {{ $totalMateri > 0 ? number_format($totalMateri) . ($totalMateri >= 10 ? '+' : '') : '0' }}
                    </div>
                    <div class="stat-label">Perangkat Ajar</div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-number text-stat-red">
                        {{ $totalGuru > 0 ? number_format($totalGuru) . ($totalGuru >= 10 ? '+' : '') : '0' }}
                    </div>
                    <div class="stat-label">Guru Bergabung</div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-number text-stat-dark">
                        {{ $totalJenisDokumen }} Jenis
                    </div>
                    <div class="stat-label">Dokumen Utama</div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-number text-stat-red">
                        {{ $totalMataPelajaran }}
                    </div>
                    <div class="stat-label">Mata Pelajaran</div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="py-5 py-md-6 border-top" style="background-color: #f8fafc;">
    <div class="container-xl">
        <div class="cta-banner-gradient text-center">
            <h2 class="cta-banner-title text-white mb-3 mx-auto" style="max-width: 650px;">
                Mulai Persiapkan Pembelajaran dengan Lebih Mudah
            </h2>
            <p class="cta-banner-desc text-white-50 mb-4 mx-auto" style="max-width: 580px;">
                Hemat waktu persiapan Anda hingga 70% dan fokuslah pada apa yang paling penting: mengajar dan mendampingi siswa di kelas
            </p>
            <div class="d-flex flex-column flex-sm-row justify-content-center align-items-center gap-3">
                <a href="{{ route('guest.paket-langganan') }}" class="btn-cta-white shadow px-4 py-2 py-md-3">
                    Lihat Paket Langganan <i class="ti ti-arrow-right ms-1"></i>
                </a>
                <a href="{{ route('guest.preview-materi') }}" class="btn btn-outline-light rounded-pill px-4 py-2 py-md-3 fw-semibold">
                    <i class="ti ti-eye me-1"></i> Coba Preview Gratis
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
