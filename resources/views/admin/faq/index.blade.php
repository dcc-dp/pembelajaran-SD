@extends('admin.layouts.admin')

@section('title', 'FAQ')
@section('page-title', 'FAQ')
@section('page-description', 'Kelola pertanyaan dan jawaban yang sering ditanyakan pengguna.')

@section('page-breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}" class="text-secondary text-decoration-none">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <span class="text-secondary">Pusat Bantuan</span>
            </li>
            <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">
                FAQ
            </li>
        </ol>
    </nav>
@endsection

@section('page-actions')
    <a href="{{ route('admin.faq.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
        <i class="ti ti-plus me-1"></i>
        Tambah FAQ
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

        {{-- Card Header & Filter Bar --}}
        <div class="card-header py-3 bg-white border-bottom">
            <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 w-100">
                <h3 class="card-title fw-bold text-dark mb-0">Daftar FAQ</h3>

                <form method="GET" action="{{ route('admin.faq.index') }}" id="filter-form" class="row g-2 align-items-center m-0">
                    <div class="col-12 col-sm-auto">
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
                                placeholder="Cari pertanyaan..."
                            >
                        </div>
                    </div>

                    <div class="col-6 col-sm-auto">
                        <select name="status" class="form-select rounded-pill">
                            <option value="">Semua Status</option>
                            <option value="aktif" @selected(request('status') === 'aktif')>Aktif</option>
                            <option value="tidak_aktif" @selected(request('status') === 'tidak_aktif')>Tidak Aktif</option>
                        </select>
                    </div>

                    <div class="col-6 col-sm-auto d-flex gap-2">
                        <button type="submit" class="btn btn-primary rounded-pill px-3">
                            <i class="ti ti-search me-1"></i> Cari
                        </button>
                        @if(request()->hasAny(['search', 'status']))
                            <a href="{{ route('admin.faq.index') }}" class="btn btn-light border rounded-pill px-3">
                                <i class="ti ti-rotate me-1"></i> Reset
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        {{-- Table --}}
        <div class="table-responsive">
            <table class="table table-vcenter card-table table-hover">
                <thead>
                    <tr>
                        <th style="width: 60px;">NO</th>
                        <th style="width: 90px;">URUTAN</th>
                        <th>PERTANYAAN</th>
                        <th>JAWABAN</th>
                        <th style="width: 140px;">STATUS</th>
                        <th class="text-end" style="width: 170px;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($faqs as $item)
                        <tr>
                            {{-- No --}}
                            <td class="text-secondary fw-medium">
                                {{ ($faqs->firstItem() ?? 1) + $loop->index }}
                            </td>

                            {{-- Urutan --}}
                            <td>
                                <span class="badge bg-light text-dark border">
                                    {{ $item->urutan }}
                                </span>
                            </td>

                            {{-- Pertanyaan --}}
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar avatar-sm bg-danger-subtle text-danger rounded-circle flex-shrink-0">
                                        <i class="ti ti-help"></i>
                                    </div>
                                    <a href="{{ route('admin.faq.show', $item) }}" class="fw-bold text-dark text-decoration-none">
                                        {{ \Illuminate\Support\Str::limit($item->pertanyaan, 70, '...') }}
                                    </a>
                                </div>
                            </td>

                            {{-- Jawaban --}}
                            <td class="text-secondary small" style="max-width: 320px;">
                                {{ \Illuminate\Support\Str::limit($item->jawaban, 80, '...') }}
                            </td>

                            {{-- Status --}}
                            <td>
                                @if($item->status === 'aktif')
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
                                    <a href="{{ route('admin.faq.show', $item) }}"
                                        class="btn btn-sm btn-outline-secondary rounded-pill px-2"
                                        title="Detail">
                                        <i class="ti ti-eye"></i>
                                        <span class="d-none d-xl-inline ms-1">Detail</span>
                                    </a>

                                    {{-- Edit --}}
                                    <a href="{{ route('admin.faq.edit', $item) }}"
                                        class="btn btn-sm btn-outline-primary rounded-pill px-2"
                                        title="Edit">
                                        <i class="ti ti-edit"></i>
                                        <span class="d-none d-xl-inline ms-1">Edit</span>
                                    </a>

                                    {{-- Hapus --}}
                                    <form action="{{ route('admin.faq.destroy', $item) }}"
                                        method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus FAQ ini? Data yang dihapus tidak dapat dikembalikan.')">
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
                            <td colspan="6" class="text-center py-5">
                                <div class="py-4 text-center">
                                    <div class="avatar avatar-md bg-light text-secondary rounded-circle mb-3 mx-auto d-flex align-items-center justify-content-center">
                                        <i class="ti ti-help-off fs-2"></i>
                                    </div>
                                    <h4 class="fw-bold text-dark mb-1">Belum ada FAQ</h4>
                                    <p class="text-secondary small mb-0">
                                        @if(request()->hasAny(['search', 'status']))
                                            Tidak ditemukan FAQ yang sesuai dengan filter pencarian.
                                        @else
                                            Belum ada pertanyaan dan jawaban yang ditambahkan.
                                        @endif
                                    </p>
                                    @if(request()->hasAny(['search', 'status']))
                                        <div class="mt-3">
                                            <a href="{{ route('admin.faq.index') }}" class="btn btn-sm btn-light border rounded-pill px-3">
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
        @if($faqs->hasPages())
            <div class="card-footer bg-white border-top py-3">
                <div class="d-flex flex-column flex-sm-row align-items-center justify-content-between gap-3">
                    <div class="text-secondary small">
                        Menampilkan
                        <span class="fw-bold text-dark">{{ $faqs->firstItem() }}</span>
                        sampai
                        <span class="fw-bold text-dark">{{ $faqs->lastItem() }}</span>
                        dari
                        <span class="fw-bold text-dark">{{ $faqs->total() }}</span>
                        FAQ
                    </div>
                    <div>
                        {{ $faqs->links() }}
                    </div>
                </div>
            </div>
        @endif

    </div>

@endsection
