@extends('admin.layouts.admin')

@section('title', 'Detail FAQ')
@section('page-title', 'Detail FAQ')
@section('page-description', 'Informasi lengkap pertanyaan dan jawaban FAQ.')

@section('page-breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}" class="text-secondary text-decoration-none">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <span class="text-secondary">Pusat Bantuan</span>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.faq.index') }}" class="text-secondary text-decoration-none">FAQ</a>
            </li>
            <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">
                Detail
            </li>
        </ol>
    </nav>
@endsection

@section('page-actions')
    <a href="{{ route('admin.faq.edit', $faq) }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
        <i class="ti ti-pencil me-1"></i>
        Edit FAQ
    </a>
    <a href="{{ route('admin.faq.index') }}" class="btn btn-light border rounded-pill px-4">
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
                        Informasi FAQ
                    </h3>

                    <div>
                        @if($faq->status === 'aktif')
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

                        {{-- Pertanyaan --}}
                        <div class="col-12">
                            <div class="text-secondary small fw-bold text-uppercase mb-1" style="letter-spacing: 0.05em;">
                                Pertanyaan
                            </div>
                            <h2 class="fw-bold text-dark mb-0" style="font-size: 1.25rem; line-height: 1.4;">
                                {{ $faq->pertanyaan }}
                            </h2>
                        </div>

                        {{-- Jawaban --}}
                        <div class="col-12">
                            <div class="text-secondary small fw-bold text-uppercase mb-1" style="letter-spacing: 0.05em;">
                                Jawaban
                            </div>
                            <div class="p-3 bg-light rounded-3 border text-dark" style="white-space: pre-line; line-height: 1.6;">
                                {{ $faq->jawaban }}
                            </div>
                        </div>

                        {{-- Urutan --}}
                        <div class="col-md-4">
                            <div class="text-secondary small fw-bold text-uppercase mb-1" style="letter-spacing: 0.05em;">
                                Urutan Posisi
                            </div>
                            <div>
                                <span class="badge bg-light text-dark border fs-5 px-3 py-1">
                                    {{ $faq->urutan }}
                                </span>
                            </div>
                        </div>

                        {{-- Tanggal Dibuat --}}
                        <div class="col-md-4">
                            <div class="text-secondary small fw-bold text-uppercase mb-1" style="letter-spacing: 0.05em;">
                                Tanggal Dibuat
                            </div>
                            <div class="fw-medium text-dark">
                                {{ $faq->created_at ? $faq->created_at->translatedFormat('d F Y, H:i') : '-' }} WIB
                            </div>
                        </div>

                        {{-- Tanggal Terakhir Diperbarui --}}
                        <div class="col-md-4">
                            <div class="text-secondary small fw-bold text-uppercase mb-1" style="letter-spacing: 0.05em;">
                                Terakhir Diperbarui
                            </div>
                            <div class="fw-medium text-dark">
                                {{ $faq->updated_at ? $faq->updated_at->translatedFormat('d F Y, H:i') : '-' }} WIB
                            </div>
                        </div>

                    </div>

                </div>

                <div class="card-footer bg-light py-3 d-flex align-items-center justify-content-between">
                    <form action="{{ route('admin.faq.destroy', $faq) }}"
                        method="POST"
                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus FAQ ini? Data yang dihapus tidak dapat dikembalikan.')">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-outline-danger rounded-pill px-3">
                            <i class="ti ti-trash me-1"></i> Hapus FAQ
                        </button>
                    </form>

                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.faq.edit', $faq) }}" class="btn btn-primary rounded-pill px-4">
                            <i class="ti ti-pencil me-1"></i> Edit FAQ
                        </a>
                        <a href="{{ route('admin.faq.index') }}" class="btn btn-light border rounded-pill px-4">
                            Kembali
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection
