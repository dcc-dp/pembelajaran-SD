@extends('guest.layouts.guest')

@section('title', 'Beranda')

@section('content')
{{-- ======================================================= --}}
{{-- 1. HERO SECTION                                         --}}
{{-- ======================================================= --}}
<section class="py-4 py-sm-5 py-lg-6 position-relative bg-white">
    <div class="container-xl">
        <div class="row align-items-center g-4 g-lg-5">
            {{-- Left column: Copywriting & Actions --}}
            <div class="col-lg-6">
                {{-- Platform Pill Badge --}}
                <div class="mb-3">
                    <span class="badge-sd-pill">
                        <i class="ti ti-crown fs-4 text-warning"></i>
                        Platform Guru SD No. 1 di Indonesia
                    </span>
                </div>

                {{-- Main Heading --}}
                <h1 class="hero-title text-dark mb-3">
                    Semua Perangkat <span style="color: #b7141b;">Ajar SD</span><br class="d-none d-md-inline"> dalam Satu Platform
                </h1>

                {{-- Description --}}
                <p class="hero-desc text-secondary mb-4 pb-1" style="max-width: 520px;">
                    Akses CP, ATP, Modul Ajar, LKPD, Bank Soal, Rubrik Penilaian, dan Media Pembelajaran secara praktis melalui satu platform berlangganan.
                </p>

                {{-- CTA Buttons --}}
                <div class="d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center gap-3">
                    <a href="{{ route('guest.paket-langganan') }}" class="btn btn-sd-orange btn-lg rounded-pill px-4 shadow-sm text-center">
                        Lihat Paket Langganan <i class="ti ti-arrow-right ms-1"></i>
                    </a>
                    <a href="{{ route('guest.preview-materi') }}" class="btn btn-sd-outline btn-lg rounded-pill px-4 text-center">
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
<section class="py-5 py-md-6 border-top border-bottom" style="background-color: #f8fafc;">
    <div class="container-xl">
        <div class="text-center mb-4">
            <span class="badge-sd-pill mb-2">
                <i class="ti ti-star text-warning"></i> Keunggulan Utama
            </span>
            <h2 class="section-title text-dark mb-1">
                Mengapa Memilih SD Learning Center?
            </h2>
            <div class="section-underline-bar"></div>
            <p class="text-secondary small mx-auto" style="max-width: 540px;">
                Dirancang khusus untuk membantu bapak/ibu guru menghemat waktu administrasi dan fokus memberikan pembelajaran terbaik di kelas.
            </p>
        </div>

        <div class="row g-3 g-md-4">
            {{-- Card 1: Materi Lengkap --}}
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

            {{-- Card 2: Update Kurikulum --}}
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

            {{-- Card 3: Mudah Digunakan --}}
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

            {{-- Card 4: Download Cepat --}}
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

            {{-- Card 5: Akses Berlangganan --}}
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

            {{-- Card 6: Untuk Guru Indonesia --}}
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

{{-- ======================================================= --}}
{{-- 3. STATS COUNTER SECTION (DYNAMIC FROM DATABASE)        --}}
{{-- ======================================================= --}}
<section class="py-5 bg-white">
    <div class="container-xl">
        <div class="row g-2 g-sm-3 g-md-4">
            {{-- Stat 1: Perangkat Ajar --}}
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-number text-stat-red">
                        {{ $totalMateri > 0 ? number_format($totalMateri) . ($totalMateri >= 10 ? '+' : '') : '0' }}
                    </div>
                    <div class="stat-label">Perangkat Ajar</div>
                </div>
            </div>

            {{-- Stat 2: Guru Bergabung --}}
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-number text-stat-red">
                        {{ $totalGuru > 0 ? number_format($totalGuru) . ($totalGuru >= 10 ? '+' : '') : '0' }}
                    </div>
                    <div class="stat-label">Guru Bergabung</div>
                </div>
            </div>

            {{-- Stat 3: Jenis Dokumen --}}
            <div class="col-6 col-md-3">
                <div class="stat-card">
                    <div class="stat-number text-stat-dark">
                        {{ $totalJenisDokumen }} Jenis
                    </div>
                    <div class="stat-label">Dokumen Utama</div>
                </div>
            </div>

            {{-- Stat 4: Mata Pelajaran --}}
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

