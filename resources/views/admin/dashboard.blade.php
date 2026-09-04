@extends('admin.layouts.admin')

@section('title', 'Dashboard')

@section('page-pretitle', 'Overview')
@section('page-title', 'Dashboard Admin')
@section('page-description', 'Ringkasan performa platform, aktivitas pengguna, dan status materi.')

@section('content')

    {{-- Welcome Banner --}}
    <div class="admin-welcome-banner mb-4 shadow-sm">
        <div class="d-flex align-items-center justify-content-between position-relative" style="z-index: 1;">
            <div>
                <h2 class="banner-title mb-1">
                    Selamat Datang, {{ auth()->user()->nama ?? auth()->user()->name ?? 'Super Admin' }}! 👋
                </h2>
                <div class="banner-desc">
                    Kelola materi pendidikan, paket langganan, dan data guru SD Learning Center dengan mudah dan efisien.
                </div>
            </div>
            <div class="d-none d-md-block pe-3">
                <i class="ti ti-school banner-icon-watermark"></i>
            </div>
        </div>
    </div>

    {{-- 4 Stat Cards --}}
    <div class="row g-3 mb-4">

        {{-- Card 1: Total Guru --}}
        <div class="col-sm-6 col-lg-3">
            <div class="card-stat-modern">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon-box tint-blue">
                        <i class="ti ti-users"></i>
                    </div>
                    <div>
                        <div class="stat-label">TOTAL GURU</div>
                        <div class="stat-number">128</div>
                        <div class="stat-subtext">Guru terdaftar</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card 2: Materi --}}
        <div class="col-sm-6 col-lg-3">
            <div class="card-stat-modern">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon-box tint-orange">
                        <i class="ti ti-books"></i>
                    </div>
                    <div>
                        <div class="stat-label">MATERI</div>
                        <div class="stat-number">64</div>
                        <div class="stat-subtext">Modul & Perangkat Ajar</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card 3: Langganan Aktif --}}
        <div class="col-sm-6 col-lg-3">
            <div class="card-stat-modern">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon-box tint-green">
                        <i class="ti ti-credit-card"></i>
                    </div>
                    <div>
                        <div class="stat-label">LANGGANAN AKTIF</div>
                        <div class="stat-number">92</div>
                        <div class="stat-subtext">Guru berlangganan</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card 4: Sekolah --}}
        <div class="col-sm-6 col-lg-3">
            <div class="card-stat-modern">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon-box tint-purple">
                        <i class="ti ti-building"></i>
                    </div>
                    <div>
                        <div class="stat-label">SEKOLAH</div>
                        <div class="stat-number">18</div>
                        <div class="stat-subtext">Sekolah terhubung</div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Middle Section: Ringkasan Platform & Aktivitas Terbaru --}}
    <div class="row g-4 mb-4">
        <!-- Ringkasan Platform -->
        <div class="col-lg-7 col-xl-8">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-header py-3 d-flex align-items-center justify-content-between">
                    <h3 class="card-title">Ringkasan Platform</h3>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-light border rounded-pill dropdown-toggle text-secondary" type="button" data-bs-toggle="dropdown">
                            7 Hari Terakhir
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm rounded-3">
                            <li><a class="dropdown-item active" href="#">7 Hari Terakhir</a></li>
                            <li><a class="dropdown-item" href="#">30 Hari Terakhir</a></li>
                            <li><a class="dropdown-item" href="#">Bulan Ini</a></li>
                        </ul>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Visual Activity Chart Skeleton -->
                    <div class="p-3 bg-light rounded-3 mb-4 border">
                        <div class="d-flex align-items-end justify-content-between gap-2 text-center" style="height: 140px;">
                            <div class="w-100 d-flex flex-column align-items-center justify-content-end h-100">
                                <div class="bg-primary-subtle rounded-top w-75" style="height: 45%;"></div>
                                <span class="small text-muted mt-2" style="font-size: 0.75rem;">Sen</span>
                            </div>
                            <div class="w-100 d-flex flex-column align-items-center justify-content-end h-100">
                                <div class="bg-primary-subtle rounded-top w-75" style="height: 65%;"></div>
                                <span class="small text-muted mt-2" style="font-size: 0.75rem;">Sel</span>
                            </div>
                            <div class="w-100 d-flex flex-column align-items-center justify-content-end h-100">
                                <div class="bg-danger rounded-top w-75" style="height: 85%;"></div>
                                <span class="small mt-2 fw-bold text-danger" style="font-size: 0.75rem;">Rab</span>
                            </div>
                            <div class="w-100 d-flex flex-column align-items-center justify-content-end h-100">
                                <div class="bg-primary-subtle rounded-top w-75" style="height: 55%;"></div>
                                <span class="small text-muted mt-2" style="font-size: 0.75rem;">Kam</span>
                            </div>
                            <div class="w-100 d-flex flex-column align-items-center justify-content-end h-100">
                                <div class="bg-primary-subtle rounded-top w-75" style="height: 75%;"></div>
                                <span class="small text-muted mt-2" style="font-size: 0.75rem;">Jum</span>
                            </div>
                            <div class="w-100 d-flex flex-column align-items-center justify-content-end h-100">
                                <div class="bg-primary-subtle rounded-top w-75" style="height: 40%;"></div>
                                <span class="small text-muted mt-2" style="font-size: 0.75rem;">Sab</span>
                            </div>
                            <div class="w-100 d-flex flex-column align-items-center justify-content-end h-100">
                                <div class="bg-primary-subtle rounded-top w-75" style="height: 30%;"></div>
                                <span class="small text-muted mt-2" style="font-size: 0.75rem;">Min</span>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 text-center">
                        <div class="col-4">
                            <div class="p-3 border rounded-3 bg-white">
                                <small class="text-secondary fw-semibold d-block text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.05em;">Total Unduhan</small>
                                <span class="fw-bold text-dark fs-3">342</span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-3 border rounded-3 bg-white">
                                <small class="text-secondary fw-semibold d-block text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.05em;">Modul Baru</small>
                                <span class="fw-bold text-dark fs-3">16</span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-3 border rounded-3 bg-white">
                                <small class="text-secondary fw-semibold d-block text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.05em;">Guru Aktif</small>
                                <span class="fw-bold text-dark fs-3">92</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Aktivitas Terbaru -->
        <div class="col-lg-5 col-xl-4">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-header py-3">
                    <h3 class="card-title">Aktivitas Terbaru</h3>
                </div>
                <div class="card-body p-3">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item px-2 py-3 border-0 border-bottom d-flex align-items-start gap-3">
                            <div class="avatar avatar-sm bg-danger-subtle text-danger rounded-circle d-flex align-items-center justify-content-center flex-shrink-0">
                                <i class="ti ti-download"></i>
                            </div>
                            <div>
                                <div class="fw-bold text-dark small">Guru Budi Utomo, S.Pd.</div>
                                <div class="text-secondary small">Mengunduh <em>Modul IPAS Kelas 4 Sem 1</em></div>
                                <div class="text-muted" style="font-size: 0.725rem;">5 menit yang lalu</div>
                            </div>
                        </div>

                        <div class="list-group-item px-2 py-3 border-0 border-bottom d-flex align-items-start gap-3">
                            <div class="avatar avatar-sm bg-primary-subtle text-danger rounded-circle d-flex align-items-center justify-content-center flex-shrink-0">
                                <i class="ti ti-file-plus"></i>
                            </div>
                            <div>
                                <div class="fw-bold text-dark small">Admin Kurikulum</div>
                                <div class="text-secondary small">Menambahkan materi <em>Matematika Kelas 5</em></div>
                                <div class="text-muted" style="font-size: 0.725rem;">1 jam yang lalu</div>
                            </div>
                        </div>

                        <div class="list-group-item px-2 py-3 border-0 border-bottom d-flex align-items-start gap-3">
                            <div class="avatar avatar-sm bg-success-subtle text-success rounded-circle d-flex align-items-center justify-content-center flex-shrink-0">
                                <i class="ti ti-credit-card"></i>
                            </div>
                            <div>
                                <div class="fw-bold text-dark small">Siti Rahmawati, S.Pd.</div>
                                <div class="text-secondary small">Melakukan pembayaran paket langganan</div>
                                <div class="text-muted" style="font-size: 0.725rem;">3 jam yang lalu</div>
                            </div>
                        </div>

                        <div class="list-group-item px-2 py-3 border-0 d-flex align-items-start gap-3">
                            <div class="avatar avatar-sm bg-warning-subtle text-warning rounded-circle d-flex align-items-center justify-content-center flex-shrink-0">
                                <i class="ti ti-building"></i>
                            </div>
                            <div>
                                <div class="fw-bold text-dark small">SD Negeri 01 Menteng</div>
                                <div class="text-secondary small">Mendaftarkan 5 akun guru baru</div>
                                <div class="text-muted" style="font-size: 0.725rem;">1 hari yang lalu</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Bottom Section: Distribusi Konten & Sekolah Terbaru --}}
    <div class="row g-4">
        <!-- Distribusi Konten -->
        <div class="col-lg-6">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-header py-3">
                    <h3 class="card-title">Distribusi Konten Bahan Ajar</h3>
                </div>
                <div class="card-body p-4">
                    <div class="mb-4">
                        <div class="d-flex justify-content-between small fw-semibold mb-1">
                            <span>IPAS (Ilmu Pengetahuan Alam & Sosial)</span>
                            <span class="fw-bold text-danger">40% (24 Materi)</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 40%"></div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="d-flex justify-content-between small fw-semibold mb-1">
                            <span>Matematika</span>
                            <span class="fw-bold text-primary">25% (15 Materi)</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 25%"></div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="d-flex justify-content-between small fw-semibold mb-1">
                            <span>Bahasa Indonesia</span>
                            <span class="fw-bold text-success">20% (12 Materi)</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 20%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="d-flex justify-content-between small fw-semibold mb-1">
                            <span>Pendidikan Pancasila & SBdP</span>
                            <span class="fw-bold" style="color: #9333ea;">15% (9 Materi)</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar" role="progressbar" style="width: 15%; background-color: #9333ea;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sekolah Terbaru -->
        <div class="col-lg-6">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-header py-3 d-flex align-items-center justify-content-between">
                    <h3 class="card-title">Sekolah Mitra Terbaru</h3>
                    <a href="#" class="text-danger fw-bold text-decoration-none small">
                        Lihat Semua <i class="ti ti-arrow-right"></i>
                    </a>
                </div>
                <div class="card-body p-3">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item px-2 py-3 border-0 border-bottom d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar avatar-sm bg-light text-danger rounded-3 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-building"></i>
                                </div>
                                <div>
                                    <div class="fw-bold text-dark">SD Negeri 01 Menteng</div>
                                    <small class="text-muted">Jakarta Pusat • 12 Guru</small>
                                </div>
                            </div>
                            <span class="badge bg-success-lt text-success">Aktif</span>
                        </div>

                        <div class="list-group-item px-2 py-3 border-0 border-bottom d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar avatar-sm bg-light text-primary rounded-3 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-building"></i>
                                </div>
                                <div>
                                    <div class="fw-bold text-dark">SD Islam Al-Azhar 1</div>
                                    <small class="text-muted">Kebayoran Baru • 8 Guru</small>
                                </div>
                            </div>
                            <span class="badge bg-success-lt text-success">Aktif</span>
                        </div>

                        <div class="list-group-item px-2 py-3 border-0 d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar avatar-sm bg-light text-warning rounded-3 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-building"></i>
                                </div>
                                <div>
                                    <div class="fw-bold text-dark">SD Negeri 05 Bandung</div>
                                    <small class="text-muted">Kota Bandung • 15 Guru</small>
                                </div>
                            </div>
                            <span class="badge bg-success-lt text-success">Aktif</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
