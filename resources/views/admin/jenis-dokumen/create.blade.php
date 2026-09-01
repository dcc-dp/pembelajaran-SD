@extends('admin.layouts.admin')

@section('title', 'Tambah Jenis Dokumen')
@section('page-title', 'Tambah Jenis Dokumen')

@section('content')

    <div class="container-xl">

        {{-- Breadcrumb --}}
        <div class="mb-4 pb-3 border-bottom">

            <nav aria-label="breadcrumb">

                <ol class="breadcrumb mb-0">

                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}"
                            class="text-decoration-none">
                            Dashboard
                        </a>
                    </li>

                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.jenis-dokumen.index') }}"
                            class="text-decoration-none">
                            Master Data
                        </a>
                    </li>

                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.jenis-dokumen.index') }}"
                            class="text-decoration-none">
                            Jenis Dokumen
                        </a>
                    </li>

                    <li class="breadcrumb-item active" aria-current="page">
                        Tambah
                    </li>

                </ol>

            </nav>

        </div>


        {{-- Notifikasi Error --}}
        @if($errors->any())

            <div class="alert alert-danger alert-dismissible" role="alert">

                <strong>Terjadi kesalahan!</strong>

                <ul class="mb-0 mt-2">

                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

                <a
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="close">
                </a>

            </div>

        @endif


        {{-- Form --}}
        <div id="forms" class="mb-5 pt-3">

            <div class="d-flex align-items-center gap-2 mb-3">

                <h3 class="fw-bold text-dark mb-0">
                    Tambah Jenis Dokumen
                </h3>

            </div>


            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body p-4">

                    <form
                        action="{{ route('admin.jenis-dokumen.store') }}"
                        method="POST"
                    >

                        @csrf


                        <div class="row g-3">


                            {{-- Kategori Dokumen --}}
                            <div class="col-md-6">

                                <label class="form-label fw-bold">
                                    Kategori Dokumen*
                                </label>

                                <select
                                    name="kategori_dokumen_id"
                                    class="form-select @error('kategori_dokumen_id') is-invalid @enderror"
                                    required
                                >

                                    <option value="" disabled selected>
                                        Pilih kategori dokumen...
                                    </option>

                                    @foreach($kategoriDokumens as $kategoriDokumen)

                                        <option
                                            value="{{ $kategoriDokumen->id }}"
                                            {{ old('kategori_dokumen_id') == $kategoriDokumen->id ? 'selected' : '' }}
                                        >

                                            {{ $kategoriDokumen->nama }}

                                        </option>

                                    @endforeach

                                </select>

                                @error('kategori_dokumen_id')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- Nama Jenis Dokumen --}}
                            <div class="col-md-6">

                                <label class="form-label fw-bold">
                                    Nama Jenis Dokumen*
                                </label>

                                <input
                                    type="text"
                                    name="nama"
                                    class="form-control @error('nama') is-invalid @enderror"
                                    value="{{ old('nama') }}"
                                    placeholder="Masukkan nama jenis dokumen..."
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

                                <label class="form-label fw-bold">
                                    Urutan*
                                </label>

                                <input
                                    type="number"
                                    name="urutan"
                                    class="form-control @error('urutan') is-invalid @enderror"
                                    value="{{ old('urutan') }}"
                                    placeholder="Contoh: 1"
                                    min="1"
                                    required
                                >

                                @error('urutan')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- Status --}}
                            <div class="col-md-6">

                                <label class="form-label fw-bold">
                                    Status*
                                </label>

                                <select
                                    name="status"
                                    class="form-select @error('status') is-invalid @enderror"
                                    required
                                >

                                    <option value="" disabled selected>
                                        Pilih status...
                                    </option>

                                    <option
                                        value="aktif"
                                        {{ old('status') == 'aktif' ? 'selected' : '' }}
                                    >
                                        Aktif
                                    </option>

                                    <option
                                        value="tidak_aktif"
                                        {{ old('status') == 'tidak_aktif' ? 'selected' : '' }}
                                    >
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

                                <label class="form-label fw-bold">
                                    Deskripsi
                                </label>

                                <textarea
                                    name="deskripsi"
                                    rows="4"
                                    class="form-control @error('deskripsi') is-invalid @enderror"
                                    placeholder="Masukkan deskripsi jenis dokumen..."
                                >{{ old('deskripsi') }}</textarea>

                                @error('deskripsi')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- Tombol --}}
                            <div class="col-12 pt-2">

                                <div class="d-flex gap-2">

                                    <button
                                        type="submit"
                                        class="btn btn-primary rounded-pill px-4"
                                    >

                                        <x-admin-icon name="check" />

                                        Simpan

                                    </button>


                                    <a
                                        href="{{ route('admin.jenis-dokumen.index') }}"
                                        class="btn btn-light border rounded-pill px-4"
                                    >

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