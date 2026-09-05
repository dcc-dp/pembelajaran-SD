@extends('admin.layouts.admin')

@section('title', 'Semester')
@section('page-title', 'Semester')

@section('page-actions')
    <a href="{{ route('admin.semester.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus me-1" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <path d="M12 5l0 14" />
            <path d="M5 12l14 0" />
        </svg>
        Tambah Semester
    </a>
@endsection

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
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">
                    Semester
                </li>
            </ol>
        </nav>
    </div>

    {{-- Alert Success --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
            <div class="d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check text-success me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                    <path d="M9 12l2 2l4 -4" />
                </svg>
                <div class="fw-medium">
                    {{ session('success') }}
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
        </div>
    @endif

    {{-- Alert Danger / Error --}}
    @if(session('danger') || session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
            <div class="d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alert-circle text-danger me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                    <path d="M12 8l0 4" />
                    <path d="M12 16l.01 0" />
                </svg>
                <div class="fw-medium">
                    {{ session('danger') ?? session('error') }}
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0 mb-4">

        {{-- Card Header --}}
        <div class="card-header py-3 bg-white d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3 border-bottom">
            <h3 class="card-title fw-bold text-dark mb-0">
                Daftar Semester
            </h3>

            {{-- Filter Form --}}
            <form method="GET" action="{{ route('admin.semester.index') }}" class="d-flex flex-wrap align-items-center gap-2 ms-auto">
                <div class="input-icon">
                    <span class="input-icon-addon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search text-muted" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                            <path d="M21 21l-6 -6" />
                        </svg>
                    </span>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control form-control-sm rounded-pill"
                        placeholder="Cari semester..."
                    >
                </div>

                <select name="status" class="form-select form-select-sm rounded-pill" style="width: auto;" onchange="this.form.submit()">
                    <option value="">Semua Status</option>
                    <option value="aktif" @selected(request('status') === 'aktif')>Aktif</option>
                    <option value="tidak_aktif" @selected(request('status') === 'tidak_aktif')>Tidak Aktif</option>
                </select>

                @if(request()->hasAny(['search', 'status']))
                    <a href="{{ route('admin.semester.index') }}" class="btn btn-sm btn-light border rounded-pill px-3" title="Reset Filter">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        {{-- Table --}}
        <div class="table-responsive">
            <table class="table table-vcenter card-table table-hover">
                <thead>
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th>Nama Semester</th>
                        <th style="width: 120px;">Urutan</th>
                        <th style="width: 140px;">Status</th>
                        <th class="text-end" style="width: 220px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($semesters as $semester)
                        <tr>
                            {{-- No --}}
                            <td class="text-secondary">
                                {{ ($semesters->firstItem() ?? 1) + $loop->index }}
                            </td>

                            {{-- Nama Semester --}}
                            <td>
                                <a href="{{ route('admin.semester.show', $semester) }}" class="fw-bold text-dark text-decoration-none">
                                    {{ $semester->nama }}
                                </a>
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
                                    <span class="badge bg-green-lt text-green">
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
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                            <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                        </svg>
                                        <span class="ms-1">Detail</span>
                                    </a>

                                    {{-- Edit --}}
                                    <a href="{{ route('admin.semester.edit', $semester) }}"
                                        class="btn btn-sm btn-outline-primary rounded-pill px-2"
                                        title="Edit">
                                        <x-admin-icon name="edit" />
                                        <span class="ms-1">Edit</span>
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
                                            <x-admin-icon name="trash" />
                                            <span class="ms-1">Hapus</span>
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
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-inbox text-secondary" width="28" height="28" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <rect x="4" y="4" width="16" height="16" rx="2" />
                                            <path d="M4 13h4l2 3h4l2 -3h4" />
                                        </svg>
                                    </div>
                                    <h4 class="fw-bold text-dark mb-1">Belum Ada Data Semester</h4>
                                    <p class="text-secondary small mb-3">
                                        @if(request()->hasAny(['search', 'status']))
                                            Tidak ditemukan data semester yang sesuai dengan filter pencarian.
                                        @else
                                            Belum ada data semester yang tersimpan di sistem.
                                        @endif
                                    </p>
                                    @if(request()->hasAny(['search', 'status']))
                                        <a href="{{ route('admin.semester.index') }}" class="btn btn-sm btn-light border rounded-pill px-3">
                                            Reset Filter
                                        </a>
                                    @else
                                        <a href="{{ route('admin.semester.create') }}" class="btn btn-sm btn-primary rounded-pill px-3">
                                            Tambah Semester
                                        </a>
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
            <div class="card-footer d-flex flex-column flex-sm-row align-items-center justify-content-between gap-2 bg-white">
                <p class="m-0 text-secondary small">
                    Menampilkan
                    <span class="fw-bold text-dark">{{ $semesters->firstItem() }}</span>
                    sampai
                    <span class="fw-bold text-dark">{{ $semesters->lastItem() }}</span>
                    dari
                    <span class="fw-bold text-dark">{{ $semesters->total() }}</span>
                    semester
                </p>

                <div class="ms-sm-auto">
                    {{ $semesters->links() }}
                </div>
            </div>
        @endif

    </div>

@endsection