{{-- ======================================================= --}}
{{-- 4. PREVIEW PERANGKAT AJAR TERBARU (DYNAMIC)             --}}
{{-- ======================================================= --}}
<section class="py-5 py-md-6 border-top border-bottom" style="background-color: #f8fafc;">
    <div class="container-xl">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-end mb-4 pb-2">
            <div>
                <span class="badge-sd-pill mb-2">
                    <i class="ti ti-sparkles text-danger"></i> Koleksi Pilihan
                </span>
                <h2 class="section-title text-dark mb-1">
                    Preview Perangkat Ajar Terbaru
                </h2>
                <p class="text-secondary small mb-0">
                    Contoh materi pembelajaran terstandar yang siap digunakan dan diunduh langsung.
                </p>
            </div>
            <div class="mt-3 mt-md-0">
                <a href="{{ route('guest.preview-materi') }}" class="btn btn-sd-outline rounded-pill px-3 py-2 d-inline-flex align-items-center gap-1 shadow-sm">
                    <span>Lihat Semua Materi</span>
                    <i class="ti ti-arrow-right"></i>
                </a>
            </div>
        </div>

        @if($materiTerbaru->isNotEmpty())
            <div class="row g-3 g-md-4 justify-content-center">
                @foreach($materiTerbaru as $materi)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="materi-card">
                            <div>
                                <div class="d-flex align-items-center justify-content-between gap-2 mb-3">
                                    <span class="materi-meta-tag">
                                        <i class="ti ti-file-text text-danger"></i>
                                        {{ $materi->jenisDokumen?->nama ?? 'Dokumen Ajar' }}
                                    </span>
                                    @if($materi->akses === 'gratis')
                                        <span class="badge-materi-gratis">
                                            <i class="ti ti-gift"></i> Gratis
                                        </span>
                                    @else
                                        <span class="badge-materi-premium">
                                            <i class="ti ti-crown"></i> Premium
                                        </span>
                                    @endif
                                </div>

                                <h4 class="fw-bold text-dark fs-3 mb-2" style="line-height: 1.4;">
                                    {{ Str::limit($materi->judul, 65) }}
                                </h4>

                                <p class="text-secondary small mb-3" style="line-height: 1.6;">
                                    {{ Str::limit($materi->deskripsi ?? 'Perangkat ajar kurikulum lengkap untuk menunjang kelancaran aktivitas belajar mengajar di kelas.', 90) }}
                                </p>
                            </div>

                            <div class="pt-3 border-top mt-auto">
                                <div class="d-flex flex-wrap align-items-center gap-2 mb-3 small text-muted">
                                    <span class="d-inline-flex align-items-center gap-1">
                                        <i class="ti ti-school text-danger"></i>
                                        {{ $materi->kelas?->nama ?? 'Semua Kelas' }}
                                    </span>
                                    <span>•</span>
                                    <span class="d-inline-flex align-items-center gap-1">
                                        <i class="ti ti-book text-secondary"></i>
                                        {{ $materi->mataPelajaran?->nama ?? 'Umum' }}
                                    </span>
                                    @if($materi->kurikulum)
                                        <span>•</span>
                                        <span class="d-inline-flex align-items-center gap-1">
                                            <i class="ti ti-certificate text-success"></i>
                                            {{ $materi->kurikulum->nama }}
                                        </span>
                                    @endif
                                </div>

                                <a href="{{ route('guest.preview-materi.show', ['id' => $materi->id]) }}" class="btn btn-sd-outline w-100 rounded-pill py-2 text-center d-inline-flex align-items-center justify-content-center gap-1">
                                    <i class="ti ti-eye"></i>
                                    <span>Preview Dokumen</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach

                {{-- Jika jumlah materi di database masih sedikit (< 3), tambahkan kartu informasi pendukung agar grid selalu simetris, terisi penuh, dan tidak terlihat kosong --}}
                @if($materiTerbaru->count() < 2)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="materi-complement-card">
                            <div>
                                <div class="d-flex align-items-center justify-content-between gap-2 mb-3">
                                    <span class="materi-meta-tag">
                                        <i class="ti ti-sparkles text-warning"></i>
                                        Kurikulum Merdeka
                                    </span>
                                    <span class="badge bg-danger-lt text-danger fw-bold rounded-pill px-2 py-1 small">
                                        Terstandarisasi
                                    </span>
                                </div>

                                <h4 class="fw-bold text-dark fs-3 mb-2" style="line-height: 1.4;">
                                    Modul Ajar & LKPD Terpadu
                                </h4>

                                <p class="text-secondary small mb-3" style="line-height: 1.6;">
                                    Seluruh perangkat pembelajaran disusun runtut mulai dari CP, TP, ATP, Modul Ajar, hingga Asesmen dan Lembar Kerja Siswa untuk Kelas 1 hingga 6.
                                </p>
                            </div>

                            <div class="pt-3 border-top mt-auto">
                                <div class="small text-muted mb-3 d-flex align-items-center gap-1">
                                    <i class="ti ti-check text-success"></i>
                                    Format Docx (Word) Siap Edit & Cetak
                                </div>
                                <a href="{{ route('guest.preview-materi') }}" class="btn btn-sd-outline w-100 rounded-pill py-2 text-center d-inline-flex align-items-center justify-content-center gap-1">
                                    <i class="ti ti-folder"></i>
                                    <span>Jelajahi Bank Materi</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

                @if($materiTerbaru->count() < 3)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="materi-complement-card">
                            <div>
                                <div class="d-flex align-items-center justify-content-between gap-2 mb-3">
                                    <span class="materi-meta-tag">
                                        <i class="ti ti-headset text-primary"></i>
                                        Layanan Pendidik
                                    </span>
                                    <span class="badge bg-success-lt text-success fw-bold rounded-pill px-2 py-1 small">
                                        Bebas Request
                                    </span>
                                </div>

                                <h4 class="fw-bold text-dark fs-3 mb-2" style="line-height: 1.4;">
                                    Butuh Perangkat Ajar Spesifik?
                                </h4>

                                <p class="text-secondary small mb-3" style="line-height: 1.6;">
                                    Belum menemukan modul yang Anda butuhkan? Tim pengembang kami siap membantu menyusun perangkat pembelajaran khusus sesuai kebutuhan sekolah Anda.
                                </p>
                            </div>

                            <div class="pt-3 border-top mt-auto">
                                <div class="small text-muted mb-3 d-flex align-items-center gap-1">
                                    <i class="ti ti-clock text-primary"></i>
                                    Penyusunan Cepat & Sesuai Regulasi
                                </div>
                                <a href="{{ route('guest.tentang') }}" class="btn btn-sd-outline w-100 rounded-pill py-2 text-center d-inline-flex align-items-center justify-content-center gap-1">
                                    <i class="ti ti-help"></i>
                                    <span>Konsultasi Kurikulum</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @else
            <div class="text-center py-5 px-3 bg-white rounded-4 border shadow-sm my-3" style="max-width: 650px; margin: 0 auto;">
                <div class="mb-3">
                    <i class="ti ti-folders text-secondary" style="font-size: 3rem;"></i>
                </div>
                <h4 class="fw-bold text-dark mb-1">Perangkat Ajar Sedang Dipersiapkan</h4>
                <p class="text-secondary small mb-3" style="max-width: 480px; margin: 0 auto;">
                    Dokumen pembelajaran baru sedang dalam tahap verifikasi standar kualitas Kemendikbud dan akan segera tersedia untuk bapak/ibu guru.
                </p>
                <a href="{{ route('guest.preview-materi') }}" class="btn btn-sd-primary rounded-pill px-4">
                    Kunjungi Halaman Preview
                </a>
            </div>
        @endif
    </div>
