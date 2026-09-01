@extends('admin.layouts.admin')

@section('title', 'Edit Kategori Dokumen')
@section('page-title', 'Edit Kategori Dokumen')

@section('content')

<div class="container-xl">

    {{-- Header --}}
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
                    <a href="#"
                        class="text-decoration-none">
                        Master Data
                    </a>
                </li>

                <li class="breadcrumb-item">
                    <a href="{{ route('admin.kategori-dokumen.index') }}"
                        class="text-decoration-none">
                        Kategori Dokumen
                    </a>
                </li>

                <li class="breadcrumb-item active" aria-current="page">
                    Edit
                </li>

            </ol>

        </nav>

    </div>


    {{-- Card Form --}}
    <div class="card">

        {{-- Card Header --}}
        <div class="card-header">

            <div>

                <h3 class="card-title mb-1">
                    Edit Kategori Dokumen
                </h3>

                <div class="text-muted">
                    Perbarui informasi kategori dokumen
                </div>

            </div>

        </div>


        {{-- Form --}}
        <form
            action="{{ route('admin.kategori-dokumen.update', $kategoriDokumen->id) }}"
            method="POST"
        >

            @csrf
            @method('PUT')


            <div class="card-body">

                <div class="row g-3">

                    {{-- Nama Kategori --}}
                    <div class="col-md-6">

                        <label class="form-label fw-bold">
                            Nama Kategori*
                        </label>

                        <input
                            type="text"
                            name="nama"
                            class="form-control @error('nama') is-invalid @enderror"
                            value="{{ old('nama', $kategoriDokumen->nama) }}"
                            placeholder="Masukkan nama kategori dokumen"
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
                            min="1"
                            class="form-control @error('urutan') is-invalid @enderror"
                            value="{{ old('urutan', $kategoriDokumen->urutan) }}"
                            placeholder="Masukkan urutan kategori"
                            required
                        >

                        @error('urutan')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- Deskripsi --}}
                    <div class="col-md-12">

                        <label class="form-label fw-bold">
                            Deskripsi
                        </label>

                        <textarea
                            name="deskripsi"
                            rows="4"
                            class="form-control @error('deskripsi') is-invalid @enderror"
                            placeholder="Masukkan deskripsi kategori dokumen"
                        >{{ old('deskripsi', $kategoriDokumen->deskripsi) }}</textarea>

                        @error('deskripsi')

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

                            <option value="" disabled>
                                Pilih status...
                            </option>

                            <option
                                value="aktif"
                                {{ old('status', $kategoriDokumen->status) === 'aktif' ? 'selected' : '' }}
                            >
                                Aktif
                            </option>

                            <option
                                value="tidak_aktif"
                                {{ old('status', $kategoriDokumen->status) === 'tidak_aktif' ? 'selected' : '' }}
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

                </div>

            </div>


            {{-- Card Footer --}}
            <div class="card-footer d-flex justify-content-end gap-2">

                <a
                    href="{{ route('admin.kategori-dokumen.index') }}"
                    class="btn btn-secondary"
                >
                    <i class="fas fa-arrow-left me-1"></i>
                    Batal
                </a>


                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    <i class="fas fa-save me-1"></i>
                    Update
                </button>

            </div>

        </form>

    </div>

</div>

@endsection