@extends('admin.layouts.admin')

@section('title', 'Repository')
@section('page-title', 'Repository')
@section('page-description', 'Kelola dokumen dan materi pembelajaran untuk guru.')

@section('page-breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}" class="text-secondary text-decoration-none">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <span class="text-secondary">Layanan</span>
            </li>
            <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">
                Repository
            </li>
        </ol>
    </nav>
@endsection

@section('page-actions')
    <a href="{{ route('admin.repository.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
        <i class="ti ti-plus me-1"></i>
        Tambah Repository
    </a>
@endsection

@section('content')

    {{-- Alert Success --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible shadow-sm border-0 mb-4" role="alert">
            <div class="d-flex align-items-center">
                <i class="ti ti-circle-check fs-2 me-2 text-success"></i>
                <div class="fw-medium">
                    {{ session('success') }}
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
        </div>
    @endif

    {{-- Alert Danger --}}
    @if(session('danger') || session('error'))
        <div class="alert alert-danger alert-dismissible shadow-sm border-0 mb-4" role="alert">
            <div class="d-flex align-items-center">
                <i class="ti ti-alert-circle fs-2 me-2 text-danger"></i>
                <div class="fw-medium">
                    {{ session('danger') ?? session('error') }}
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">

        {{-- Filter Bar --}}
        <div class="card-header py-3 bg-white border-bottom">
            <form method="GET" action="{{ route('admin.repository.index') }}" id="filter-form" class="row g-2 w-100 align-items-center">
                {{-- Search Input --}}
                <div class="col-12 col-md-4">
                    <div class="input-icon">
                        <span class="input-icon-addon">
                            <i class="ti ti-search text-muted"></i>
                        </span>
                        <input
                            type="text"
                            name="search"
                            id="search-input"
                            value="{{ request('search') }}"
                            class="form-control rounded-pill"
                            placeholder="Cari judul repository..."
                        >
                    </div>
                </div>

                {{-- Kurikulum --}}
                <div class="col-6 col-md-2">
                    <select name="kurikulum_id" class="form-select rounded-pill" onchange="this.form.submit()">
                        <option value="">Semua Kurikulum</option>
                        @foreach($kurikulums as $item)
                            <option value="{{ $item->id }}" @selected(request('kurikulum_id') == $item->id)>
                                {{ $item->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Semester --}}
                <div class="col-6 col-md-2">
                    <select name="semester_id" class="form-select rounded-pill" onchange="this.form.submit()">
                        <option value="">Semua Semester</option>
                        @foreach($semesters as $item)
                            <option value="{{ $item->id }}" @selected(request('semester_id') == $item->id)>
                                {{ $item->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Kelas --}}
                <div class="col-6 col-md-2">
                    <select name="kelas_id" class="form-select rounded-pill" onchange="this.form.submit()">
                        <option value="">Semua Kelas</option>
                        @foreach($kelas as $item)
                            <option value="{{ $item->id }}" @selected(request('kelas_id') == $item->id)>
                                {{ $item->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Mata Pelajaran --}}
                <div class="col-6 col-md-2">
                    <select name="mata_pelajaran_id" class="form-select rounded-pill" onchange="this.form.submit()">
                        <option value="">Semua Mapel</option>
                        @foreach($mataPelajarans as $item)
                            <option value="{{ $item->id }}" @selected(request('mata_pelajaran_id') == $item->id)>
                                {{ $item->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Jenis Dokumen --}}
                <div class="col-6 col-md-4">
                    <select name="jenis_dokumen_id" class="form-select rounded-pill" onchange="this.form.submit()">
                        <option value="">Semua Jenis Dokumen</option>
                        @foreach($jenisDokumens as $item)
                            <option value="{{ $item->id }}" @selected(request('jenis_dokumen_id') == $item->id)>
                                {{ $item->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Akses --}}
                <div class="col-6 col-md-3">
                    <select name="akses" class="form-select rounded-pill" onchange="this.form.submit()">
                        <option value="">Semua Akses</option>
                        <option value="gratis" @selected(request('akses') === 'gratis')>Gratis</option>
                        <option value="premium" @selected(request('akses') === 'premium')>Premium</option>
                    </select>
                </div>

                {{-- Status --}}
                <div class="col-6 col-md-3">
                    <select name="status" class="form-select rounded-pill" onchange="this.form.submit()">
                        <option value="">Semua Status</option>
                        <option value="dipublikasikan" @selected(request('status') === 'dipublikasikan')>Dipublikasikan</option>
                        <option value="draft" @selected(request('status') === 'draft')>Draft</option>
                        <option value="diarsipkan" @selected(request('status') === 'diarsipkan')>Diarsipkan</option>
                    </select>
                </div>

                @if(request()->hasAny(['search', 'kurikulum_id', 'semester_id', 'kelas_id', 'mata_pelajaran_id', 'jenis_dokumen_id', 'akses', 'status']))
                    <div class="col-6 col-md-2">
                        <a href="{{ route('admin.repository.index') }}" class="btn btn-light border rounded-pill w-100">
                            <i class="ti ti-rotate me-1"></i> Reset
                        </a>
                    </div>
                @endif
            </form>
        </div>

        {{-- Table --}}
        <div class="table-responsive">
            <table class="table table-vcenter card-table table-hover">
                <thead>
                    <tr>
                        <th style="width: 50px;">NO</th>
                        <th>REPOSITORY</th>
                        <th>KURIKULUM</th>
                        <th>SEMESTER</th>
                        <th>KELAS</th>
                        <th>MAPEL</th>
                        <th>JENIS DOKUMEN</th>
                        <th>AKSES</th>
                        <th>STATUS</th>
                        <th class="text-end" style="width: 170px;">AKSI</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($repositories as $index => $repo)
                        <tr>
                            {{-- No --}}
                            <td class="text-secondary fw-medium">
                                {{ $repositories->firstItem() + $index }}
                            </td>

                            {{-- Judul & Berkas --}}
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar avatar-sm bg-danger-subtle text-danger rounded-circle flex-shrink-0">
                                        <i class="ti ti-books"></i>
                                    </div>
                                    <div>
                                        <a href="{{ route('admin.repository.show', $repo) }}" class="fw-bold text-dark text-decoration-none">
                                            {{ $repo->judul }}
                                        </a>
                                        @if($repo->nama_file)
                                            <div class="text-secondary small mt-1">
                                                <i class="ti ti-paperclip me-1"></i>{{ Str::limit($repo->nama_file, 40) }}
                                                <span class="badge bg-light text-secondary border ms-1 text-uppercase">{{ $repo->tipe_file }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            {{-- Kurikulum --}}
                            <td>
                                <span class="badge bg-light text-dark border">
                                    {{ $repo->kurikulum->nama ?? '-' }}
                                </span>
                            </td>

                            {{-- Semester --}}
                            <td>
                                <span class="text-secondary">
                                    {{ $repo->semester->nama ?? '-' }}
                                </span>
                            </td>

                            {{-- Kelas --}}
                            <td>
                                <span class="badge bg-light text-dark border">
                                    {{ $repo->kelas->nama ?? '-' }}
                                </span>
                            </td>

                            {{-- Mata Pelajaran --}}
                            <td>
                                <span class="text-dark fw-medium">
                                    {{ $repo->mataPelajaran->nama ?? '-' }}
                                </span>
                            </td>

                            {{-- Jenis Dokumen --}}
                            <td>
                                <span class="text-secondary">
                                    {{ $repo->jenisDokumen->nama ?? '-' }}
                                </span>
                            </td>

                            {{-- Akses --}}
                            <td>
                                @if($repo->akses === 'gratis')
                                    <span class="badge bg-success-lt text-success">
                                        Gratis
                                    </span>
                                @else
                                    <span class="badge bg-warning-lt text-warning">
                                        Premium
                                    </span>
                                @endif
                            </td>

                            {{-- Status --}}
                            <td>
                                @if($repo->status === 'dipublikasikan')
                                    <span class="badge bg-success-lt text-success">
                                        <i class="ti ti-check me-1"></i>
                                        Dipublikasikan
                                    </span>
                                @elseif($repo->status === 'draft')
                                    <span class="badge bg-secondary-lt text-secondary">
                                        Draft
                                    </span>
                                @else
                                    <span class="badge bg-secondary-lt text-secondary">
                                        Diarsipkan
                                    </span>
                                @endif
                            </td>

                            {{-- Aksi --}}
                            <td>
                                <div class="d-flex justify-content-end align-items-center gap-1">
                                    <a href="{{ route('admin.repository.show', $repo) }}"
                                        class="btn btn-sm btn-outline-secondary rounded-pill px-2"
                                        title="Lihat Detail">
                                        <i class="ti ti-eye"></i>
                                        <span class="d-none d-xl-inline ms-1">Detail</span>
                                    </a>

                                    <a href="{{ route('admin.repository.edit', $repo) }}"
                                        class="btn btn-sm btn-outline-primary rounded-pill px-2"
                                        title="Edit Repository">
                                        <i class="ti ti-edit"></i>
                                        <span class="d-none d-xl-inline ms-1">Edit</span>
                                    </a>

                                    <form action="{{ route('admin.repository.destroy', $repo) }}"
                                        method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus repository {{ addslashes($repo->judul) }}? Data yang dihapus tidak dapat dikembalikan.')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="btn btn-sm btn-outline-danger rounded-pill px-2"
                                            title="Hapus Repository">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center py-5">
                                <div class="py-4 text-center">
                                    <div class="avatar avatar-md bg-light text-secondary rounded-circle mb-3 mx-auto d-flex align-items-center justify-content-center">
                                        <i class="ti ti-package-off fs-2"></i>
                                    </div>
                                    <h4 class="fw-bold text-dark mb-1">Belum Ada Repository</h4>
                                    <p class="text-secondary small mb-0">
                                        @if(request()->hasAny(['search', 'kurikulum_id', 'semester_id', 'kelas_id', 'mata_pelajaran_id', 'jenis_dokumen_id', 'akses', 'status']))
                                            Tidak ditemukan repository yang sesuai dengan filter pencarian.
                                        @else
                                            Belum ada repository yang terdaftar. Gunakan tombol <strong>Tambah Repository</strong> di kanan atas untuk membuat paket baru.
                                        @endif
                                    </p>
                                    @if(request()->hasAny(['search', 'kurikulum_id', 'semester_id', 'kelas_id', 'mata_pelajaran_id', 'jenis_dokumen_id', 'akses', 'status']))
                                        <div class="mt-3">
                                            <a href="{{ route('admin.repository.index') }}" class="btn btn-sm btn-light border rounded-pill px-3">
                                                <i class="ti ti-rotate me-1"></i> Reset Filter
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($repositories->hasPages())
            <div class="card-footer bg-white border-top py-3">
                <div class="d-flex flex-column flex-sm-row align-items-center justify-content-between gap-3">
                    <div class="text-secondary small">
                        Menampilkan
                        <span class="fw-bold text-dark">{{ $repositories->firstItem() }}</span>
                        sampai
                        <span class="fw-bold text-dark">{{ $repositories->lastItem() }}</span>
                        dari
                        <span class="fw-bold text-dark">{{ $repositories->total() }}</span>
                        repository
                    </div>
                    <div>
                        {{ $repositories->links() }}
                    </div>
                </div>
            </div>
        @endif

    </div>

@endsection
