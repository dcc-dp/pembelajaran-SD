@extends('admin.layouts.admin')

@section('title', 'Jenis Dokumen')
@section('page-title', 'Jenis Dokumen')

@section('page-actions')
    <a href="{{ route('admin.jenis-dokumen.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus me-1" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <path d="M12 5l0 14" />
            <path d="M5 12l14 0" />
        </svg>
        Tambah Jenis Dokumen
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
                    Jenis Dokumen
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
                Daftar Jenis Dokumen
            </h3>

            {{-- Filter Form --}}
            <form method="GET" action="{{ route('admin.jenis-dokumen.index') }}" class="d-flex flex-wrap align-items-center gap-2 ms-auto">
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
                        placeholder="Cari jenis dokumen..."
                    >
                </div>

                {{-- Filter Kategori --}}
                <select name="kategori" class="form-select form-select-sm rounded-pill" style="width: auto;" onchange="this.form.submit()">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoriDokumens as $kat)
                        <option value="{{ $kat->id }}" @selected(request('kategori') == $kat->id)>
                            {{ $kat->nama }}
                        </option>
                    @endforeach
                </select>

                {{-- Filter Status --}}
                <select name="status" class="form-select form-select-sm rounded-pill" style="width: auto;" onchange="this.form.submit()">
                    <option value="">Semua Status</option>
                    <option value="aktif" @selected(request('status') === 'aktif')>Aktif</option>
                    <option value="tidak_aktif" @selected(request('status') === 'tidak_aktif')>Tidak Aktif</option>
                </select>

                @if(request()->hasAny(['search', 'kategori', 'status']))
                    <a href="{{ route('admin.jenis-dokumen.index') }}" class="btn btn-sm btn-light border rounded-pill px-3" title="Reset Filter">
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
                        <th>Kategori Dokumen</th>
                        <th>Nama Jenis Dokumen</th>
                        <th>Deskripsi</th>
                        <th style="width: 100px;">Urutan</th>
                        <th style="width: 130px;">Status</th>
                        <th class="text-end" style="width: 220px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jenisDokumens as $item)
                        <tr>
                            {{-- No --}}
                            <td class="text-secondary">
                                {{ ($jenisDokumens->firstItem() ?? 1) + $loop->index }}
                            </td>

                            {{-- Kategori --}}
                            <td>
                                <span class="badge bg-blue-lt text-blue">
                                    {{ $item->kategoriDokumen->nama ?? '-' }}
                                </span>
                            </td>

                            {{-- Nama Jenis Dokumen --}}
                            <td>
                                <a href="{{ route('admin.jenis-dokumen.show', $item) }}" class="fw-bold text-dark text-decoration-none">
                                    {{ $item->nama }}
                                </a>
                            </td>

                            {{-- Deskripsi --}}
                            <td class="text-secondary small" style="max-width: 250px;">
                                {{ $item->deskripsi ? Str::limit($item->deskripsi, 60, '...') : '-' }}
                            </td>

                            {{-- Urutan --}}
                            <td>
                                <span class="badge bg-light text-dark border">
                                    {{ $item->urutan }}
                                </span>
                            </td>

                            {{-- Status --}}
                            <td>
                                @if($item->status === 'aktif')
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
                                    <a href="{{ route('admin.jenis-dokumen.show', $item) }}"
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
                                    <a href="{{ route('admin.jenis-dokumen.edit', $item) }}"
                                        class="btn btn-sm btn-outline-primary rounded-pill px-2"
                                        title="Edit">
                                        <x-admin-icon name="edit" />
                                        <span class="ms-1">Edit</span>
                                    </a>

                                    {{-- Hapus --}}
                                    <form action="{{ route('admin.jenis-dokumen.destroy', $item) }}"
                                        method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus jenis dokumen {{ addslashes($item->nama) }}? Data yang dihapus tidak dapat dikembalikan.')">
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
                            <td colspan="7" class="text-center py-5">
                                <div class="py-4 text-center">
                                    <div class="avatar avatar-md bg-light text-secondary rounded-circle mb-3 mx-auto d-flex align-items-center justify-content-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-inbox text-secondary" width="28" height="28" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <rect x="4" y="4" width="16" height="16" rx="2" />
                                            <path d="M4 13h4l2 3h4l2 -3h4" />
                                        </svg>
                                    </div>
                                    <h4 class="fw-bold text-dark mb-1">Belum Ada Data Jenis Dokumen</h4>
                                    <p class="text-secondary small mb-3">
                                        @if(request()->hasAny(['search', 'kategori', 'status']))
                                            Tidak ditemukan jenis dokumen yang sesuai dengan filter pencarian.
                                        @else
                                            Belum ada data jenis dokumen yang tersimpan di sistem.
                                        @endif
                                    </p>
                                    @if(request()->hasAny(['search', 'kategori', 'status']))
                                        <a href="{{ route('admin.jenis-dokumen.index') }}" class="btn btn-sm btn-light border rounded-pill px-3">
                                            Reset Filter
                                        </a>
                                    @else
                                        <a href="{{ route('admin.jenis-dokumen.create') }}" class="btn btn-sm btn-primary rounded-pill px-3">
                                            Tambah Jenis Dokumen
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
        @if($jenisDokumens->hasPages())
            <div class="card-footer d-flex flex-column flex-sm-row align-items-center justify-content-between gap-2 bg-white">
                <p class="m-0 text-secondary small">
                    Menampilkan
                    <span class="fw-bold text-dark">{{ $jenisDokumens->firstItem() }}</span>
                    sampai
                    <span class="fw-bold text-dark">{{ $jenisDokumens->lastItem() }}</span>
                    dari
                    <span class="fw-bold text-dark">{{ $jenisDokumens->total() }}</span>
                    jenis dokumen
                </p>

                <div class="ms-sm-auto">
                    {{ $jenisDokumens->links() }}
                </div>
            </div>
        @endif

    </div>

@endsection