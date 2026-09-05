@extends('admin.layouts.admin')

@section('title', 'Detail Semester: ' . $semester->nama)
@section('page-title', 'Detail Semester')

@section('page-actions')
    <a href="{{ route('admin.semester.edit', $semester) }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
        <x-admin-icon name="edit" />
        <span class="ms-1">Edit Semester</span>
    </a>
    <a href="{{ route('admin.semester.index') }}" class="btn btn-light border rounded-pill px-4 ms-2">
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
                    <a href="{{ route('admin.semester.index') }}" class="text-secondary text-decoration-none">Semester</a>
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
                            Informasi Semester
                        </h3>
                    </div>

                    <div>
                        @if($semester->status === 'aktif')
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

                        {{-- Nama Semester --}}
                        <div class="col-md-6">
                            <div class="text-secondary small fw-bold text-uppercase mb-1" style="letter-spacing: 0.05em;">
                                Nama Semester
                            </div>
                            <h3 class="fw-bold text-dark mb-0">
                                {{ $semester->nama }}
                            </h3>
                        </div>

                        {{-- Urutan --}}
                        <div class="col-md-6">
                            <div class="text-secondary small fw-bold text-uppercase mb-1" style="letter-spacing: 0.05em;">
                                Urutan Tampilan
                            </div>
                            <h3 class="fw-bold text-dark mb-0">
                                <span class="badge bg-light text-dark border fs-6 px-3">
                                    {{ $semester->urutan }}
                                </span>
                            </h3>
                        </div>

                        {{-- Tanggal Dibuat --}}
                        <div class="col-md-6">
                            <div class="text-secondary small fw-bold text-uppercase mb-1" style="letter-spacing: 0.05em;">
                                Tanggal Dibuat
                            </div>
                            <div class="fw-medium text-dark">
                                {{ $semester->created_at ? $semester->created_at->translatedFormat('d F Y, H:i') : '-' }} WIB
                            </div>
                        </div>

                        {{-- Tanggal Terakhir Diperbarui --}}
                        <div class="col-md-6">
                            <div class="text-secondary small fw-bold text-uppercase mb-1" style="letter-spacing: 0.05em;">
                                Terakhir Diperbarui
                            </div>
                            <div class="fw-medium text-dark">
                                {{ $semester->updated_at ? $semester->updated_at->translatedFormat('d F Y, H:i') : '-' }} WIB
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
                                                {{ $semester->paketLangganans()->count() }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="p-3 bg-light rounded-3 border">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span class="text-secondary small">Repository Terkait</span>
                                            <span class="badge bg-primary text-white rounded-pill px-3">
                                                {{ $semester->repositories()->count() }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="card-footer bg-light py-3 d-flex align-items-center justify-content-between">
                    <form action="{{ route('admin.semester.destroy', $semester) }}"
                        method="POST"
                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus semester {{ addslashes($semester->nama) }}? Data yang dihapus tidak dapat dikembalikan.')">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3">
                            <x-admin-icon name="trash" />
                            <span class="ms-1">Hapus Data</span>
                        </button>
                    </form>

                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.semester.edit', $semester) }}" class="btn btn-primary btn-sm rounded-pill px-3">
                            <x-admin-icon name="edit" />
                            <span class="ms-1">Edit</span>
                        </a>
                        <a href="{{ route('admin.semester.index') }}" class="btn btn-light border btn-sm rounded-pill px-3">
                            Kembali
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection
