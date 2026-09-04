@extends('admin.layouts.admin')

@section('title', 'Edit Paket Langganan')
@section('page-title', 'Edit Paket Langganan')
@section('page-description', 'Perbarui informasi dan tarif paket langganan.')

@section('page-breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}" class="text-secondary text-decoration-none">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.paket-langganan.index') }}" class="text-secondary text-decoration-none">Paket Langganan</a>
            </li>
            <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">
                Edit: {{ $paketLangganan->nama }}
            </li>
        </ol>
    </nav>
@endsection

@section('content')

    <div class="row justify-content-center">
        <div class="col-lg-9 col-xl-8">

            <form action="{{ route('admin.paket-langganan.update', $paketLangganan) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card shadow-sm border-0">
                    <div class="card-header py-3 bg-white border-bottom">
                        <div class="d-flex align-items-center gap-2">
                            <div class="avatar avatar-xs bg-danger-subtle text-danger rounded-circle">
                                <i class="ti ti-edit"></i>
                            </div>
                            <h3 class="card-title fw-bold text-dark mb-0">Formulir Paket Langganan</h3>
                        </div>
                    </div>

                    <div class="card-body p-4">

                        {{-- Nama Paket --}}
                        <div class="mb-4">
                            <label class="form-label required">
                                Nama Paket
                            </label>
                            <input
                                type="text"
                                name="nama"
                                value="{{ old('nama', $paketLangganan->nama) }}"
                                class="form-control @error('nama') is-invalid @enderror"
                                placeholder="Contoh: Paket Lengkap Kelas 4 SD Semester 1 & 2"
                                required
                            >
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <small class="form-hint">Gunakan nama yang jelas dan mendeskripsikan target kelas/semester.</small>
                        </div>

                        {{-- Kelas & Semester --}}
                        <div class="row g-3 mb-4">
                            {{-- Kelas --}}
                            <div class="col-md-6">
                                <label class="form-label required">
                                    Kelas
                                </label>
                                <select
                                    name="kelas_id"
                                    class="form-select @error('kelas_id') is-invalid @enderror"
                                    required
                                >
                                    <option value="" disabled>-- Pilih Tingkat Kelas --</option>
                                    @foreach($kelas as $item)
                                        <option
                                            value="{{ $item->id }}"
                                            @selected(old('kelas_id', $paketLangganan->kelas_id) == $item->id)
                                        >
                                            {{ $item->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kelas_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Semester --}}
                            <div class="col-md-6">
                                <label class="form-label">
                                    Semester <span class="text-secondary fw-normal">(Opsional)</span>
                                </label>
                                <select
                                    name="semester_id"
                                    class="form-select @error('semester_id') is-invalid @enderror"
                                >
                                    <option value="">Semua Semester (1 Tahun Ajaran)</option>
                                    @foreach($semesters as $item)
                                        <option
                                            value="{{ $item->id }}"
                                            @selected(old('semester_id', $paketLangganan->semester_id) == $item->id)
                                        >
                                            {{ $item->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('semester_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        {{-- Deskripsi --}}
                        <div class="mb-4">
                            <label class="form-label">
                                Deskripsi Paket <span class="text-secondary fw-normal">(Opsional)</span>
                            </label>
                            <textarea
                                name="deskripsi"
                                rows="4"
                                class="form-control @error('deskripsi') is-invalid @enderror"
                                placeholder="Jelaskan cakupan materi, modul, LKPD atau fasilitas yang didapatkan guru..."
                            >{{ old('deskripsi', $paketLangganan->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Harga & Durasi --}}
                        <div class="row g-3 mb-4">
                            {{-- Harga --}}
                            <div class="col-md-6">
                                <label class="form-label required">
                                    Harga Paket
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text fw-bold">Rp</span>
                                    <input
                                        type="number"
                                        name="harga"
                                        value="{{ old('harga', $paketLangganan->harga) }}"
                                        min="0"
                                        step="1000"
                                        class="form-control @error('harga') is-invalid @enderror"
                                        placeholder="150000"
                                        required
                                    >
                                </div>
                                @error('harga')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small class="form-hint">Format angka nominal (misal: 150000).</small>
                            </div>

                            {{-- Durasi --}}
                            <div class="col-md-6">
                                <label class="form-label required">
                                    Durasi Akses
                                </label>
                                <div class="input-group">
                                    <input
                                        type="number"
                                        name="durasi_bulan"
                                        value="{{ old('durasi_bulan', $paketLangganan->durasi_bulan) }}"
                                        min="1"
                                        class="form-control @error('durasi_bulan') is-invalid @enderror"
                                        placeholder="12"
                                        required
                                    >
                                    <span class="input-group-text fw-medium">Bulan</span>
                                </div>
                                @error('durasi_bulan')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small class="form-hint">Masa aktif langganan dalam satuan bulan.</small>
                            </div>
                        </div>

                        {{-- Status --}}
                        <div class="mb-2">
                            <label class="form-label required">
                                Status Paket
                            </label>
                            <select
                                name="status"
                                class="form-select @error('status') is-invalid @enderror"
                                required
                            >
                                <option
                                    value="aktif"
                                    @selected(old('status', $paketLangganan->status) === 'aktif')
                                >
                                    Aktif (Tersedia untuk dibeli)
                                </option>
                                <option
                                    value="tidak_aktif"
                                    @selected(old('status', $paketLangganan->status) === 'tidak_aktif')
                                >
                                    Tidak Aktif (Disembunyikan)
                                </option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    </div>

                    {{-- Footer Actions --}}
                    <div class="card-footer bg-light py-3">
                        <div class="d-flex align-items-center gap-2">
                            <button type="submit" class="btn btn-primary rounded-pill px-4">
                                <i class="ti ti-device-floppy me-1"></i>
                                Simpan Perubahan
                            </button>

                            <a href="{{ route('admin.paket-langganan.index') }}" class="btn btn-light border rounded-pill px-4">
                                Batal
                            </a>
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>

@endsection