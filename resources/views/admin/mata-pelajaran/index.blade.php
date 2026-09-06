@extends('admin.layouts.admin')

@section('title', 'Mata Pelajaran')
@section('page-title', 'Mata Pelajaran')
@section('page-description', 'Kelola daftar mata pelajaran kurikulum SD yang tersedia pada sistem.')

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
                Mata Pelajaran
            </li>
        </ol>
    </nav>
@endsection

@section('page-actions')
    <a href="{{ route('admin.mata-pelajaran.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
        <i class="ti ti-plus me-1"></i>
        Tambah Mata Pelajaran
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
    @if(session('danger'))
        <div class="alert alert-danger alert-dismissible shadow-sm border-0 mb-4" role="alert">
            <div class="d-flex align-items-center">
                <i class="ti ti-alert-circle fs-2 me-2 text-danger"></i>
                <div class="fw-medium">
                    {{ session('danger') }}
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <div>
                <h3 class="card-title fw-bold text-dark">Daftar Mata Pelajaran</h3>
                <p class="text-secondary small mb-0">Urutan dan status aktif mata pelajaran pada katalog materi guru.</p>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-vcenter card-table table-hover" id="simple-datatable-demo">
                <thead>
                    <tr>
                        <th style="width: 80px;">Urutan</th>
                        <th>Nama Mata Pelajaran</th>
                        <th style="width: 120px;">Status</th>
                        <th class="text-end" style="width: 140px;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($mataPelajarans as $mataPelajaran)
                        <tr>
                            {{-- Urutan --}}
                            <td>
                                <span class="badge bg-light text-dark border fw-bold px-2 py-1">
                                    #{{ $mataPelajaran->urutan }}
                                </span>
                            </td>

                            {{-- Nama --}}
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar avatar-sm bg-danger-subtle text-danger rounded-circle flex-shrink-0">
                                        <i class="ti ti-book"></i>
                                    </div>
                                    <span class="fw-bold text-dark">
                                        {{ $mataPelajaran->nama }}
                                    </span>
                                </div>
                            </td>

                            {{-- Status --}}
                            <td>
                                @if($mataPelajaran->status === 'aktif')
                                    <span class="badge bg-success-lt text-success">
                                        <i class="ti ti-check me-1"></i>
                                        Aktif
                                    </span>
                                @else
                                    <span class="badge bg-secondary-lt text-secondary">
                                        Nonaktif
                                    </span>
                                @endif
                            </td>

                            {{-- Aksi --}}
                            <td>
                                <div class="d-flex justify-content-end align-items-center gap-1">
                                    <a href="{{ route('admin.mata-pelajaran.edit', $mataPelajaran) }}"
                                        class="btn btn-sm btn-outline-primary rounded-pill px-2"
                                        title="Edit Data">
                                        <i class="ti ti-edit"></i>
                                        <span class="d-none d-md-inline ms-1">Edit</span>
                                    </a>

                                    <form action="{{ route('admin.mata-pelajaran.destroy', $mataPelajaran) }}"
                                        method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data mata pelajaran ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="btn btn-sm btn-outline-danger rounded-pill px-2"
                                            title="Hapus Data">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <div class="py-4 text-center">
                                    <div class="avatar avatar-md bg-light text-secondary rounded-circle mb-3 mx-auto d-flex align-items-center justify-content-center">
                                        <i class="ti ti-books fs-2"></i>
                                    </div>
                                    <h4 class="fw-bold text-dark mb-1">Belum Ada Mata Pelajaran</h4>
                                    <p class="text-secondary small mb-0">
                                        Data mata pelajaran masih kosong. Silakan gunakan tombol <strong>Tambah Mata Pelajaran</strong> di atas untuk membuat data baru.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Assets Simple-DataTables --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css">
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const table = document.querySelector("#simple-datatable-demo");
            if (table && table.querySelectorAll("tbody tr").length > 1) {
                new simpleDatatables.DataTable(table, {
                    searchable: true,
                    perPage: 10,
                    labels: {
                        placeholder: "Cari mata pelajaran...",
                        perPage: "{select} data per halaman",
                        noRows: "Tidak ada data ditemukan",
                        info: "Menampilkan {start} - {end} dari {rows} data",
                    }
                });
            }
        });
    </script>

@endsection