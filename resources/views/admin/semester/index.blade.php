@extends('admin.layouts.admin')

@section('title', 'Semester')
@section('page-title', 'Semester')
@section('page-description', 'Kelola data semester untuk pembagian materi pembelajaran.')

@section('page-breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}" class="text-secondary text-decoration-none">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <span class="text-secondary">Master Data</span>
            </li>
            <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">
                Semester
            </li>
        </ol>
    </nav>
@endsection

@section('page-actions')
    <a href="{{ route('admin.semester.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
        <i class="ti ti-plus me-1"></i>
        Tambah Semester
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

    {{-- Alert Danger / Error --}}
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
            <form method="GET" action="{{ route('admin.semester.index') }}" id="filter-form" class="row g-2 w-100 align-items-center">
                <div class="col-12 col-md-5">
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
                            placeholder="Cari semester..."
                        >
                    </div>
                </div>

                <div class="col-6 col-md-4">
                    <select name="status" class="form-select rounded-pill" onchange="this.form.submit()">
                        <option value="">Semua Status</option>
                        <option value="aktif" @selected(request('status') === 'aktif')>Aktif</option>
                        <option value="tidak_aktif" @selected(request('status') === 'tidak_aktif')>Tidak Aktif</option>
                    </select>
                </div>

                @if(request()->hasAny(['search', 'status']))
                    <div class="col-6 col-md-3">
                        <a href="{{ route('admin.semester.index') }}" class="btn btn-light border rounded-pill w-100">
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
                        <th style="width: 60px;">NO</th>
                        <th>NAMA SEMESTER</th>
                        <th style="width: 120px;">URUTAN</th>
                        <th style="width: 140px;">STATUS</th>
                        <th class="text-end" style="width: 170px;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($semesters as $semester)
                        <tr>
                            {{-- No --}}
                            <td class="text-secondary fw-medium">
                                {{ ($semesters->firstItem() ?? 1) + $loop->index }}
                            </td>

                            {{-- Nama Semester --}}
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar avatar-sm bg-danger-subtle text-danger rounded-circle flex-shrink-0">
                                        <i class="ti ti-calendar"></i>
                                    </div>
                                    <a href="{{ route('admin.semester.show', $semester) }}" class="fw-bold text-dark text-decoration-none">
                                        {{ $semester->nama }}
                                    </a>
                                </div>
                            </td>

                            {{-- Urutan --}}
                            <td>
                                <span class="badge bg-light text-dark border">
                                    {{ $semester->urutan }}
                                </span>
                            </td>

                            {{-- Status --}}
                            <td>
                                @if($semester->status === 'aktif')
                                    <span class="badge bg-success-lt text-success">
                                        <i class="ti ti-check me-1"></i>
                                        Aktif
                                    </span>
                                @else
                                    <span class="badge bg-secondary-lt text-secondary">
                                        Tidak Aktif
                                    </span>
                                @endif
                            </td>

                            {{-- Aksi --}}
                            <td>
                                <div class="d-flex justify-content-end align-items-center gap-1">
                                    {{-- Detail --}}
                                    <a href="{{ route('admin.semester.show', $semester) }}"
                                        class="btn btn-sm btn-outline-secondary rounded-pill px-2"
                                        title="Detail">
                                        <i class="ti ti-eye"></i>
                                        <span class="d-none d-xl-inline ms-1">Detail</span>
                                    </a>

                                    {{-- Edit --}}
                                    <a href="{{ route('admin.semester.edit', $semester) }}"
                                        class="btn btn-sm btn-outline-primary rounded-pill px-2"
                                        title="Edit">
                                        <i class="ti ti-edit"></i>
                                        <span class="d-none d-xl-inline ms-1">Edit</span>
                                    </a>

                                    {{-- Hapus --}}
                                    <form action="{{ route('admin.semester.destroy', $semester) }}"
                                        method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus semester {{ addslashes($semester->nama) }}? Data yang dihapus tidak dapat dikembalikan.')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="btn btn-sm btn-outline-danger rounded-pill px-2"
                                            title="Hapus">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="py-4 text-center">
                                    <div class="avatar avatar-md bg-light text-secondary rounded-circle mb-3 mx-auto d-flex align-items-center justify-content-center">
                                        <i class="ti ti-package-off fs-2"></i>
                                    </div>
                                    <h4 class="fw-bold text-dark mb-1">Belum Ada Semester</h4>
                                    <p class="text-secondary small mb-0">
                                        @if(request()->hasAny(['search', 'status']))
                                            Tidak ditemukan data semester yang sesuai dengan filter pencarian.
                                        @else
                                            Belum ada semester yang terdaftar. Gunakan tombol <strong>Tambah Semester</strong> di kanan atas untuk membuat semester baru.
                                        @endif
                                    </p>
                                    @if(request()->hasAny(['search', 'status']))
                                        <div class="mt-3">
                                            <a href="{{ route('admin.semester.index') }}" class="btn btn-sm btn-light border rounded-pill px-3">
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
        @if($semesters->hasPages())
            <div class="card-footer bg-white border-top py-3">
                <div class="d-flex flex-column flex-sm-row align-items-center justify-content-between gap-3">
                    <div class="text-secondary small">
                        Menampilkan
                        <span class="fw-bold text-dark">{{ $semesters->firstItem() }}</span>
                        sampai
                        <span class="fw-bold text-dark">{{ $semesters->lastItem() }}</span>
                        dari
                        <span class="fw-bold text-dark">{{ $semesters->total() }}</span>
                        semester
                    </div>
                    <div>
                        {{ $semesters->links() }}
                    </div>
                </div>
            </div>
        @endif

    </div>

@endsection
