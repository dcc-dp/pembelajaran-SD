@extends('guest.layouts.guest')

@section('title', 'Tentang Kami')

@section('content')

<section class="py-5 py-md-6 bg-white border-bottom position-relative">
    <div class="container-xl">
        <div class="text-center mx-auto" style="max-width: 800px;">
            <div class="mb-3">
                <span class="about-platform-badge">
                    Tentang Platform Kami
                </span>
            </div>
            <h1 class="hero-title text-dark mb-3">
                Tentang <span style="color: #b7141b;">SD Learning Center</span>
            </h1>
            <p class="hero-desc text-secondary mx-auto mb-0" style="max-width: 720px; line-height: 1.8;">
                SD Learning Center merupakan platform digital penyedia perangkat ajar terstandarisasi untuk Guru Sekolah Dasar di seluruh Indonesia. Praktis, cepat, dan selalu selaras dengan Kurikulum Merdeka.
            </p>
        </div>
    </div>
</section>

<!-- VISI MISI -->
<section class="py-5 py-md-6 border-bottom" style="background-color: #f8fafc;">
    <div class="container-xl">
        <div class="row align-items-center g-4 g-lg-5">
        <!-- KIRI -->
        <div class="col-lg-6">
                <div class="pe-lg-4">
                    <div class="mb-3">
                        <span class="badge-sd-pill">
                            <i class="text-warning"></i> Cerita Kami
                        </span>
                    </div>

                    <h2 class="section-title text-dark mb-4">
                        Dedikasi Nyata untuk <br class="d-none d-md-inline">Kemudahan Mengajar Guru SD
                    </h2>

                    <p class="about-narrative-text">
                        Guru adalah garda terdepan transformasi pendidikan. Namun dalam praktiknya, waktu berharga para pendidik sering tersita oleh beban administratif yang rumit mulai dari penyusunan Modul Ajar, ATP, instrumen asesmen, hingga lembar kerja siswa.
                    </p>
                    <p class="about-narrative-text mb-4 pb-2">
                        <strong class="text-dark">SD Learning Center</strong> hadir sebagai solusi praktis. Kami menghimpun dan memvalidasi berkas perangkat ajar terstruktur yang siap pakai dan mudah disesuaikan, sehingga bapak dan ibu guru dapat lebih berfokus mendampingi proses belajar siswa.
                    </p>

                    <div class="row g-2 g-sm-3">
                        <div class="col-sm-6">
                            <div class="about-feature-chip">
                                <span class="about-feature-chip-icon">
                                    <i class="ti ti-check"></i>
                                </span>
                                <span class="about-feature-chip-text">Hemat Waktu Administrasi</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="about-feature-chip">
                                <span class="about-feature-chip-icon">
                                    <i class="ti ti-check"></i>
                                </span>
                                <span class="about-feature-chip-text">100% Sesuai Regulasi Kemendikbud</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="about-feature-chip">
                                <span class="about-feature-chip-icon">
                                    <i class="ti ti-check"></i>
                                </span>
                                <span class="about-feature-chip-text">Lengkap Kelas 1 hingga 6</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="about-feature-chip">
                                <span class="about-feature-chip-icon">
                                    <i class="ti ti-check"></i>
                                </span>
                                <span class="about-feature-chip-text">Format Word &amp; PDF Siap Edit</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- KANAN -->
            <div class="col-lg-6">
                <div class="d-flex flex-column gap-3">
                    <div class="about-separate-card">
                        <div class="d-flex align-items-center gap-2 text-danger fw-bold small text-uppercase mb-2" style="letter-spacing: 0.05em;">
                            <i class="ti ti-eye fs-4"></i> Visi Kami
                        </div>
                        <p class="text-dark fw-medium mb-0" style="line-height: 1.7; font-size: 0.95rem;">
                            Menjadi platform sumber daya perangkat ajar Sekolah Dasar nomor 1 di Indonesia yang terpercaya, inklusif, dan adaptif untuk mendukung pembelajaran yang bermakna.
                        </p>
                    </div>

                    <div class="about-separate-card">
                        <div class="d-flex align-items-center gap-2 text-dark fw-bold small text-uppercase mb-3" style="letter-spacing: 0.05em;">
                            <i class="ti ti-flag-3 text-warning fs-4"></i> Misi Kami
                        </div>
                        <ul class="list-unstyled mb-0 d-flex flex-column gap-3">
                            <li class="d-flex align-items-start gap-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center bg-danger-subtle text-danger flex-shrink-0 mt-1" style="width: 28px; height: 28px; font-size: 0.9rem;">
                                    <i class="ti ti-check"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold text-dark mb-1" style="font-size: 0.95rem;">Perangkat Ajar Terstandarisasi</h5>
                                    <p class="text-secondary small mb-0" style="line-height: 1.5;">Menyediakan modul ajar, ATP, modul projek, dan LKPD yang tervalidasi serta selalu mutakhir.</p>
                                </div>
                            </li>
                            <li class="d-flex align-items-start gap-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center bg-danger-subtle text-danger flex-shrink-0 mt-1" style="width: 28px; height: 28px; font-size: 0.9rem;">
                                    <i class="ti ti-check"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold text-dark mb-1" style="font-size: 0.95rem;">Akses Fleksibel &amp; Terbuka</h5>
                                    <p class="text-secondary small mb-0" style="line-height: 1.5;">Memudahkan guru mengunduh dan menyunting berkas sesuai kebutuhan satuan pendidikan masing-masing.</p>
                                </div>
                            </li>
                            <li class="d-flex align-items-start gap-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center bg-danger-subtle text-danger flex-shrink-0 mt-1" style="width: 28px; height: 28px; font-size: 0.9rem;">
                                    <i class="ti ti-check"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold text-dark mb-1" style="font-size: 0.95rem;">Pemerataan Mutu Pendidikan</h5>
                                    <p class="text-secondary small mb-0" style="line-height: 1.5;">Menjangkau guru di berbagai wilayah dengan layanan yang mudah diakses dan biaya yang sangat terjangkau.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 py-md-6 bg-white border-bottom">
    <div class="container-xl">
        <div class="text-center mx-auto mb-5" style="max-width: 650px;">
            <h2 class="section-title text-dark mb-2">Nilai Utama Platform</h2>
            <p class="text-secondary small mb-0">Empat prinsip yang menjadi landasan kami dalam menghadirkan materi terbaik untuk para pendidik.</p>
        </div>

        <div class="row g-4">
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="about-pillar-card">
                    <div class="about-icon-box tint-red">
                        <i class="ti ti-shield-check"></i>
                    </div>
                    <h4 class="fw-bold text-dark fs-3 mb-2">Akurasi Regulasi</h4>
                    <p class="text-secondary small mb-0" style="line-height: 1.6;">
                        Materi disusun berpedoman pada Capaian Pembelajaran (CP) dan regulasi kurikulum resmi Kemendikbudristek.
                    </p>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3">
                <div class="about-pillar-card">
                    <div class="about-icon-box tint-amber">
                        <i class="ti ti-file-text"></i>
                    </div>
                    <h4 class="fw-bold text-dark fs-3 mb-2">Format Siap Edit</h4>
                    <p class="text-secondary small mb-0" style="line-height: 1.6;">
                        Tersedia dalam format Word (.docx) dan PDF sehingga mudah disesuaikan dengan konteks sekolah Anda.
                    </p>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3">
                <div class="about-pillar-card">
                    <div class="about-icon-box tint-emerald">
                        <i class="ti ti-clock"></i>
                    </div>
                    <h4 class="fw-bold text-dark fs-3 mb-2">Hemat Waktu</h4>
                    <p class="text-secondary small mb-0" style="line-height: 1.6;">
                        Memangkas waktu persiapan administrasi agar guru dapat lebih fokus pada proses pembelajaran siswa.
                    </p>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3">
                <div class="about-pillar-card">
                    <div class="about-icon-box tint-blue">
                        <i class="ti ti-refresh"></i>
                    </div>
                    <h4 class="fw-bold text-dark fs-3 mb-2">Pembaruan Rutin</h4>
                    <p class="text-secondary small mb-0" style="line-height: 1.6;">
                        Konten dan bank instrumen terus diperbarui mengikuti perkembangan kalender akademik dan kurikulum.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="py-5 py-md-6" style="background-color: #f8fafc;">
    <div class="container-xl">
        <div class="cta-banner-gradient text-center">
            <h2 class="cta-banner-title text-white mb-3 mx-auto" style="max-width: 650px;">
                Siap Meningkatkan Kualitas Pembelajaran di Kelas?
            </h2>
            <p class="cta-banner-desc text-white-50 mb-4 mx-auto" style="max-width: 580px;">
                Dapatkan kemudahan akses ke seluruh modul ajar dan dokumen evaluasi bersama SD Learning Center.
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
