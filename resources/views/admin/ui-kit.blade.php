@extends('admin.layouts.admin')

@section('title', 'UI Kit')

@section('page-pretitle', 'Referensi Komponen')
@section('page-title', 'UI Kit — SD Learning Center')

@section('content')

    <div class="alert alert-info mb-4">
        <div class="d-flex">
            <div><i class="ti ti-info-circle me-2"></i></div>
            <div>
                Halaman ini adalah <strong>referensi komponen</strong> yang dipakai di seluruh modul admin.
                Copy-paste markup dari sini saat membuat halaman baru, biar tampilan tetap konsisten antar modul.
            </div>
        </div>
    </div>

     {{-- Top Description & Quick Navigation Tabs --}}
    <div class="mb-4">
        <p class="text-secondary mb-3 fs-6">
            Komponen antarmuka standar untuk menjaga konsistensi tampilan platform <strong>SD Learning Center</strong>.
            Salin (*copy-paste*) kode markup dari halaman ini untuk modul baru.
        </p>

        <!-- Sub-navbar Pills -->
        <div class="ui-kit-nav-tabs shadow-sm mb-2">
            <a href="#foundations" class="nav-link active">Foundations</a>
            <a href="#buttons" class="nav-link">Buttons</a>
            <a href="#forms" class="nav-link">Forms</a>
            <a href="#feedback" class="nav-link">Feedback</a>
            <a href="#data-display" class="nav-link">Data Display</a>
            <a href="#navigation" class="nav-link">Navigation</a>
        </div>
    </div>

    {{-- ================= 1. FOUNDATIONS ================= --}}
    <div id="foundations" class="mb-5 pt-3">
        <div class="d-flex align-items-center gap-2 mb-3">
            <span class="badge bg-danger-subtle text-danger fs-6 px-3 py-2 rounded-pill fw-bold">1</span>
            <h3 class="fw-bold text-dark mb-0">Foundations</h3>
        </div>

        <div class="row g-4">
            <!-- Colors Palette -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white border-0 pt-4 px-4">
                        <h5 class="fw-bold text-dark mb-0"><i class="ti ti-palette me-2 text-danger"></i>Colors Palette</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3">
                            <div class="col-6 col-sm-3">
                                <div class="color-swatch-chip" style="background-color: #b7131a;">Primary</div>
                                <div class="mt-2">
                                    <small class="fw-bold d-block text-dark">Primary Red</small>
                                    <small class="text-muted">#b7131a</small>
                                </div>
                            </div>
                            <div class="col-6 col-sm-3">
                                <div class="color-swatch-chip" style="background-color: #9e1015;">Primary Dark</div>
                                <div class="mt-2">
                                    <small class="fw-bold d-block text-dark">Primary Dark</small>
                                    <small class="text-muted">#9e1015</small>
                                </div>
                            </div>
                            <div class="col-6 col-sm-3">
                                <div class="color-swatch-chip text-danger border" style="background-color: #fdf1f1;">Primary Light</div>
                                <div class="mt-2">
                                    <small class="fw-bold d-block text-dark">Primary Light</small>
                                    <small class="text-muted">#fdf1f1</small>
                                </div>
                            </div>
                            <div class="col-6 col-sm-3">
                                <div class="color-swatch-chip" style="background-color: #ea580c;">Secondary</div>
                                <div class="mt-2">
                                    <small class="fw-bold d-block text-dark">Secondary</small>
                                    <small class="text-muted">#ea580c</small>
                                </div>
                            </div>

                            <div class="col-6 col-sm-3">
                                <div class="color-swatch-chip" style="background-color: #16a34a;">Success</div>
                                <div class="mt-2">
                                    <small class="fw-bold d-block text-dark">Success Green</small>
                                    <small class="text-muted">#16a34a</small>
                                </div>
                            </div>
                            <div class="col-6 col-sm-3">
                                <div class="color-swatch-chip" style="background-color: #ca8a04;">Warning</div>
                                <div class="mt-2">
                                    <small class="fw-bold d-block text-dark">Warning Yellow</small>
                                    <small class="text-muted">#ca8a04</small>
                                </div>
                            </div>
                            <div class="col-6 col-sm-3">
                                <div class="color-swatch-chip" style="background-color: #0284c7;">Info</div>
                                <div class="mt-2">
                                    <small class="fw-bold d-block text-dark">Info Blue</small>
                                    <small class="text-muted">#0284c7</small>
                                </div>
                            </div>
                            <div class="col-6 col-sm-3">
                                <div class="color-swatch-chip" style="background-color: #9333ea;">Purple</div>
                                <div class="mt-2">
                                    <small class="fw-bold d-block text-dark">Purple</small>
                                    <small class="text-muted">#9333ea</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Typography -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white border-0 pt-4 px-4">
                        <h5 class="fw-bold text-dark mb-0"><i class="ti ti-typography me-2 text-danger"></i>Typography (Plus Jakarta Sans)</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3 border-bottom pb-3">
                            <h1 class="fw-extrabold text-dark mb-1">Heading 1</h1>
                            <small class="text-muted">32px / 2rem • Font Weight 800 (-0.03em letter spacing)</small>
                        </div>
                        <div class="mb-3 border-bottom pb-3">
                            <h2 class="fw-bold text-dark mb-1">Heading 2</h2>
                            <small class="text-muted">24px / 1.5rem • Font Weight 700</small>
                        </div>
                        <div>
                            <p class="text-secondary mb-1">
                                <strong>Body Text Paragraph:</strong> Teks paragraf antarmuka dengan kontras tinggi yang jernih, dirancang khusus untuk kenyamanan membaca pengguna di seluruh modul admin.
                            </p>
                            <small class="text-muted">14px / 0.875rem • Color #334155</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= 2. BUTTONS ================= --}}
    <div id="buttons" class="mb-5 pt-3">
        <div class="d-flex align-items-center gap-2 mb-3">
            <span class="badge bg-danger-subtle text-danger fs-6 px-3 py-2 rounded-pill fw-bold">2</span>
            <h3 class="fw-bold text-dark mb-0">Buttons</h3>
        </div>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <!-- Variants -->
                <div class="mb-4 pb-3 border-bottom">
                    <label class="form-label fw-bold text-muted small uppercase mb-2">Button Variants</label>
                    <div class="d-flex flex-wrap gap-2">
                        <button class="btn btn-primary">Primary Brand</button>
                        <button class="btn btn-secondary">Secondary</button>
                        <button class="btn btn-outline-primary">Outline Primary</button>
                        <button class="btn btn-success">Success</button>
                        <button class="btn btn-warning text-dark">Warning</button>
                        <button class="btn btn-danger">Danger</button>
                        <button class="btn btn-light border">Ghost / Light</button>
                    </div>
                </div>

                <!-- States -->
                <div class="mb-4 pb-3 border-bottom">
                    <label class="form-label fw-bold text-muted small uppercase mb-2">Button States</label>
                    <div class="d-flex flex-wrap gap-2">
                        <button class="btn btn-primary">Normal State</button>
                        <button class="btn btn-primary" disabled>Disabled State</button>
                    </div>
                </div>

                <!-- Sizes -->
                <div class="mb-4 pb-3 border-bottom">
                    <label class="form-label fw-bold text-muted small uppercase mb-2">Button Sizes</label>
                    <div class="d-flex flex-wrap align-items-center gap-2">
                        <button class="btn btn-primary btn-sm">Small</button>
                        <button class="btn btn-primary">Default</button>
                        <button class="btn btn-primary btn-lg">Large</button>
                    </div>
                </div>

                <!-- Icon Buttons -->
                <div>
                    <label class="form-label fw-bold text-muted small uppercase mb-2">Icon Buttons</label>
                    <div class="d-flex flex-wrap gap-2">
                        <button class="btn btn-primary">
                            <x-admin-icon name="package" />
                            Tambah Data
                        </button>
                        <button class="btn btn-outline-danger btn-icon" aria-label="Hapus">
                            <x-admin-icon name="help-circle" />
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= 3. FORMS ================= --}}
    <div id="forms" class="mb-5 pt-3">
        <div class="d-flex align-items-center gap-2 mb-3">
            <span class="badge bg-danger-subtle text-danger fs-6 px-3 py-2 rounded-pill fw-bold">3</span>
            <h3 class="fw-bold text-dark mb-0">Forms</h3>
        </div>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Nama Sekolah*</label>
                        <input type="text" class="form-control" placeholder="Masukkan nama sekolah...">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Email Kepala Sekolah*</label>
                        <input type="email" class="form-control" placeholder="kepala@sekolah.com">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Kurikulum</label>
                        <select class="form-select">
                            <option>Pilih kurikulum...</option>
                            <option selected>Kurikulum Merdeka</option>
                            <option>Kurikulum 2013</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Tanggal Berdiri</label>
                        <input type="date" class="form-control">
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-bold">Alamat Sekolah</label>
                        <textarea class="form-control" rows="3" placeholder="Masukkan alamat lengkap sekolah..."></textarea>
                    </div>

                    <!-- Validation States -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold">NPSN (Error State)</label>
                        <input type="text" class="form-control is-invalid" value="abc">
                        <div class="invalid-feedback">NPSN harus 8 digit angka.</div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Password (Success State)</label>
                        <input type="password" class="form-control is-valid" value="password123">
                        <div class="valid-feedback">Password memenuhi syarat keamanan.</div>
                    </div>

                    <!-- Checkboxes & Radios -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Fasilitas Sekolah</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="fac1" checked>
                            <label class="form-check-label" for="fac1">Perpustakaan Digital</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="fac2" checked>
                            <label class="form-check-label" for="fac2">Laboratorium Komputer</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Status Akreditasi</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="akreditasi" id="akredA" checked>
                            <label class="form-check-label" for="akredA">Akreditasi A (Sangat Baik)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="akreditasi" id="akredB">
                            <label class="form-check-label" for="akredB">Akreditasi B</label>
                        </div>
                    </div>

                    <!-- Switch -->
                    <div class="col-md-6">
                        <label class="form-check form-switch mt-4">
                            <input class="form-check-input" type="checkbox" checked>
                            <span class="form-check-label">Status Aktif</span>
                        </label>
                    </div>

                    <!-- File Upload -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Upload File</label>
                        <input type="file" class="form-control">
                    </div>

                    <div class="col-12 pt-2">
                        <div class="d-flex gap-2">
                            <button class="btn btn-primary rounded-pill px-4">Simpan Form</button>
                            <button class="btn btn-light border rounded-pill px-4">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= 4. FEEDBACK ================= --}}
    <div id="feedback" class="mb-5 pt-3">
        <div class="d-flex align-items-center gap-2 mb-3">
            <span class="badge bg-danger-subtle text-danger fs-6 px-3 py-2 rounded-pill fw-bold">4</span>
            <h3 class="fw-bold text-dark mb-0">Feedback</h3>
        </div>

        {{-- ================= BADGE / STATUS ================= --}}
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">Badge / Status</h3>
            </div>
            <div class="card-body">
                <div class="d-flex flex-wrap gap-2">
                    <span class="badge bg-green-lt text-green">Aktif</span>
                    <span class="badge bg-red-lt text-red">Nonaktif</span>
                    <span class="badge bg-yellow-lt text-yellow">Pending</span>
                    <span class="badge bg-blue-lt text-blue">Berhasil</span>
                    <span class="badge bg-secondary-lt text-secondary">Draft</span>
                </div>
            </div>
        </div>

        {{-- ================= STATUS PILL (versi pembayaran) ================= --}}
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">Status Pill — Pembayaran</h3>
            </div>
            <div class="card-body">
                <div class="d-flex flex-wrap gap-2">
                    <span class="status-pill status-pill-success">BERHASIL</span>
                    <span class="status-pill status-pill-danger">GAGAL</span>
                    <span class="status-pill status-pill-warning">PENDING</span>
                </div>
            </div>
        </div>

        {{-- ================= ALERT ================= --}}
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">Alert</h3>
            </div>
            <div class="card-body">
                <div class="alert alert-success mb-2">
                    <i class="ti ti-check me-2"></i>
                    Data berhasil disimpan.
                </div>
                <div class="alert alert-danger mb-2">
                    <i class="ti ti-alert-circle me-2"></i>
                    Gagal menyimpan data, silakan coba lagi.
                </div>
                <div class="alert alert-warning mb-2">
                    <i class="ti ti-alert-triangle me-2"></i>
                    Data ini akan dihapus permanen.
                </div>
                <div class="alert alert-info mb-0">
                    <i class="ti ti-info-circle me-2"></i>
                    Informasi tambahan untuk pengguna.
                </div>
            </div>
        </div>

        {{-- ================= MODAL ================= --}}
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Modal Konfirmasi</h3>
            </div>
            <div class="card-body">
                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-contoh-hapus">
                    Hapus Data
                </button>
            </div>
        </div>

        <div class="modal modal-blur fade" id="modal-contoh-hapus" tabindex="-1">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-status bg-danger"></div>
                    <div class="modal-body text-center py-4">
                        <x-admin-icon name="help-circle" />
                        <h3>Yakin ingin menghapus?</h3>
                        <div class="text-secondary">Data yang dihapus tidak dapat dikembalikan.</div>
                    </div>
                    <div class="modal-footer">
                        <div class="w-100">
                            <div class="row">
                                <div class="col">
                                    <button type="button" class="btn w-100" data-bs-dismiss="modal">Batal</button>
                                </div>
                                <div class="col">
                                    <button type="button" class="btn btn-danger w-100">Ya, Hapus</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= 5. DATA DISPLAY ================= --}}
    <div id="data-display" class="mb-5 pt-3">
        <div class="d-flex align-items-center gap-2 mb-3">
            <span class="badge bg-danger-subtle text-danger fs-6 px-3 py-2 rounded-pill fw-bold">5</span>
            <h3 class="fw-bold text-dark mb-0">Data Display</h3>
        </div>

        {{-- ================= CARD STATISTIK ================= --}}
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">Card Statistik</h3>
            </div>
            <div class="card-body">
                <div class="row row-cards">
                    <div class="col-sm-6 col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <span class="avatar avatar-md bg-blue-lt me-3">
                                        <x-admin-icon name="users" />
                                    </span>
                                    <div>
                                        <div class="subheader">Contoh Label</div>
                                        <div class="h1 mb-0">0</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ================= TABLE ================= --}}
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h3 class="card-title">Table</h3>
                <button class="btn btn-primary btn-sm">
                    <x-admin-icon name="package" />
                    Tambah Data
                </button>
            </div>
            <div class="table-responsive">
                <table class="table table-vcenter card-table" id="simple-datatable-demo">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Sekolah</th>
                            <th>Status</th>
                            <th class="w-1">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Al Finabun</td>
                            <td>SMK 1 Busan</td>
                            <td><span class="badge bg-green-lt text-green">Aktif</span></td>
                            <td>
                                <div class="d-flex gap-1">
                                    <button class="btn btn-sm btn-outline-primary">Edit</button>
                                    <button class="btn btn-sm btn-outline-danger">Hapus</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Contoh Guru Lain</td>
                            <td>SD Negeri 2</td>
                            <td><span class="badge bg-red-lt text-red">Nonaktif</span></td>
                            <td>
                                <div class="d-flex gap-1">
                                    <button class="btn btn-sm btn-outline-primary">Edit</button>
                                    <button class="btn btn-sm btn-outline-danger">Hapus</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Empty state contoh --}}
            <div class="card-body text-center text-secondary py-5" style="display:none;" id="empty-state-example">
                <x-admin-icon name="database" />
                <div class="mt-2">Belum ada data</div>
            </div>
        </div>

        {{-- ================= TABLE DENGAN AVATAR & DROPDOWN AKSI ================= --}}
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">Table dengan Avatar & Dropdown Aksi</h3>
            </div>
            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead>
                        <tr>
                            <th><input type="checkbox" class="form-check-input"></th>
                            <th>Nama</th>
                            <th>Sekolah</th>
                            <th>Status</th>
                            <th class="w-1">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="checkbox" class="form-check-input"></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="avatar avatar-sm me-2" style="background-image: url('{{ asset('assets/admin/img/user.jpg') }}')"></span>
                                    Al Finabun
                                </div>
                            </td>
                            <td>SMK 1 Busan</td>
                            <td><span class="badge bg-green-lt text-green">Aktif</span></td>
                            <td>
                                <div class="dropdown">
                                    <a href="#" class="btn btn-icon btn-sm" data-bs-toggle="dropdown" aria-label="Aksi">
                                        <i class="ti ti-dots-vertical"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">
                                            <i class="ti ti-edit me-2"></i> Edit
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            <i class="ti ti-eye me-2"></i> Lihat Detail
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item text-danger" href="#">
                                            <i class="ti ti-trash me-2"></i> Hapus
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="card-footer d-flex align-items-center justify-content-between">
                <p class="m-0 text-secondary">Menampilkan <strong>1-10</strong> dari <strong>200</strong> data</p>
                <ul class="pagination m-0 ms-auto">
                    <li class="page-item disabled">
                        <a class="page-link" href="#"><i class="ti ti-chevron-left"></i></a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">...</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#"><i class="ti ti-chevron-right"></i></a>
                    </li>
                </ul>
            </div>
        </div>

        {{-- ================= TABLE STANDAR (SERVER-SIDE PAGINATION) ================= --}}
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-header bg-white border-0 pt-4 px-4 d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                <div>
                    <h5 class="fw-bold text-dark mb-0"><i class="ti ti-table me-2 text-danger"></i>Daftar Admin Sekolah (Standard Table)</h5>
                    <small class="text-muted">Tabel standar Laravel dengan pagination server-side</small>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <input type="text" class="form-control form-control-sm rounded-pill px-3" placeholder="Cari nama atau sekolah..." style="width: 200px;">
                    <button class="btn btn-sm btn-light border rounded-pill"><i class="ti ti-filter"></i> Filter</button>
                    <button class="btn btn-primary btn-sm rounded-pill px-3">
                        <i class="ti ti-plus me-1"></i> Tambah Data
                    </button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-vcenter card-table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="w-1">NO</th>
                            <th>NAMA</th>
                            <th>EMAIL</th>
                            <th>SEKOLAH</th>
                            <th>ROLE</th>
                            <th>STATUS</th>
                            <th class="w-1 text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="fw-bold">1</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="avatar avatar-sm rounded-circle" style="background-image: url('{{ asset('assets/admin/img/user.jpg') }}')"></span>
                                    <span class="fw-bold text-dark">Budi Utomo</span>
                                </div>
                            </td>
                            <td>budi.utomo@sd.sch.id</td>
                            <td>SDN 01 Jakarta</td>
                            <td>Kepala Sekolah</td>
                            <td><span class="badge bg-green-lt text-green px-3 py-1 rounded-pill">Aktif</span></td>
                            <td class="text-center">
                                <div class="d-flex gap-1 justify-content-center">
                                    <button class="btn btn-sm btn-light border btn-icon rounded-circle" title="Edit"><x-admin-icon name="edit" /></button>
                                    <button class="btn btn-sm btn-outline-danger btn-icon rounded-circle" title="Hapus"><x-admin-icon name="trash" /></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold">2</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="avatar avatar-sm bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold">
                                        SR
                                    </span>
                                    <span class="fw-bold text-dark">Siti Rahmah</span>
                                </div>
                            </td>
                            <td>siti.rahmah@sd.sch.id</td>
                            <td>SDN 05 Bandung</td>
                            <td>Guru Kelas</td>
                            <td><span class="badge bg-green-lt text-green px-3 py-1 rounded-pill">Aktif</span></td>
                            <td class="text-center">
                                <div class="d-flex gap-1 justify-content-center">
                                    <button class="btn btn-sm btn-light border btn-icon rounded-circle" title="Edit"><x-admin-icon name="edit" /></button>
                                    <button class="btn btn-sm btn-outline-danger btn-icon rounded-circle" title="Hapus"><x-admin-icon name="trash" /></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold">3</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="avatar avatar-sm bg-warning-subtle text-warning rounded-circle d-flex align-items-center justify-content-center fw-bold">
                                        AR
                                    </span>
                                    <span class="fw-bold text-dark">Ahmad Rizal</span>
                                </div>
                            </td>
                            <td>ahmad.rizal@sd.sch.id</td>
                            <td>SD Al-Azhar</td>
                            <td>Guru PAI</td>
                            <td><span class="badge bg-yellow-lt text-yellow px-3 py-1 rounded-pill">Pending</span></td>
                            <td class="text-center">
                                <div class="d-flex gap-1 justify-content-center">
                                    <button class="btn btn-sm btn-light border btn-icon rounded-circle" title="Edit"><x-admin-icon name="edit" /></button>
                                    <button class="btn btn-sm btn-outline-danger btn-icon rounded-circle" title="Hapus"><x-admin-icon name="trash" /></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="card-footer bg-white border-0 d-flex align-items-center justify-content-between p-4">
                <p class="m-0 text-secondary small">Menampilkan <strong>1-3</strong> dari <strong>12</strong> data</p>
                <ul class="pagination m-0 ms-auto">
                    <li class="page-item disabled">
                        <a class="page-link" href="#"><i class="ti ti-chevron-left"></i></a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#"><i class="ti ti-chevron-right"></i></a>
                    </li>
                </ul>
            </div>
        </div>

        {{-- ================= CARD CTA BERWARNA ================= --}}
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Card CTA (Ajakan Aksi)</h3>
            </div>
            <div class="card-body">
                <div class="cta-card-danger">
                    <h3 class="mb-2">Butuh Bantuan?</h3>
                    <p class="mb-3">Tim kami siap membantu kendala pembayaran atau akses materi Anda 24/7.</p>
                    <div class="d-flex flex-column gap-2">
                        <a href="#" class="btn btn-light w-100 text-start">
                            <i class="ti ti-headset me-2"></i> Hubungi Customer Service
                        </a>
                        <a href="#" class="btn btn-light w-100 text-start">
                            <i class="ti ti-file-text me-2"></i> Baca Panduan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= 6. NAVIGATION ================= --}}
    <div id="navigation" class="mb-5 pt-3">
        <div class="d-flex align-items-center gap-2 mb-3">
            <span class="badge bg-danger-subtle text-danger fs-6 px-3 py-2 rounded-pill fw-bold">6</span>
            <h3 class="fw-bold text-dark mb-0">Navigation</h3>
        </div>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <div class="mb-4 pb-3 border-bottom">
                    <label class="form-label fw-bold text-muted small uppercase mb-2">Breadcrumb Navigation</label>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Master Data</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Sekolah</li>
                        </ol>
                    </nav>
                </div>

                <div>
                    <label class="form-label fw-bold text-muted small uppercase mb-2">Tab Navigation</label>
                    <ul class="nav nav-tabs border-bottom mb-3">
                        <li class="nav-item">
                            <a class="nav-link active fw-bold text-danger border-bottom-0" href="#">Informasi Umum</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-secondary" href="#">Fasilitas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-secondary" href="#">Dokumen</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- Assets Simple-DataTables (Vanilla JS DataTables) --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css">
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const table = document.querySelector("#simple-datatable-demo");
            if (table) {
                new simpleDatatables.DataTable(table, {
                    searchable: true,
                    perPage: 5,
                    labels: {
                        placeholder: "Cari data guru, sekolah...",
                        perPage: "{select} data per halaman",
                        noRows: "Tidak ada data ditemukan",
                        info: "Menampilkan {start} - {end} dari {rows} data",
                    }
                });
            }
        });
    </script>

@endsection