@extends('admin.layouts.admin')

@php
    $item = ($kategoriDokumen && $kategoriDokumen->exists) 
        ? $kategoriDokumen 
        : (\App\Models\KategoriDokumen::find(request()->route('kategori_dokuman')) ?? $kategoriDokumen);
@endphp

@section('title', 'Edit Kategori Dokumen: ' . ($item->nama ?? ''))
@section('page-title', 'Edit Kategori Dokumen')
@section('page-description', 'Perbarui nama, urutan, atau deskripsi kategori dokumen.')

@section('page-breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}" class="text-secondary text-decoration-none">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.kategori-dokumen.index') }}" class="text-secondary text-decoration-none">Kategori Dokumen</a>
            </li>
            <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">
                Edit: {{ $item->nama ?? 'Kategori' }}
            </li>
        </ol>
    </nav>
@endsection

@section('content')

    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-7">

            <form action="{{ route('admin.kategori-dokumen.update', $item->id ?? request()->route('kategori_dokuman')) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card shadow-sm border-0">
                    <div class="card-header py-3 bg-white border-bottom">
                        <div class="d-flex align-items-center gap-2">
                            <div class="avatar avatar-xs bg-danger-subtle text-danger rounded-circle">
                                <i class="ti ti-edit"></i>
                            </div>
                            <h3 class="card-title fw-bold text-dark mb-0">Edit Formulir Kategori Dokumen</h3>
                        </div>
                    </div>

                    <div class="card-body p-4">

                        {{-- Alert Error --}}
                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible mb-4" role="alert">
                                <div class="fw-bold mb-1">Periksa kembali data formulir:</div>
                                <ul class="mb-0 small ps-3">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
                            </div>
                        @endif

                        <div class="row g-3">
                            {{-- Nama Kategori --}}
                            <div class="col-12">
                                <label class="form-label fw-semibold">
                                    Nama Kategori Dokumen <span class="text-danger">*</span>
                                </label>
                                <input
                                    type="text"
                                    name="nama"
                                    class="form-control @error('nama') is-invalid @enderror"
                                    value="{{ old('nama', $item->nama ?? '') }}"
                                    placeholder="Contoh: Modul Ajar, LKPD, Instrumen Asesmen..."
                                    required
                                >
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Urutan --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    Urutan Tampilan <span class="text-danger">*</span>
                                </label>
                                <input
                                    type="number"
                                    name="urutan"
                                    class="form-control @error('urutan') is-invalid @enderror"
                                    value="{{ old('urutan', $item->urutan ?? 1) }}"
                                    min="1"
                                    placeholder="1"
                                    required
                                >
                                @error('urutan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small class="form-hint">Nomor urut posisi kategori pada menu pencarian guru.</small>
                            </div>

                            {{-- Status --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    Status <span class="text-danger">*</span>
                                </label>
                                <select
                                    name="status"
                                    class="form-select @error('status') is-invalid @enderror"
                                    required
                                >
                                    <option
                                        value="aktif"
                                        @selected(old('status', $item->status ?? 'aktif') === 'aktif')
                                    >
                                        Aktif (Dapat Dipilih)
                                    </option>
                                    <option
                                        value="tidak_aktif"
                                        @selected(old('status', $item->status ?? '') === 'tidak_aktif')
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

                            {{-- Deskripsi --}}
                            <div class="col-12">
                                <label class="form-label fw-semibold">
                                    Deskripsi <span class="text-secondary fw-normal">(Opsional)</span>
                                </label>
                                <textarea
                                    name="deskripsi"
                                    rows="4"
                                    class="form-control @error('deskripsi') is-invalid @enderror"
                                    placeholder="Tuliskan keterangan isi dan peruntukan dokumen dalam kategori ini..."
                                >{{ old('deskripsi', $item->deskripsi ?? '') }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="card-footer bg-light py-3 border-top">
                        <div class="d-flex align-items-center gap-2">
                            <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">
                                <i class="ti ti-device-floppy me-1"></i>
                                Simpan Perubahan
                            </button>

                            <a href="{{ route('admin.kategori-dokumen.index') }}" class="btn btn-light border rounded-pill px-4">
                                Batal
                            </a>
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>

@endsection