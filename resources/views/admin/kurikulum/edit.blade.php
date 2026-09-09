@extends('admin.layouts.admin')

@section('title', 'Edit Kurikulum: ' . $kurikulum->nama)
@section('page-title', 'Edit Kurikulum')
@section('page-description', 'Perbarui data kurikulum.')

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
                <a href="{{ route('admin.kurikulum.index') }}" class="text-secondary text-decoration-none">Kurikulum</a>
            </li>
            <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">
                Edit
            </li>
        </ol>
    </nav>
@endsection

@section('content')

    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-7">

            <form action="{{ route('admin.kurikulum.update', $kurikulum) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card shadow-sm border-0">
                    <div class="card-header py-3 bg-white border-bottom">
                        <div class="d-flex align-items-center gap-2">
                            <div class="avatar avatar-xs bg-danger-subtle text-danger rounded-circle">
                                <i class="ti ti-pencil"></i>
                            </div>
                            <h3 class="card-title fw-bold text-dark mb-0">Edit Kurikulum</h3>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <div class="row g-3">
                            {{-- Nama Kurikulum --}}
                            <div class="col-12">
                                <label class="form-label required">
                                    Nama Kurikulum
                                </label>
                                <input
                                    type="text"
                                    name="nama"
                                    value="{{ old('nama', $kurikulum->nama) }}"
                                    maxlength="100"
                                    class="form-control @error('nama') is-invalid @enderror"
                                    placeholder="Masukkan nama kurikulum"
                                    required
                                >
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small class="form-hint">Maksimal 100 karakter.</small>
                            </div>

                            {{-- Deskripsi --}}
                            <div class="col-12">
                                <label class="form-label">
                                    Deskripsi
                                </label>
                                <textarea
                                    name="deskripsi"
                                    rows="4"
                                    class="form-control @error('deskripsi') is-invalid @enderror"
                                    placeholder="Masukkan deskripsi kurikulum"
                                >{{ old('deskripsi', $kurikulum->deskripsi) }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small class="form-hint">Penjelasan singkat atau cakupan kurikulum (opsional).</small>
                            </div>

                            {{-- Status --}}
                            <div class="col-12">
                                <label class="form-label required">
                                    Status
                                </label>
                                <select
                                    name="status"
                                    class="form-select @error('status') is-invalid @enderror"
                                    required
                                >
                                    <option value="aktif" @selected(old('status', $kurikulum->status) === 'aktif')>
                                        Aktif
                                    </option>
                                    <option value="tidak_aktif" @selected(old('status', $kurikulum->status) === 'tidak_aktif')>
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
                                        Simpan Kurikulum
                                    </button>

                                    <a href="{{ route('admin.kurikulum.index') }}"
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
