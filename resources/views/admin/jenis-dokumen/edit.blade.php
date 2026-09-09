@extends('admin.layouts.admin')

@section('title', 'Edit Jenis Dokumen: ' . $jenisDokumen->nama)
@section('page-title', 'Edit Jenis Dokumen')
@section('page-description', 'Perbarui data jenis dokumen.')

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
                Edit
            </li>
        </ol>
    </nav>
@endsection

@section('content')

    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-7">

            <form action="{{ route('admin.jenis-dokumen.update', $jenisDokumen) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card shadow-sm border-0">
                    <div class="card-header py-3 bg-white border-bottom">
                        <div class="d-flex align-items-center gap-2">
                            <div class="avatar avatar-xs bg-danger-subtle text-danger rounded-circle">
                                <i class="ti ti-pencil"></i>
                            </div>
                            <h3 class="card-title fw-bold text-dark mb-0">
                                Formulir Edit Jenis Dokumen
                            </h3>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <div class="row g-3">

                            {{-- Kategori Dokumen --}}
                            <div class="col-md-6">
                                <label class="form-label required">
                                    Kategori Dokumen
                                </label>
                                <select
                                    name="kategori_dokumen_id"
                                    class="form-select @error('kategori_dokumen_id') is-invalid @enderror"
                                    required
                                >
                                    <option value="" disabled>
                                        Pilih kategori dokumen...
                                    </option>
                                    @foreach($kategoriDokumens as $kategori)
                                        <option value="{{ $kategori->id }}" @selected(old('kategori_dokumen_id', $jenisDokumen->kategori_dokumen_id) == $kategori->id)>
                                            {{ $kategori->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kategori_dokumen_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small class="form-hint">Pilih kategori induk dari jenis dokumen ini.</small>
                            </div>

                            {{-- Nama Jenis Dokumen --}}
                            <div class="col-md-6">
                                <label class="form-label required">
                                    Nama Jenis Dokumen
                                </label>
                                <input
                                    type="text"
                                    name="nama"
                                    value="{{ old('nama', $jenisDokumen->nama) }}"
                                    maxlength="100"
                                    class="form-control @error('nama') is-invalid @enderror"
                                    placeholder="Contoh: Modul Ajar, RPP, dsb."
                                    required
                                >
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small class="form-hint">Maksimal 100 karakter.</small>
                            </div>

                            {{-- Urutan --}}
                            <div class="col-md-6">
                                <label class="form-label required">
                                    Urutan
                                </label>
                                <input
                                    type="number"
                                    name="urutan"
                                    value="{{ old('urutan', $jenisDokumen->urutan) }}"
                                    min="1"
                                    max="255"
                                    class="form-control @error('urutan') is-invalid @enderror"
                                    placeholder="Contoh: 1"
                                    required
                                >
                                @error('urutan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small class="form-hint">Menentukan urutan tampilan pada tabel.</small>
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
                                    <option value="aktif" @selected(old('status', $jenisDokumen->status) === 'aktif')>
                                        Aktif
                                    </option>
                                    <option value="tidak_aktif" @selected(old('status', $jenisDokumen->status) === 'tidak_aktif')>
                                        Tidak Aktif
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
                                <label class="form-label">
                                    Deskripsi
                                </label>
                                <textarea
                                    name="deskripsi"
                                    rows="3"
                                    class="form-control @error('deskripsi') is-invalid @enderror"
                                    placeholder="Deskripsi singkat mengenai jenis dokumen ini (opsional)..."
                                >{{ old('deskripsi', $jenisDokumen->deskripsi) }}</textarea>
                                @error('deskripsi')
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
                                        Simpan Perubahan
                                    </button>

                                    <a href="{{ route('admin.jenis-dokumen.index') }}"
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