@extends('admin.layouts.admin')

@section('title', 'Tambah Semester')
@section('page-title', 'Tambah Semester')
@section('page-description', 'Tambahkan data semester baru untuk pembagian materi pembelajaran.')

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
                <a href="{{ route('admin.semester.index') }}" class="text-secondary text-decoration-none">Semester</a>
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

            <form action="{{ route('admin.semester.store') }}" method="POST">
                @csrf

                <div class="card shadow-sm border-0">
                    <div class="card-header py-3 bg-white border-bottom">
                        <div class="d-flex align-items-center gap-2">
                            <div class="avatar avatar-xs bg-danger-subtle text-danger rounded-circle">
                                <i class="ti ti-plus"></i>
                            </div>
                            <h3 class="card-title fw-bold text-dark mb-0">Formulir Semester</h3>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <div class="row g-3">
                            {{-- Nama Semester --}}
                            <div class="col-12">
                                <label class="form-label required">
                                    Nama Semester
                                </label>
                                <input
                                    type="text"
                                    name="nama"
                                    value="{{ old('nama') }}"
                                    maxlength="30"
                                    class="form-control @error('nama') is-invalid @enderror"
                                    placeholder="Contoh: Semester 1"
                                    required
                                >
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small class="form-hint">Maksimal 30 karakter. Nama semester harus unik.</small>
                            </div>

                            {{-- Urutan --}}
                            <div class="col-md-6">
                                <label class="form-label required">
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
                                <small class="form-hint">Menentukan urutan tampilan (misal: 1, 2).</small>
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
                        </div>
                    </div>

                    {{-- Footer Actions --}}
                    <div class="card-footer bg-light py-3">
                        <div class="d-flex align-items-center gap-2">
                            <button type="submit" class="btn btn-primary rounded-pill px-4">
                                <i class="ti ti-device-floppy me-1"></i>
                                Simpan Semester
                            </button>

                            <a href="{{ route('admin.semester.index') }}" class="btn btn-light border rounded-pill px-4">
                                Batal
                            </a>
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>

@endsection
