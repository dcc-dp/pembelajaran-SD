@extends('admin.layouts.admin')

@section('title', 'Edit Jenis Dokumen')
@section('page-title', 'Edit Jenis Dokumen')

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
                    <a href="{{ route('admin.jenis-dokumen.index') }}" class="text-secondary text-decoration-none">Jenis Dokumen</a>
                </li>
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">
                    Edit
                </li>
            </ol>
        </nav>
    </div>

    {{-- Notifikasi Error Global --}}
    @if(isset($errors) && $errors->any())
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
                            <x-admin-icon name="edit" />
                        </div>
                        <h3 class="card-title fw-bold text-dark mb-0">
                            Edit Data Jenis Dokumen
                        </h3>
                    </div>
                </div>

                <form action="{{ route('admin.jenis-dokumen.update', $jenisDokumen) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card-body p-4">
                        <div class="row g-3">

                            {{-- Kategori Dokumen --}}
                            <div class="col-md-6">
                                <label class="form-label required fw-bold">
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
                                <label class="form-label required fw-bold">
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
                                <label class="form-label required fw-bold">
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
                                <small class="form-hint">Menentukan urutan tampilan pada tabel dan menu.</small>
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
                                    <option value="aktif" {{ old('status', $jenisDokumen->status) === 'aktif' ? 'selected' : '' }}>
                                        Aktif
                                    </option>
                                    <option value="tidak_aktif" {{ old('status', $jenisDokumen->status) === 'tidak_aktif' ? 'selected' : '' }}>
                                        Tidak Aktif
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small class="form-hint">Status aktif memungkinkan jenis dokumen dipilih saat upload berkas.</small>
                            </div>

                            {{-- Deskripsi --}}
                            <div class="col-md-12">
                                <label class="form-label fw-bold">
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

                        </div>
                    </div>

                    <div class="card-footer bg-white py-3 border-top d-flex justify-content-between align-items-center">
                        <a href="{{ route('admin.jenis-dokumen.index') }}" class="btn btn-light border rounded-pill px-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left me-1" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M5 12l14 0" />
                                <path d="M5 12l6 6" />
                                <path d="M5 12l6 -6" />
                            </svg>
                            Batal
                        </a>
                        <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check me-1" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M5 12l5 5l10 -10" />
                            </svg>
                            Perbarui Data
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>

@endsection