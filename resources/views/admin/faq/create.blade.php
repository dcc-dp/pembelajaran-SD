@extends('admin.layouts.admin')

@section('title', 'Tambah FAQ')
@section('page-title', 'Tambah FAQ')
@section('page-description', 'Tambahkan pertanyaan dan jawaban baru untuk pusat bantuan pengguna.')

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
                Tambah Baru
            </li>
        </ol>
    </nav>
@endsection

@section('content')

    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-7">

            <form action="{{ route('admin.faq.store') }}" method="POST">
                @csrf

                <div class="card shadow-sm border-0">
                    <div class="card-header py-3 bg-white border-bottom">
                        <div class="d-flex align-items-center gap-2">
                            <div class="avatar avatar-xs bg-danger-subtle text-danger rounded-circle">
                                <i class="ti ti-plus"></i>
                            </div>
                            <h3 class="card-title fw-bold text-dark mb-0">
                                Formulir Tambah FAQ
                            </h3>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <div class="row g-3">

                            {{-- Pertanyaan --}}
                            <div class="col-12">
                                <label class="form-label required">
                                    Pertanyaan
                                </label>
                                <input
                                    type="text"
                                    name="pertanyaan"
                                    value="{{ old('pertanyaan') }}"
                                    maxlength="255"
                                    class="form-control @error('pertanyaan') is-invalid @enderror"
                                    placeholder="Masukkan pertanyaan"
                                    required
                                >
                                @error('pertanyaan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small class="form-hint">Maksimal 255 karakter.</small>
                            </div>

                            {{-- Jawaban --}}
                            <div class="col-12">
                                <label class="form-label required">
                                    Jawaban
                                </label>
                                <textarea
                                    name="jawaban"
                                    rows="5"
                                    class="form-control @error('jawaban') is-invalid @enderror"
                                    placeholder="Masukkan jawaban"
                                    required
                                >{{ old('jawaban') }}</textarea>
                                @error('jawaban')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small class="form-hint">Tuliskan jawaban yang informatif dan mudah dipahami.</small>
                            </div>

                            {{-- Urutan --}}
                            <div class="col-md-6">
                                <label class="form-label required">
                                    Urutan
                                </label>
                                <input
                                    type="number"
                                    name="urutan"
                                    value="{{ old('urutan', 0) }}"
                                    min="0"
                                    class="form-control @error('urutan') is-invalid @enderror"
                                    placeholder="Contoh: 0"
                                    required
                                >
                                @error('urutan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small class="form-hint">Tentukan posisi FAQ saat ditampilkan. Angka lebih kecil akan ditampilkan lebih dahulu.</small>
                            </div>

                            {{-- Status --}}
                            <div class="col-md-6">
                                <label class="form-label required">
                                    Status
                                </label>
                                <select
                                    name="status"
                                    class="form-select @error('status') is-invalid @enderror"
                                    required
                                >
                                    <option value="aktif" @selected(old('status', 'aktif') === 'aktif')>
                                        Aktif
                                    </option>
                                    <option value="tidak_aktif" @selected(old('status') === 'tidak_aktif')>
                                        Tidak Aktif
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Button Form --}}
                            <div class="col-12 pt-2">
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                                        <i class="ti ti-device-floppy me-1"></i>
                                        Simpan FAQ
                                    </button>

                                    <a href="{{ route('admin.faq.index') }}"
                                       class="btn btn-light border rounded-pill px-4">
                                        Batal
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>

@endsection
