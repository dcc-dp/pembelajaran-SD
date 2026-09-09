@extends('admin.layouts.admin')

@section('title', 'Paket Langganan')
@section('page-title', 'Paket Langganan')
@section('page-description', 'Kelola paket langganan dan durasi akses materi pembelajaran untuk guru.')

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
                Paket Langganan
            </li>
        </ol>
    </nav>
@endsection

@section('page-actions')
    <a href="{{ route('admin.paket-langganan.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
        <i class="ti ti-plus me-1"></i>
        Tambah Paket
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
            <form method="GET" action="{{ route('admin.paket-langganan.index') }}" id="filter-form" class="row g-2 w-100 align-items-center">
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
                            placeholder="Cari nama paket..."
                        >
                    </div>
                </div>

                <div class="col-6 col-md-3">
                    <select name="kelas_id" class="form-select rounded-pill" onchange="this.form.submit()">
                        <option value="">Semua Kelas</option>
                        @foreach($kelas as $item)
                            <option value="{{ $item->id }}" @selected(request('kelas_id') == $item->id)>
                                {{ $item->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-6 col-md-3">
                    <select name="semester_id" class="form-select rounded-pill" onchange="this.form.submit()">
                        <option value="">Semua Semester</option>
                        @foreach($semesters as $item)
                            <option value="{{ $item->id }}" @selected(request('semester_id') == $item->id)>
                                {{ $item->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-2">
                    <select name="status" class="form-select rounded-pill" onchange="this.form.submit()">
                        <option value="">Semua Status</option>
                        <option value="aktif" @selected(request('status') === 'aktif')>Aktif</option>
                        <option value="tidak_aktif" @selected(request('status') === 'tidak_aktif')>Tidak Aktif</option>
                    </select>
                </div>
            </form>
        </div>

        {{-- Table --}}
        <div class="table-responsive">
            <table class="table table-vcenter card-table table-hover">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Paket Langganan</th>
                        <th>Kelas</th>
                        <th>Semester</th>
                        <th>Harga</th>
                        <th>Durasi</th>
                        <th>Status</th>
                        <th class="text-end" style="width: 170px;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($paketLangganans as $index => $paket)
                        <tr>
                            {{-- No --}}
                            <td class="text-secondary fw-medium">
                                {{ $paketLangganans->firstItem() + $index }}
                            </td>

                            {{-- Nama & Deskripsi --}}
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar avatar-sm bg-danger-subtle text-danger rounded-circle flex-shrink-0">
                                        <i class="ti ti-package"></i>
                                    </div>
                                    <div>
                                        <a href="{{ route('admin.paket-langganan.show', $paket) }}" class="fw-bold text-dark text-decoration-none">
                                            {{ $paket->nama }}
                                        </a>
                                        @if($paket->deskripsi)
                                            <div class="text-secondary small mt-1">
                                                {{ Str::limit($paket->deskripsi, 55) }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            {{-- Kelas --}}
                            <td>
                                <span class="badge bg-light text-dark border">
                                    {{ $paket->kelas->nama ?? '-' }}
                                </span>
                            </td>

                            {{-- Semester --}}
                            <td>
                                <span class="text-secondary">
                                    {{ $paket->semester?->nama ?? 'Semua Semester' }}
                                </span>
                            </td>

                            {{-- Harga --}}
                            <td>
                                <span class="fw-bold text-dark fs-5">
                                    Rp {{ number_format($paket->harga, 0, ',', '.') }}
                                </span>
                            </td>

                            {{-- Durasi --}}
                            <td>
                                <span class="badge bg-light text-secondary border">
                                    <i class="ti ti-calendar me-1"></i>
                                    {{ $paket->durasi_bulan }} bulan
                                </span>
                            </td>

                            {{-- Status --}}
                            <td>
                                @if($paket->status === 'aktif')
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
                                    <a href="{{ route('admin.paket-langganan.show', $paket) }}"
                                        class="btn btn-sm btn-outline-secondary rounded-pill px-2"
                                        title="Lihat Detail">
                                        <i class="ti ti-eye"></i>
                                        <span class="d-none d-xl-inline ms-1">Detail</span>
                                    </a>

                                    <a href="{{ route('admin.paket-langganan.edit', $paket) }}"
                                        class="btn btn-sm btn-outline-primary rounded-pill px-2"
                                        title="Edit Paket">
                                        <i class="ti ti-edit"></i>
                                        <span class="d-none d-xl-inline ms-1">Edit</span>
                                    </a>

                                    <form action="{{ route('admin.paket-langganan.destroy', $paket) }}"
                                        method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus paket {{ addslashes($paket->nama) }}? Data yang dihapus tidak dapat dikembalikan.')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="btn btn-sm btn-outline-danger rounded-pill px-2"
                                            title="Hapus Paket">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <div class="py-4 text-center">
                                    <div class="avatar avatar-md bg-light text-secondary rounded-circle mb-3 mx-auto d-flex align-items-center justify-content-center">
                                        <i class="ti ti-package-off fs-2"></i>
                                    </div>
                                    <h4 class="fw-bold text-dark mb-1">Belum Ada Paket Langganan</h4>
                                    <p class="text-secondary small mb-0">
                                        @if(request()->hasAny(['search', 'kelas_id', 'semester_id', 'status']))
                                            Tidak ditemukan paket langganan yang sesuai dengan filter pencarian.
                                        @else
                                            Belum ada paket langganan yang terdaftar. Gunakan tombol <strong>Tambah Paket</strong> di kanan atas untuk membuat paket baru.
                                        @endif
                                    </p>
                                    @if(request()->hasAny(['search', 'kelas_id', 'semester_id', 'status']))
                                        <div class="mt-3">
                                            <a href="{{ route('admin.paket-langganan.index') }}" class="btn btn-sm btn-light border rounded-pill px-3">
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
        @if($paketLangganans->hasPages())
            <div class="card-footer d-flex flex-column flex-sm-row align-items-center justify-content-between gap-2 bg-white">
                <p class="m-0 text-secondary small">
                    Menampilkan
                    <span class="fw-bold text-dark">{{ $paketLangganans->firstItem() }}</span>
                    sampai
                    <span class="fw-bold text-dark">{{ $paketLangganans->lastItem() }}</span>
                    dari
                    <span class="fw-bold text-dark">{{ $paketLangganans->total() }}</span>
                    paket langganan
                </p>

                <div class="ms-sm-auto">
                    {{ $paketLangganans->links() }}
                </div>
            </div>
        @endif

    </div>

@endsection

@push('scripts')
<script>
    (function () {
        const searchInput = document.getElementById('search-input');
        const form = document.getElementById('filter-form');
        let debounceTimer;

        if (searchInput && form) {
            searchInput.addEventListener('input', function () {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(function () {
                    form.submit();
                }, 500);
            });
        }
    })();
</script>
@endpush