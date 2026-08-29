@extends('admin.layouts.admin')

@section('title', 'Tambah Paket Langganan')

@section('page-pretitle', 'Manajemen')

@section('page-title', 'Tambah Paket Langganan')

@section('content')

<div class="row">
    <div class="col-12">

        <form action="{{ route('admin.paket-langganan.store') }}" method="POST">
            @csrf

            {{-- Card Form --}}
            <div class="card border-0 shadow-sm">

                <div class="card-body p-4 p-md-5">

                    {{-- Nama Paket --}}
                    <div class="mb-4">

                        <label class="form-label fw-semibold">
                            Nama Paket
                            <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="nama"
                            value="{{ old('nama') }}"
                            class="form-control form-control-lg @error('nama') is-invalid @enderror"
                            placeholder="Contoh: Paket Kelas 4 Semester 1 & 2"
                            required
                        >

                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Kelas & Semester --}}
                    <div class="row">

                        {{-- Kelas --}}
                        <div class="col-md-6 mb-4">

                            <label class="form-label fw-semibold">
                                Kelas
                                <span class="text-danger">*</span>
                            </label>

                            <select
                                name="kelas_id"
                                class="form-select form-select-lg @error('kelas_id') is-invalid @enderror"
                                required
                            >
                                <option value="">
                                    Pilih Kelas
                                </option>

                                @foreach($kelas as $item)
                                    <option
                                        value="{{ $item->id }}"
                                        @selected(old('kelas_id') == $item->id)
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
                        <div class="col-md-6 mb-4">

                            <label class="form-label fw-semibold">
                                Semester
                                <span class="text-secondary fw-normal">
                                    (Opsional)
                                </span>
                            </label>

                            <select
                                name="semester_id"
                                class="form-select form-select-lg @error('semester_id') is-invalid @enderror"
                            >
                                <option value="">
                                    Semua Semester
                                </option>

                                @foreach($semesters as $item)
                                    <option
                                        value="{{ $item->id }}"
                                        @selected(old('semester_id') == $item->id)
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

                        <label class="form-label fw-semibold">
                            Deskripsi
                        </label>

                        <textarea
                            name="deskripsi"
                            rows="5"
                            class="form-control form-control-lg @error('deskripsi') is-invalid @enderror"
                            placeholder="Tuliskan deskripsi atau fitur dari paket ini..."
                        >{{ old('deskripsi') }}</textarea>

                        @error('deskripsi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Harga & Durasi --}}
                    <div class="row">

                        {{-- Harga --}}
                        <div class="col-md-6 mb-4">

                            <label class="form-label fw-semibold">
                                Harga
                                <span class="text-danger">*</span>
                            </label>

                            <div class="input-group input-group-lg">

                                <span class="input-group-text">
                                    Rp
                                </span>

                                <input
                                    type="number"
                                    name="harga"
                                    value="{{ old('harga') }}"
                                    min="0"
                                    step="1"
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

                        </div>


                        {{-- Durasi --}}
                        <div class="col-md-6 mb-4">

                            <label class="form-label fw-semibold">
                                Durasi Akses
                                <span class="text-danger">*</span>
                            </label>

                            <div class="input-group input-group-lg">

                                <input
                                    type="number"
                                    name="durasi_bulan"
                                    value="{{ old('durasi_bulan', 12) }}"
                                    min="1"
                                    class="form-control @error('durasi_bulan') is-invalid @enderror"
                                    required
                                >

                                <span class="input-group-text">
                                    Bulan
                                </span>

                            </div>

                            @error('durasi_bulan')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>


                    {{-- Status --}}
                    <div class="row">

                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Status
                                <span class="text-danger">*</span>
                            </label>

                            <select
                                name="status"
                                class="form-select form-select-lg @error('status') is-invalid @enderror"
                                required
                            >

                                <option
                                    value="aktif"
                                    @selected(old('status', 'aktif') === 'aktif')
                                >
                                    Aktif
                                </option>

                                <option
                                    value="tidak_aktif"
                                    @selected(old('status') === 'tidak_aktif')
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


                {{-- Footer --}}
                <div class="card-footer bg-transparent p-4 px-md-5">

                    <div class="col-12 pt-2">
                        <div class="d-flex gap-2">

                            {{-- Simpan --}}
                            <button
                                type="submit"
                                class="btn btn-primary rounded-pill px-4"
                            >
                                <i class="ti ti-device-floppy me-1"></i>
                                Simpan Paket
                            </button>

                            {{-- Batal --}}
                            <a
                                href="{{ route('admin.paket-langganan.index') }}"
                                class="btn btn-light border rounded-pill px-4"
                            >
                                Batal
                            </a>

                        </div>
                    </div>

                </div>

            </div>

        </form>

    </div>
</div>

@endsection