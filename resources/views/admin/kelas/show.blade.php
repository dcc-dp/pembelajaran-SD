@extends('admin.layouts.admin')

@section('title', 'Detail Kelas: ' . $kelas->nama)
@section('page-title', 'Detail Kelas')
@section('page-description', 'Informasi lengkap data tingkatan kelas SD.')

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
                <a href="{{ route('admin.kelas.index') }}" class="text-secondary text-decoration-none">Kelas</a>
            </li>
            <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">
                Detail
            </li>
        </ol>
    </nav>
@endsection

@section('page-actions')
    <a href="{{ route('admin.kelas.edit', $kelas) }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
        <i class="ti ti-pencil me-1"></i>
        Edit Kelas
    </a>
    <a href="{{ route('admin.kelas.index') }}" class="btn btn-light border rounded-pill px-4">
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
                        Informasi Kelas
                    </h3>

                    <div>
                        @if($kelas->status === 'aktif')
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

                        {{-- Nama Kelas --}}
                        <div class="col-md-6">
                            <div class="text-secondary small fw-bold text-uppercase mb-1" style="letter-spacing: 0.05em;">
                                Nama Kelas
                            </div>
                            <h2 class="fw-bold text-dark mb-0">
                                {{ $kelas->nama }}
                            </h2>
                        </div>

                        {{-- Urutan --}}
                        <div class="col-md-6">
                            <div class="text-secondary small fw-bold text-uppercase mb-1" style="letter-spacing: 0.05em;">
                                Urutan Tingkatan
                            </div>
                            <div class="fw-bold text-dark fs-3">
                                <span class="badge bg-light text-dark border px-3">
                                    {{ $kelas->urutan }}
                                </span>
                            </div>
                        </div>

                        {{-- Tanggal Dibuat --}}
                        <div class="col-md-6">
                            <div class="text-secondary small fw-bold text-uppercase mb-1" style="letter-spacing: 0.05em;">
                                Tanggal Dibuat
                            </div>
                            <div class="fw-medium text-dark">
                                {{ $kelas->created_at ? $kelas->created_at->translatedFormat('d F Y, H:i') : '-' }} WIB
                            </div>
                        </div>

                        {{-- Tanggal Terakhir Diperbarui --}}
                        <div class="col-md-6">
                            <div class="text-secondary small fw-bold text-uppercase mb-1" style="letter-spacing: 0.05em;">
                                Terakhir Diperbarui
                            </div>
                            <div class="fw-medium text-dark">
                                {{ $kelas->updated_at ? $kelas->updated_at->translatedFormat('d F Y, H:i') : '-' }} WIB
                            </div>
                        </div>

                        {{-- Penggunaan pada Fitur Lain --}}
                        <div class="col-12 pt-3 border-top">
                            <div class="text-secondary small fw-bold text-uppercase mb-2" style="letter-spacing: 0.05em;">
                                Keterkaitan Data
                            </div>
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <div class="p-3 bg-light rounded-3 border">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span class="text-secondary small">Paket Langganan Terkait</span>
                                            <span class="badge bg-primary text-white rounded-pill px-3">
                                                {{ $kelas->paketLangganans()->count() }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="p-3 bg-light rounded-3 border">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span class="text-secondary small">Repository Terkait</span>
                                            <span class="badge bg-primary text-white rounded-pill px-3">
                                                {{ $kelas->repositories()->count() }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="card-footer bg-light py-3 d-flex align-items-center justify-content-between">
                    <form action="{{ route('admin.kelas.destroy', $kelas) }}"
                        method="POST"
                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus kelas {{ addslashes($kelas->nama) }}? Data yang dihapus tidak dapat dikembalikan.')">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-outline-danger rounded-pill px-3">
                            <i class="ti ti-trash me-1"></i> Hapus Data
                        </button>
                    </form>

                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.kelas.edit', $kelas) }}" class="btn btn-primary rounded-pill px-4">
                            <i class="ti ti-pencil me-1"></i> Edit Data
                        </a>
                        <a href="{{ route('admin.kelas.index') }}" class="btn btn-light border rounded-pill px-4">
                            Kembali
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection
