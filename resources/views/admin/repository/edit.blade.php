@extends('admin.layouts.admin')

@section('title', 'Edit Repository: ' . $repository->judul)
@section('page-title', 'Edit Repository')
@section('page-description', 'Perbarui informasi dan berkas materi pembelajaran.')

@section('page-breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}" class="text-secondary text-decoration-none">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <span class="text-secondary">Layanan</span>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.repository.index') }}" class="text-secondary text-decoration-none">Repository</a>
            </li>
            <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">
                Edit
            </li>
        </ol>
    </nav>
@endsection

@section('content')

    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9">

            <form action="{{ route('admin.repository.update', $repository) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="card shadow-sm border-0">
                    <div class="card-header py-3 bg-white border-bottom">
                        <div class="d-flex align-items-center gap-2">
                            <div class="avatar avatar-xs bg-danger-subtle text-danger rounded-circle">
                                <i class="ti ti-pencil"></i>
                            </div>
                            <h3 class="card-title fw-bold text-dark mb-0">Formulir Edit Repository Dokumen</h3>
                        </div>
                    </div>

                    <div class="card-body p-4">

                        {{-- Section 1: Klasifikasi Pembelajaran --}}
                        <div class="mb-4">
                            <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom">
                                <i class="ti ti-bookmarks text-primary fs-3"></i>
                                <h4 class="fw-bold text-dark mb-0">Klasifikasi Pembelajaran</h4>
                            </div>

                            <div class="row g-3">
                                {{-- Kurikulum --}}
                                <div class="col-md-6">
                                    <label class="form-label required">
                                        Kurikulum
                                    </label>
                                    <select
                                        name="kurikulum_id"
                                        class="form-select @error('kurikulum_id') is-invalid @enderror"
                                        required
                                    >
                                        <option value="" disabled>Pilih Kurikulum</option>
                                        @foreach($kurikulums as $item)
                                            <option value="{{ $item->id }}" @selected(old('kurikulum_id', $repository->kurikulum_id) == $item->id)>
                                                {{ $item->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kurikulum_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- Semester --}}
                                <div class="col-md-6">
                                    <label class="form-label required">
                                        Semester
                                    </label>
                                    <select
                                        name="semester_id"
                                        class="form-select @error('semester_id') is-invalid @enderror"
                                        required
                                    >
                                        <option value="" disabled>Pilih Semester</option>
                                        @foreach($semesters as $item)
                                            <option value="{{ $item->id }}" @selected(old('semester_id', $repository->semester_id) == $item->id)>
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

                                {{-- Kelas --}}
                                <div class="col-md-4">
                                    <label class="form-label required">
                                        Kelas
                                    </label>
                                    <select
                                        name="kelas_id"
                                        class="form-select @error('kelas_id') is-invalid @enderror"
                                        required
                                    >
                                        <option value="" disabled>Pilih Kelas</option>
                                        @foreach($kelas as $item)
                                            <option value="{{ $item->id }}" @selected(old('kelas_id', $repository->kelas_id) == $item->id)>
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

                                {{-- Mata Pelajaran --}}
                                <div class="col-md-4">
                                    <label class="form-label required">
                                        Mata Pelajaran
                                    </label>
                                    <select
                                        name="mata_pelajaran_id"
                                        class="form-select @error('mata_pelajaran_id') is-invalid @enderror"
                                        required
                                    >
                                        <option value="" disabled>Pilih Mata Pelajaran</option>
                                        @foreach($mataPelajarans as $item)
                                            <option value="{{ $item->id }}" @selected(old('mata_pelajaran_id', $repository->mata_pelajaran_id) == $item->id)>
                                                {{ $item->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('mata_pelajaran_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- Jenis Dokumen --}}
                                <div class="col-md-4">
                                    <label class="form-label required">
                                        Jenis Dokumen
                                    </label>
                                    <select
                                        name="jenis_dokumen_id"
                                        class="form-select @error('jenis_dokumen_id') is-invalid @enderror"
                                        required
                                    >
                                        <option value="" disabled>Pilih Jenis Dokumen</option>
                                        @foreach($jenisDokumens as $item)
                                            <option value="{{ $item->id }}" @selected(old('jenis_dokumen_id', $repository->jenis_dokumen_id) == $item->id)>
                                                {{ $item->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('jenis_dokumen_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Section 2: Informasi Dokumen --}}
                        <div class="mb-4">
                            <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom">
                                <i class="ti ti-file-description text-primary fs-3"></i>
                                <h4 class="fw-bold text-dark mb-0">Informasi Dokumen</h4>
                            </div>

                            {{-- Judul --}}
                            <div class="mb-3">
                                <label class="form-label required">
                                    Judul Repository
                                </label>
                                <input
                                    type="text"
                                    name="judul"
                                    value="{{ old('judul', $repository->judul) }}"
                                    class="form-control @error('judul') is-invalid @enderror"
                                    placeholder="Masukkan judul repository"
                                    required
                                >
                                @error('judul')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Deskripsi --}}
                            <div class="mb-3">
                                <label class="form-label">
                                    Deskripsi <span class="text-secondary fw-normal">(Opsional)</span>
                                </label>
                                <textarea
                                    name="deskripsi"
                                    rows="4"
                                    class="form-control @error('deskripsi') is-invalid @enderror"
                                    placeholder="Masukkan deskripsi repository"
                                >{{ old('deskripsi', $repository->deskripsi) }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        {{-- Section 3: Berkas & Pengaturan Akses --}}
                        <div class="mb-2">
                            <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom">
                                <i class="ti ti-upload text-primary fs-3"></i>
                                <h4 class="fw-bold text-dark mb-0">Berkas & Pengaturan Akses</h4>
                            </div>

                            {{-- File Saat Ini --}}
                            @if($repository->nama_file)
                                <div class="p-3 bg-light rounded-3 border mb-3">
                                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="avatar avatar-sm bg-primary-subtle text-primary rounded-circle">
                                                <i class="ti ti-file-check"></i>
                                            </div>
                                            <div>
                                                <div class="text-secondary small fw-medium">File saat ini:</div>
                                                <div class="fw-bold text-dark">{{ $repository->nama_file }}</div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="badge bg-light text-secondary border text-uppercase">
                                                {{ $repository->tipe_file }}
                                            </span>
                                            <a href="{{ route('admin.repository.download', $repository) }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                                <i class="ti ti-download me-1"></i> Unduh File
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="row g-3">
                                {{-- Upload File Baru --}}
                                <div class="col-12">
                                    <label class="form-label">
                                        Upload File Baru <span class="text-secondary fw-normal">(Opsional)</span>
                                    </label>
                                    <input
                                        type="file"
                                        name="file"
                                        class="form-control @error('file') is-invalid @enderror"
                                    >
                                    @error('file')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <small class="form-hint">
                                        Biarkan kosong jika tetap menggunakan file saat ini. Format didukung: <strong>PDF, DOC, DOCX, PPT, PPTX, XLS, XLSX, ZIP, RAR</strong> (Maks. 50 MB).
                                    </small>
                                </div>

                                {{-- Akses --}}
                                <div class="col-md-6">
                                    <label class="form-label required">
                                        Hak Akses
                                    </label>
                                    <select
                                        name="akses"
                                        class="form-select @error('akses') is-invalid @enderror"
                                        required
                                    >
                                        <option value="gratis" @selected(old('akses', $repository->akses) === 'gratis')>
                                            Gratis (Dapat diunduh semua guru)
                                        </option>
                                        <option value="premium" @selected(old('akses', $repository->akses) === 'premium')>
                                            Premium (Hanya untuk guru berlangganan aktif)
                                        </option>
                                    </select>
                                    @error('akses')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- Status --}}
                                <div class="col-md-6">
                                    <label class="form-label required">
                                        Status Publikasi
                                    </label>
                                    <select
                                        name="status"
                                        class="form-select @error('status') is-invalid @enderror"
                                        required
                                    >
                                        <option value="dipublikasikan" @selected(old('status', $repository->status) === 'dipublikasikan')>
                                            Dipublikasikan (Tampil di katalog guru)
                                        </option>
                                        <option value="draft" @selected(old('status', $repository->status) === 'draft')>
                                            Draft (Disimpan sementara, belum tayang)
                                        </option>
                                        <option value="diarsipkan" @selected(old('status', $repository->status) === 'diarsipkan')>
                                            Diarsipkan (Disembunyikan dari katalog)
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

                    </div>

                    {{-- Footer Actions --}}
                    <div class="card-footer bg-light py-3">
                        <div class="d-flex align-items-center gap-2">
                            <button type="submit" class="btn btn-primary rounded-pill px-4">
                                <i class="ti ti-device-floppy me-1"></i>
                                Simpan Perubahan
                            </button>

                            <a href="{{ route('admin.repository.index') }}" class="btn btn-light border rounded-pill px-4">
                                Batal
                            </a>
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>

@endsection
