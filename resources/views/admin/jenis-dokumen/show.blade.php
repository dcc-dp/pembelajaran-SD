@extends('admin.layouts.admin')

@section('title', 'Detail Jenis Dokumen: ' . $jenisDokumen->nama)
@section('page-title', 'Detail Jenis Dokumen')

@section('page-actions')
    <a href="{{ route('admin.jenis-dokumen.edit', $jenisDokumen) }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
        <x-admin-icon name="edit" />
        <span class="ms-1">Edit Jenis Dokumen</span>
    </a>
    <a href="{{ route('admin.jenis-dokumen.index') }}" class="btn btn-light border rounded-pill px-4 ms-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left me-1" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <path d="M5 12l14 0" />
            <path d="M5 12l6 6" />
            <path d="M5 12l6 -6" />
        </svg>
        Kembali
    </a>
@endsection

@section('content')

    {{-- Breadcrumb --}}
    <div class="mb-4 pb-3 border-bottom">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}" class="text-secondary text-decoration-none">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="text-secondary">Master Data</span>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.jenis-dokumen.index') }}" class="text-secondary text-decoration-none">Jenis Dokumen</a>
                </li>
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">
                    Detail
                </li>
            </ol>
        </nav>
    </div>

    <div class="row g-4 justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow-sm border-0 rounded-3">

                <div class="card-header py-3 bg-white d-flex align-items-center justify-content-between border-bottom">
                    <div class="d-flex align-items-center gap-2">
                        <div class="avatar avatar-xs bg-primary-subtle text-primary rounded-circle">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-circle" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                                <path d="M12 9h.01" />
                                <path d="M11 12h1v4h1" />
                            </svg>
                        </div>
                        <h3 class="card-title fw-bold text-dark mb-0">
                            Informasi Jenis Dokumen
                        </h3>
                    </div>

                    <div>
                        @if($jenisDokumen->status === 'aktif')
                            <span class="badge bg-green-lt text-green fs-6 px-3 py-1">
                                Aktif
                            </span>
                        @else
                            <span class="badge bg-secondary-lt text-secondary fs-6 px-3 py-1">
                                Tidak Aktif
                            </span>
                        @endif
                    </div>
                </div>

                <div class="card-body p-4">
                    <div class="row g-4">

                        {{-- Nama Jenis Dokumen --}}
                        <div class="col-md-6">
                            <div class="text-secondary small fw-bold text-uppercase mb-1" style="letter-spacing: 0.05em;">
                                Nama Jenis Dokumen
                            </div>
                            <h3 class="fw-bold text-dark mb-0">
                                {{ $jenisDokumen->nama }}
                            </h3>
                        </div>

                        {{-- Kategori Dokumen --}}
                        <div class="col-md-6">
                            <div class="text-secondary small fw-bold text-uppercase mb-1" style="letter-spacing: 0.05em;">
                                Kategori Dokumen
                            </div>
                            <h3 class="fw-bold text-dark mb-0">
                                <span class="badge bg-blue-lt text-blue fs-6 px-3">
                                    {{ $jenisDokumen->kategoriDokumen->nama ?? '-' }}
                                </span>
                            </h3>
                        </div>

                        {{-- Urutan --}}
                        <div class="col-md-6">
                            <div class="text-secondary small fw-bold text-uppercase mb-1" style="letter-spacing: 0.05em;">
                                Urutan Tampilan
                            </div>
                            <h3 class="fw-bold text-dark mb-0">
                                <span class="badge bg-light text-dark border fs-6 px-3">
                                    {{ $jenisDokumen->urutan }}
                                </span>
                            </h3>
                        </div>

                        {{-- Jumlah Repository Terkait --}}
                        <div class="col-md-6">
                            <div class="text-secondary small fw-bold text-uppercase mb-1" style="letter-spacing: 0.05em;">
                                Berkas Terhubung
                            </div>
                            <h3 class="fw-bold text-dark mb-0">
                                <span class="badge bg-purple-lt text-purple fs-6 px-3">
                                    {{ $jenisDokumen->repositories->count() }} Berkas Dokumen
                                </span>
                            </h3>
                        </div>

                        {{-- Deskripsi --}}
                        <div class="col-12">
                            <div class="text-secondary small fw-bold text-uppercase mb-1" style="letter-spacing: 0.05em;">
                                Deskripsi
                            </div>
                            <div class="p-3 bg-light rounded-2 text-dark">
                                {{ $jenisDokumen->deskripsi ?: 'Tidak ada deskripsi yang ditambahkan.' }}
                            </div>
                        </div>

                        {{-- Waktu Dibuat & Diperbarui --}}
                        <div class="col-md-6">
                            <div class="text-secondary small fw-bold text-uppercase mb-1" style="letter-spacing: 0.05em;">
                                Tanggal Dibuat
                            </div>
                            <p class="text-dark mb-0">
                                {{ $jenisDokumen->created_at ? $jenisDokumen->created_at->translatedFormat('d F Y, H:i') : '-' }}
                            </p>
                        </div>

                        <div class="col-md-6">
                            <div class="text-secondary small fw-bold text-uppercase mb-1" style="letter-spacing: 0.05em;">
                                Terakhir Diperbarui
                            </div>
                            <p class="text-dark mb-0">
                                {{ $jenisDokumen->updated_at ? $jenisDokumen->updated_at->translatedFormat('d F Y, H:i') : '-' }}
                            </p>
                        </div>

                    </div>
                </div>

                <div class="card-footer bg-white py-3 border-top d-flex justify-content-between align-items-center">
                    <a href="{{ route('admin.jenis-dokumen.index') }}" class="btn btn-light border rounded-pill px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left me-1" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M5 12l14 0" />
                            <path d="M5 12l6 6" />
                            <path d="M5 12l6 -6" />
                        </svg>
                        Kembali
                    </a>
                    <a href="{{ route('admin.jenis-dokumen.edit', $jenisDokumen) }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
                        <x-admin-icon name="edit" />
                        <span class="ms-1">Edit Jenis Dokumen</span>
                    </a>
                </div>

            </div>

        </div>
    </div>

@endsection
