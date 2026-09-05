@extends('admin.layouts.admin')

@section('title', 'Tambah Kelas')
@section('page-title', 'Tambah Kelas')

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
                    <a href="{{ route('admin.kelas.index') }}" class="text-secondary text-decoration-none">Kelas</a>
                </li>
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">
                    Tambah
                </li>
            </ol>
        </nav>
    </div>

    {{-- Notifikasi Error Global --}}
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
            <div class="d-flex">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alert-circle text-danger me-2 flex-shrink-0" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                    <path d="M12 8l0 4" />
                    <path d="M12 16l.01 0" />
                </svg>
                <div>
                    <strong>Terjadi kesalahan pada input data:</strong>
                    <ul class="mb-0 mt-1 ps-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow-sm border-0 rounded-3">

                <div class="card-header py-3 bg-white border-bottom">
                    <div class="d-flex align-items-center gap-2">
                        <div class="avatar avatar-xs bg-primary-subtle text-primary rounded-circle">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                        </div>
                        <h3 class="card-title fw-bold text-dark mb-0">
                            Formulir Tambah Kelas
                        </h3>
                    </div>
                </div>

                <div class="card-body p-4">

                    <form action="{{ route('admin.kelas.store') }}" method="POST">
                        @csrf

                        <div class="row g-3">

                            {{-- Nama Kelas --}}
                            <div class="col-md-12">
                                <label class="form-label required fw-bold">
                                    Nama Kelas
                                </label>
                                <input
                                    type="text"
                                    name="nama"
                                    value="{{ old('nama') }}"
                                    maxlength="30"
                                    class="form-control @error('nama') is-invalid @enderror"
                                    placeholder="Contoh: Kelas 1"
                                    required
                                >
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small class="form-hint">Maksimal 30 karakter. Nama kelas harus unik.</small>
                            </div>

                            {{-- Urutan --}}
                            <div class="col-md-6">
                                <label class="form-label required fw-bold">
                                    Urutan
                                </label>
                                <input
                                    type="number"
                                    name="urutan"
                                    value="{{ old('urutan') }}"
                                    min="1"
                                    class="form-control @error('urutan') is-invalid @enderror"
                                    placeholder="Contoh: 1"
                                    required
                                >
                                @error('urutan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small class="form-hint">Digunakan untuk menentukan urutan tingkatan kelas (misal: 1 s/d 6).</small>
                            </div>

                            {{-- Status --}}
                            <div class="col-md-6">
                                <label class="form-label required fw-bold">
                                    Status
                                </label>
                                <select
                                    name="status"
                                    class="form-select @error('status') is-invalid @enderror"
                                    required
                                >
                                    <option value="" disabled selected>-- Pilih Status --</option>
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

                            {{-- Tombol Aksi --}}
                            <div class="col-12 pt-3 border-top mt-4">
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check me-1" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M5 12l5 5l10 -10" />
                                        </svg>
                                        Simpan
                                    </button>

                                    <a href="{{ route('admin.kelas.index') }}" class="btn btn-light border rounded-pill px-4">
                                        Batal
                                    </a>
                                </div>
                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>

@endsection
