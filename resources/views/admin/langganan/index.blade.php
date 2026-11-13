@extends('admin.layouts.admin')

@section('title', 'Data Langganan Guru')
@section('page-title', 'Data Langganan Guru')
@section('page-description', 'Pantau seluruh data langganan paket dan masa aktif materi guru.')

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
                Langganan
            </li>
        </ol>
    </nav>
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

    {{-- Ringkasan --}}
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-lg-4">
            <div class="card border-0 shadow-sm p-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar avatar-md bg-success-subtle text-success rounded-circle">
                        <i class="ti ti-shield-check fs-2"></i>
                    </div>
                    <div>
                        <div class="text-secondary small fw-medium">Langganan Aktif Saat Ini</div>
                        <div class="fw-bold fs-3 text-dark">{{ $totalAktif }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-4">
            <div class="card border-0 shadow-sm p-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar avatar-md bg-primary-subtle text-primary rounded-circle">
                        <i class="ti ti-repeat fs-2"></i>
                    </div>
                    <div>
                        <div class="text-secondary small fw-medium">Total Seluruh Riwayat</div>
                        <div class="fw-bold fs-3 text-dark">{{ $langganans->total() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0">

        {{-- Filter Bar --}}
        <div class="card-header py-3 bg-white border-bottom">
            <form method="GET" action="{{ route('admin.langganan.index') }}" class="row g-2 w-100 align-items-center">
                <div class="col-12 col-md-8">
                    <div class="input-icon">
                        <span class="input-icon-addon">
                            <i class="ti ti-search text-muted"></i>
                        </span>
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            class="form-control rounded-pill"
                            placeholder="Cari nama guru atau email..."
                        >
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <select name="status" class="form-select rounded-pill" onchange="this.form.submit()">
                        <option value="">Semua Status</option>
                        <option value="aktif" @selected(request('status') === 'aktif')>Aktif</option>
                        <option value="berakhir" @selected(request('status') === 'berakhir')>Berakhir</option>
                        <option value="dibatalkan" @selected(request('status') === 'dibatalkan')>Dibatalkan</option>
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
                        <th>Guru</th>
                        <th>Paket Langganan</th>
                        <th>Semester & Kelas</th>
                        <th>Masa Akses</th>
                        <th>Status Pembayaran</th>
                        <th>Status Akses</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($langganans as $index => $item)
                        @php
                            $user = $item->user;
                            $paket = $item->paketLangganan;
                            $pembayaran = $item->pembayarans->sortByDesc('tanggal_pembayaran')->first();
                            $isAktif = $item->isAktif();
                            $sisaHari = $item->sisaHari();
                        @endphp
                        <tr>
                            <td class="text-secondary fw-medium">
                                {{ $langganans->firstItem() + $index }}
                            </td>

                            {{-- Guru --}}
                            <td>
                                <div class="fw-bold text-dark">{{ $user?->nama ?? '-' }}</div>
                                <div class="text-secondary small">{{ $user?->email ?? '-' }}</div>
                                @if($user?->nama_sekolah)
                                    <div class="text-muted small" style="font-size: 0.75rem;">
                                        <i class="ti ti-school me-1"></i>{{ $user->nama_sekolah }}
                                    </div>
                                @endif
                            </td>

                            {{-- Paket --}}
                            <td>
                                <div class="fw-bold text-dark">{{ $paket?->nama ?? '-' }}</div>
                                <div class="text-secondary small">
                                    Rp {{ number_format($paket?->harga ?? 0, 0, ',', '.') }} / {{ $paket?->durasi_bulan ?? 12 }} Bulan
                                </div>
                            </td>

                            {{-- Semester & Kelas --}}
                            <td>
                                <span class="badge bg-primary-lt text-primary">
                                    <i class="ti ti-calendar me-1"></i>{{ $paket?->semester?->nama ?? 'Semester' }}
                                </span>
                                <span class="badge bg-light text-secondary border">
                                    Kelas 1–6 SD
                                </span>
                            </td>

                            {{-- Masa Akses --}}
                            <td>
                                <div class="text-dark small fw-medium">
                                    {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y') }} s/d {{ \Carbon\Carbon::parse($item->tanggal_berakhir)->format('d M Y') }}
                                </div>
                                <div class="mt-0.5">
                                    @if($isAktif)
                                        <span class="text-success small fw-semibold">
                                            <i class="ti ti-clock me-0.5"></i> Sisa {{ $sisaHari }} hari
                                        </span>
                                    @else
                                        <span class="text-muted small">
                                            Masa aktif berakhir
                                        </span>
                                    @endif
                                </div>
                            </td>

                            {{-- Status Pembayaran --}}
                            <td>
                                @if($pembayaran)
                                    @if($pembayaran->status === 'berhasil')
                                        <span class="badge bg-success-lt text-success">
                                            <i class="ti ti-check me-1"></i> Terverifikasi
                                        </span>
                                    @elseif($pembayaran->status === 'menunggu')
                                        <a href="{{ route('admin.pembayaran.index') }}" class="badge bg-warning-lt text-warning text-decoration-none">
                                            <i class="ti ti-clock me-1"></i> Menunggu Verifikasi
                                        </a>
                                    @else
                                        <span class="badge bg-danger-lt text-danger">
                                            <i class="ti ti-x me-1"></i> Ditolak
                                        </span>
                                    @endif
                                @else
                                    <span class="badge bg-light text-muted border">
                                        Manual Admin
                                    </span>
                                @endif
                            </td>

                            {{-- Status Akses --}}
                            <td>
                                @if($isAktif)
                                    <span class="badge bg-success text-white rounded-pill px-2.5">
                                        Aktif
                                    </span>
                                @else
                                    <span class="badge bg-secondary-lt text-secondary rounded-pill px-2.5">
                                        Tidak Aktif
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="text-muted mb-2">
                                    <i class="ti ti-folder-off fs-1"></i>
                                </div>
                                <div class="fw-bold text-dark">Belum ada data langganan guru</div>
                                <div class="text-secondary small">Seluruh paket yang diambil oleh guru akan tampil di sini.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($langganans->hasPages())
            <div class="card-footer bg-white border-top py-3 d-flex align-items-center justify-content-between">
                <div class="text-secondary small">
                    Menampilkan <strong>{{ $langganans->firstItem() }}</strong> - <strong>{{ $langganans->lastItem() }}</strong> dari <strong>{{ $langganans->total() }}</strong> langganan
                </div>
                <div>
                    {{ $langganans->links() }}
                </div>
            </div>
        @endif

    </div>

@endsection