</section>

{{-- ======================================================= --}}
{{-- 5. PILIHAN PAKET LANGGANAN (DYNAMIC)                    --}}
{{-- ======================================================= --}}
<section class="py-5 py-md-6 bg-white">
    <div class="container-xl">
        <div class="text-center mb-5">
            <span class="badge-sd-pill mb-2">
                <i class="ti ti-shield-check text-success"></i> Akses Lengkap
            </span>
            <h2 class="section-title text-dark mb-1">
                Pilihan Paket Langganan
            </h2>
            <div class="section-underline-bar"></div>
            <p class="text-secondary small mx-auto" style="max-width: 540px;">
                Dapatkan akses tanpa batas ke ribuan perangkat ajar terstandarisasi untuk menunjang kemudahan mengajar Anda.
            </p>
        </div>

        @if($paketLangganan->isNotEmpty())
            <div class="row g-4 justify-content-center">
                @foreach($paketLangganan as $index => $paket)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="paket-card {{ $index === 1 ? 'paket-card-featured' : '' }}">
                            @if($index === 1)
                                <div class="paket-badge-popular">
                                    Paling Diminati
                                </div>
                            @endif

                            <div>
                                <h3 class="fw-bold fs-2 text-dark mb-1">
                                    {{ $paket->nama }}
                                </h3>

                                <div class="text-secondary small mb-3">
                                    {{ $paket->kelas?->nama ?? 'Semua Kelas' }} • {{ $paket->semester?->nama ?? 'Semua Semester' }}
                                </div>

                                <div class="my-4">
                                    <div class="d-flex align-items-baseline gap-1">
                                        <span class="fs-4 text-muted fw-bold">Rp</span>
                                        <span class="paket-price-amount">
                                            {{ number_format($paket->harga, 0, ',', '.') }}
                                        </span>
                                        <span class="text-secondary small ms-1">/ {{ $paket->durasi_bulan }} Bln</span>
                                    </div>
                                </div>

                                <p class="text-secondary small mb-4" style="line-height: 1.6;">
                                    {{ $paket->deskripsi ?? 'Akses lengkap unduh seluruh modul ajar, bank soal, dan perangkat kurikulum merdeka.' }}
                                </p>
                            </div>

                            <div class="pt-3 border-top mt-auto">
                                <a href="{{ route('register') }}" class="{{ $index === 1 ? 'btn-sd-orange' : 'btn-sd-outline' }} btn w-100 rounded-pill py-2 text-center">
                                    Mulai Berlangganan
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            {{-- Tampilan Preview Tier Card Profesional Saat Belum Ada Paket Aktif di Database --}}
            <div class="row g-4 justify-content-center">
                {{-- Tier 1: Paket Semester --}}
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="paket-card">
                        <div>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="badge bg-secondary-lt text-secondary rounded-pill px-2 py-1 small fw-bold">
                                    Paket Reguler
                                </span>
                                <span class="badge bg-warning-lt text-warning rounded-pill px-2 py-1 small fw-bold">
                                    Segera Rilis
                                </span>
                            </div>

                            <h3 class="fw-bold fs-2 text-dark mb-1">
                                Paket Semester
                            </h3>
                            <div class="text-secondary small mb-3">
                                Khusus 1 Semester Ajaran
                            </div>

                            <div class="my-3 pb-2 border-bottom">
                                <div class="text-danger fw-bold fs-3">
                                    Harga Terjangkau
                                </div>
                                <div class="text-muted small">
                                    Pilihan fleksibel per semester
                                </div>
                            </div>

                            <div class="my-3">
                                <div class="teaser-feature-item">
                                    <span class="teaser-feature-icon"><i class="ti ti-check"></i></span>
                                    <span>Akses seluruh Modul Ajar Kelas 1 - 6</span>
                                </div>
                                <div class="teaser-feature-item">
                                    <span class="teaser-feature-icon"><i class="ti ti-check"></i></span>
                                    <span>Format Docx (Word) Siap Edit & PDF</span>
                                </div>
                                <div class="teaser-feature-item">
                                    <span class="teaser-feature-icon"><i class="ti ti-check"></i></span>
                                    <span>Download cepat tanpa antre</span>
                                </div>
                                <div class="teaser-feature-item">
                                    <span class="teaser-feature-icon"><i class="ti ti-check"></i></span>
                                    <span>Termasuk LKPD & Asesmen Siswa</span>
                                </div>
                            </div>
                        </div>

                        <div class="pt-3 border-top mt-auto">
                            <a href="{{ route('register') }}" class="btn btn-sd-outline w-100 rounded-pill py-2 text-center">
                                Daftar Akun Guru
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Tier 2: Paket Tahunan (Featured) --}}
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="paket-card paket-card-featured">
                        <div class="paket-badge-popular">
                            Paling Diminati Guru
                        </div>

                        <div>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="badge bg-danger text-white rounded-pill px-2 py-1 small fw-bold">
                                    Best Value
                                </span>
                                <span class="badge bg-warning-lt text-warning rounded-pill px-2 py-1 small fw-bold">
                                    Segera Rilis
                                </span>
                            </div>

                            <h3 class="fw-bold fs-2 text-dark mb-1">
                                Paket Tahunan
                            </h3>
                            <div class="text-secondary small mb-3">
                                Akses Penuh 1 Tahun Ajaran
                            </div>

                            <div class="my-3 pb-2 border-bottom">
                                <div class="text-danger fw-bold fs-3">
                                    Paling Hemat & Lengkap
                                </div>
                                <div class="text-muted small">
                                    Bebas unduh tanpa batasan kuota
                                </div>
                            </div>

                            <div class="my-3">
                                <div class="teaser-feature-item">
                                    <span class="teaser-feature-icon"><i class="ti ti-check"></i></span>
                                    <span>Seluruh fitur Paket Semester</span>
                                </div>
                                <div class="teaser-feature-item">
                                    <span class="teaser-feature-icon"><i class="ti ti-check"></i></span>
                                    <span>Bank Soal & Kisi-kisi Sumatif Lengkap</span>
                                </div>
                                <div class="teaser-feature-item">
                                    <span class="teaser-feature-icon"><i class="ti ti-check"></i></span>
                                    <span>Rubrik Penilaian & Format Nilai Rapor</span>
                                </div>
                                <div class="teaser-feature-item">
                                    <span class="teaser-feature-icon"><i class="ti ti-check"></i></span>
                                    <span>Update otomatis materi baru kurikulum</span>
                                </div>
                            </div>
                        </div>

                        <div class="pt-3 border-top mt-auto">
                            <a href="{{ route('register') }}" class="btn btn-sd-orange w-100 rounded-pill py-2 text-center shadow-sm">
                                Daftar untuk Notifikasi Rilis
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Tier 3: Paket Sekolah / Kolektif --}}
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="paket-card">
                        <div>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="badge bg-primary-lt text-primary rounded-pill px-2 py-1 small fw-bold">
                                    Lembaga / Sekolah
                                </span>
                                <span class="badge bg-info-lt text-info rounded-pill px-2 py-1 small fw-bold">
                                    Multi User
                                </span>
                            </div>

                            <h3 class="fw-bold fs-2 text-dark mb-1">
                                Paket Sekolah / KKG
                            </h3>
                            <div class="text-secondary small mb-3">
                                Untuk Seluruh Guru di Sekolah
                            </div>

                            <div class="my-3 pb-2 border-bottom">
                                <div class="text-dark fw-bold fs-3">
                                    Tarif Kolektif
                                </div>
                                <div class="text-muted small">
                                    Akses rombel untuk dewan guru
                                </div>
                            </div>

                            <div class="my-3">
                                <div class="teaser-feature-item">
                                    <span class="teaser-feature-icon"><i class="ti ti-check"></i></span>
                                    <span>Multi-akun untuk seluruh guru sekolah</span>
                                </div>
                                <div class="teaser-feature-item">
                                    <span class="teaser-feature-icon"><i class="ti ti-check"></i></span>
                                    <span>Bank perangkat ajar terpusat</span>
                                </div>
                                <div class="teaser-feature-item">
                                    <span class="teaser-feature-icon"><i class="ti ti-check"></i></span>
                                    <span>Pendampingan kurikulum prioritas</span>
                                </div>
                                <div class="teaser-feature-item">
                                    <span class="teaser-feature-icon"><i class="ti ti-check"></i></span>
                                    <span>Bantuan teknis & format resmi sekolah</span>
                                </div>
                            </div>
                        </div>

                        <div class="pt-3 border-top mt-auto">
                            <a href="{{ route('guest.tentang') }}" class="btn btn-sd-outline w-100 rounded-pill py-2 text-center">
                                Konsultasi Paket Sekolah
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <div class="p-3 bg-light rounded-3 d-inline-flex align-items-center gap-2 text-secondary small border">
                    <i class="ti ti-info-circle text-danger fs-3"></i>
                    <span>Paket langganan resmi sedang dipersiapkan dan akan segera dirilis dengan harga terbaik untuk guru Indonesia.</span>
                </div>
            </div>
        @endif
    </div>
</section>

{{-- ======================================================= --}}
{{-- 6. PERTANYAAN UMUM / FAQ (DYNAMIC JIKA TERSEDIA)        --}}
{{-- ======================================================= --}}
@if($faqs->isNotEmpty())
<section class="py-5 py-md-6 border-top" style="background-color: #f8fafc;">
    <div class="container-xl">
        <div class="text-center mb-4">
            <h2 class="section-title text-dark mb-1">
                Pertanyaan yang Sering Diajukan
            </h2>
            <div class="section-underline-bar"></div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="faqAccordionHome">
                    @foreach($faqs as $fIndex => $faq)
                        <div class="accordion-item faq-accordion-item">
                            <h3 class="accordion-header" id="headingFaq{{ $faq->id }}">
                                <button
                                    class="accordion-button faq-accordion-button {{ $fIndex !== 0 ? 'collapsed' : '' }}"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#collapseFaq{{ $faq->id }}"
                                    aria-expanded="{{ $fIndex === 0 ? 'true' : 'false' }}"
                                    aria-controls="collapseFaq{{ $faq->id }}"
                                >
                                    {{ $faq->pertanyaan }}
                                </button>
                            </h3>
                            <div
                                id="collapseFaq{{ $faq->id }}"
                                class="accordion-collapse collapse {{ $fIndex === 0 ? 'show' : '' }}"
                                aria-labelledby="headingFaq{{ $faq->id }}"
                                data-bs-parent="#faqAccordionHome"
                            >
                                <div class="accordion-body text-secondary small pt-0 pb-3" style="line-height: 1.7;">
                                    {{ $faq->jawaban }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('guest.faq') }}" class="btn btn-sd-outline rounded-pill px-4">
                        Lihat Semua Pertanyaan (FAQ)
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

{{-- ======================================================= --}}
{{-- 7. CTA BANNER (GRADIENT CARD)                           --}}
{{-- ======================================================= --}}
<section class="py-4 py-md-6 mb-2 bg-white">
    <div class="container-xl">
        <div class="cta-banner-gradient text-center">
            <h2 class="cta-banner-title text-white mb-3 mx-auto" style="max-width: 620px;">
                Mulai Persiapkan<br class="d-none d-md-inline"> Pembelajaran dengan Lebih<br class="d-none d-md-inline"> Mudah
            </h2>
            <p class="cta-banner-desc text-white-50 mb-4 mx-auto" style="max-width: 560px;">
                Hemat waktu persiapan Anda hingga 70% dan fokuslah pada apa yang paling penting: mengajar dan mendampingi siswa.
            </p>
            <div>
                <a href="{{ route('guest.paket-langganan') }}" class="btn-cta-white shadow px-4 py-2 py-md-3">
                    Lihat Paket Langganan
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
