@extends('admin.layouts.admin')

@section('title', 'Paket Langganan')

@section('page-pretitle', 'Manajemen')
@section('page-title', 'Paket Langganan')

@section('content')

<div class="row row-cards">
    <div class="col-12">

        <div class="card">

            {{-- Header --}}
            <div class="card-header">
                <div>
                    <h3 class="card-title">Daftar Paket Langganan</h3>
                    <div class="text-secondary">
                        Kelola paket langganan yang tersedia untuk guru.
                    </div>
                </div>

                <div class="card-actions">
                    <a href="{{ route('admin.paket-langganan.create') }}"
                       class="btn btn-primary">
                        <i class="ti ti-plus me-1"></i>
                        Tambah Paket
                    </a>
                </div>
            </div>

            {{-- Alert Success --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible m-3" role="alert">
                    <div class="d-flex">
                        <i class="ti ti-check me-2"></i>

                        <div>
                            {{ session('success') }}
                        </div>
                    </div>

                    <a class="btn-close"
                       data-bs-dismiss="alert"
                       aria-label="close"></a>
                </div>
            @endif

            {{-- Filter --}}
<div class="card-body border-bottom">
    <form method="GET" action="{{ route('admin.paket-langganan.index') }}" id="filter-form" class="row g-2">
        <div class="col-md-4">
            <input type="text"
                   name="search"
                   id="search-input"
                   value="{{ request('search') }}"
                   class="form-control"
                   placeholder="Cari paket...">
        </div>

        <div class="col-md-3">
            <select name="kelas_id" class="form-select" onchange="this.form.submit()">
                <option value="">Semua Kelas</option>
                @foreach($kelas as $item)
                    <option value="{{ $item->id }}" @selected(request('kelas_id') == $item->id)>
                        {{ $item->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <select name="semester_id" class="form-select" onchange="this.form.submit()">
                <option value="">Semua Semester</option>
                @foreach($semesters as $item)
                    <option value="{{ $item->id }}" @selected(request('semester_id') == $item->id)>
                        {{ $item->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2">
            <select name="status" class="form-select" onchange="this.form.submit()">
                <option value="">Status</option>
                <option value="aktif" @selected(request('status') === 'aktif')>Aktif</option>
                <option value="tidak_aktif" @selected(request('status') === 'tidak_aktif')>Tidak Aktif</option>
            </select>
        </div>
    </form>
</div>

@push('scripts')
<script>
    (function () {
        const searchInput = document.getElementById('search-input');
        const form = document.getElementById('filter-form');
        let debounceTimer;

        searchInput.addEventListener('input', function () {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(function () {
                form.submit();
            }, 500);
        });
    })();
</script>
@endpush

            {{-- Table --}}
            <div class="table-responsive">

                <table class="table table-vcenter card-table">

                    <thead>
                        <tr>
                            <th width="60">No</th>
                            <th>Nama Paket</th>
                            <th>Kelas</th>
                            <th>Semester</th>
                            <th>Harga</th>
                            <th>Durasi</th>
                            <th>Status</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($paketLangganans as $index => $paket)

                            <tr>

                                {{-- No --}}
                                <td>
                                    {{ $paketLangganans->firstItem() + $index }}
                                </td>

                                {{-- Nama --}}
                                <td>
                                    <div class="fw-semibold">
                                        {{ $paket->nama }}
                                    </div>

                                    @if($paket->deskripsi)
                                        <div class="text-secondary small">
                                            {{ Str::limit($paket->deskripsi, 60) }}
                                        </div>
                                    @endif
                                </td>

                                {{-- Kelas --}}
                                <td>
                                    {{ $paket->kelas->nama ?? '-' }}
                                </td>

                                {{-- Semester --}}
                                <td>
                                    {{ $paket->semester?->nama ?? 'Semua Semester' }}
                                </td>

                                {{-- Harga --}}
                                <td>
                                    <span class="fw-semibold">
                                        Rp {{ number_format($paket->harga, 0, ',', '.') }}
                                    </span>
                                </td>

                                {{-- Durasi --}}
                                <td>
                                    {{ $paket->durasi_bulan }} bulan
                                </td>

                                {{-- Status --}}
                                <td>
                                    @if($paket->status === 'aktif')
                                        <span class="badge bg-success-lt text-success">
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
                                    <div class="d-flex justify-content-end gap-2">

                                        <a href="{{ route('admin.paket-langganan.edit', $paket) }}"
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="ti ti-edit"></i>
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.paket-langganan.destroy', $paket) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus paket ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-danger">
                                                <i class="ti ti-trash"></i>
                                                Hapus
                                            </button>

                                        </form>

                                    </div>
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="8" class="text-center py-5">

                                    <div class="text-secondary mb-3">
                                        <i class="ti ti-package"
                                           style="font-size: 3rem;"></i>
                                    </div>

                                    <div class="fw-semibold">
                                        Belum ada paket langganan
                                    </div>

                                    <div class="text-secondary mb-3">
                                        Silakan tambahkan paket langganan pertama.
                                    </div>


                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            {{-- Pagination --}}
            @if($paketLangganans->hasPages())

                <div class="card-footer d-flex align-items-center">

                    <p class="m-0 text-secondary">
                        Menampilkan
                        <strong>{{ $paketLangganans->firstItem() }}</strong>
                        sampai
                        <strong>{{ $paketLangganans->lastItem() }}</strong>
                        dari
                        <strong>{{ $paketLangganans->total() }}</strong>
                        paket
                    </p>

                    <div class="ms-auto">
                        {{ $paketLangganans->links() }}
                    </div>

                </div>

            @endif

        </div>

    </div>
</div>

@endsection