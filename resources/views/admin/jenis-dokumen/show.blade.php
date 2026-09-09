@extends('admin.layouts.admin')

@section('title', 'Detail Jenis Dokumen: ' . $jenisDokumen->nama)
@section('page-title', 'Detail Jenis Dokumen')
@section('page-description', 'Informasi lengkap data jenis dokumen pembelajaran.')

@section('page-breadcrumbs')
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
@endsection

@section('page-actions')
    <a href="{{ route('admin.jenis-dokumen.edit', $jenisDokumen) }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
        <i class="ti ti-pencil me-1"></i>
        Edit Jenis Dokumen
    </a>
    <a href="{{ route('admin.jenis-dokumen.index') }}" class="btn btn-light border rounded-pill px-4">
        <i class="ti ti-arrow-left me-1"></i>
        Kembali
    </a>
@endsection

@section('content')

    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow-sm border-0">

                <div class="card-header py-3 bg-white d-flex align-items-center justify-content-between border-bottom">
                    <h3 class="card-title fw-bold text-dark mb-0">
                        Informasi Jenis Dokumen
                    </h3>

                    <div>
                        @if($jenisDokumen->status === 'aktif')
                            <span class="badge bg-success-lt text-success fs-6 px-3 py-1">
                                <i class="ti ti-check me-1"></i> Aktif
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
                            <h2 class="fw-bold text-dark mb-0">
                                {{ $jenisDokumen->nama }}
                            </h2>
                        </div>

                        {{-- Kategori Dokumen --}}
                        <div class="col-md-6">
                            <div class="text-secondary small fw-bold text-uppercase mb-1" style="letter-spacing: 0.05em;">
                                Kategori Dokumen
                            </div>
                            <div>
                                <span class="badge bg-blue-lt text-blue fs-5 px-3 py-1">
                                    {{ $jenisDokumen->kategoriDokumen->nama ?? '-' }}
                                </span>
                            </div>
                        </div>

                        {{-- Urutan --}}
                        <div class="col-md-6">
                            <div class="text-secondary small fw-bold text-uppercase mb-1" style="letter-spacing: 0.05em;">
                                Urutan Tampilan
                            </div>
                            <div>
                                <span class="badge bg-light text-dark border fs-5 px-3 py-1">
                                    {{ $jenisDokumen->urutan }}
                                </span>
                            </div>
                        </div>

                        {{-- Berkas Terhubung --}}
                        <div class="col-md-6">
                            <div class="text-secondary small fw-bold text-uppercase mb-1" style="letter-spacing: 0.05em;">
                                Repository Terkait
                            </div>
                            <div>
                                <span class="badge bg-primary-lt text-primary fs-5 px-3 py-1">
                                    {{ $jenisDokumen->repositories->count() }} Berkas
                                </span>
                            </div>
                        </div>

                        {{-- Deskripsi --}}
                        <div class="col-12">
                            <div class="text-secondary small fw-bold text-uppercase mb-1" style="letter-spacing: 0.05em;">
                                Deskripsi
                            </div>
                            <div class="p-3 bg-light rounded-3 border text-dark">
                                {{ $jenisDokumen->deskripsi ?: 'Tidak ada deskripsi yang ditambahkan.' }}
                            </div>
                        </div>

                        {{-- Tanggal Dibuat & Diperbarui --}}
                        <div class="col-md-6">
                            <div class="text-secondary small fw-bold text-uppercase mb-1" style="letter-spacing: 0.05em;">
                                Tanggal Dibuat
                            </div>
                            <div class="fw-medium text-dark">
                                {{ $jenisDokumen->created_at ? $jenisDokumen->created_at->translatedFormat('d F Y, H:i') : '-' }} WIB
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="text-secondary small fw-bold text-uppercase mb-1" style="letter-spacing: 0.05em;">
                                Terakhir Diperbarui
                            </div>
                            <div class="fw-medium text-dark">
                                {{ $jenisDokumen->updated_at ? $jenisDokumen->updated_at->translatedFormat('d F Y, H:i') : '-' }} WIB
                            </div>
                        </div>

                    </div>

                </div>

                <div class="card-footer bg-light py-3 d-flex align-items-center justify-content-between">
                    <form action="{{ route('admin.jenis-dokumen.destroy', $jenisDokumen) }}"
                        method="POST"
                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus jenis dokumen {{ addslashes($jenisDokumen->nama) }}? Data yang dihapus tidak dapat dikembalikan.')">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-outline-danger rounded-pill px-3">
                            <i class="ti ti-trash me-1"></i> Hapus Data
                        </button>
                    </form>

                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.jenis-dokumen.edit', $jenisDokumen) }}" class="btn btn-primary rounded-pill px-4">
                            <i class="ti ti-pencil me-1"></i> Edit Data
                        </a>
                        <a href="{{ route('admin.jenis-dokumen.index') }}" class="btn btn-light border rounded-pill px-4">
                            Kembali
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection
