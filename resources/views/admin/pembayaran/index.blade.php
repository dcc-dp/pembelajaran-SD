@extends('admin.layouts.admin')

@section('title', 'Transaksi Pembayaran')
@section('page-title', 'Transaksi Pembayaran')
@section('page-description', 'Pantau transaksi pembayaran dan status langganan guru.')

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
                Pembayaran
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

    {{-- Ringkasan Status Pembayaran --}}
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-lg-4">
            <div class="card border-0 shadow-sm p-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar avatar-md bg-warning-subtle text-warning rounded-circle">
                        <i class="ti ti-clock fs-2"></i>
                    </div>
                    <div>
                        <div class="text-secondary small fw-medium">Menunggu Pembayaran</div>
                        <div class="fw-bold fs-3 text-dark">{{ $totalMenunggu }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-4">
            <div class="card border-0 shadow-sm p-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar avatar-md bg-success-subtle text-success rounded-circle">
                        <i class="ti ti-check fs-2"></i>
                    </div>
                    <div>
                        <div class="text-secondary small fw-medium">Pembayaran Lunas</div>
                        <div class="fw-bold fs-3 text-dark">{{ $totalBerhasil }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-4">
            <div class="card border-0 shadow-sm p-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar avatar-md bg-danger-subtle text-danger rounded-circle">
                        <i class="ti ti-x fs-2"></i>
                    </div>
                    <div>
                        <div class="text-secondary small fw-medium">Dibatalkan / Gagal</div>
                        <div class="fw-bold fs-3 text-dark">{{ $totalGagal }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0">

        {{-- Filter Bar --}}
        <div class="card-header py-3 bg-white border-bottom">
            <form method="GET" action="{{ route('admin.pembayaran.index') }}" class="row g-2 w-100 align-items-center">
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
                        <option value="">Semua Status Transaksi</option>
                        <option value="menunggu" @selected(request('status') === 'menunggu')>Menunggu Pembayaran</option>
                        <option value="berhasil" @selected(request('status') === 'berhasil')>Lunas</option>
                        <option value="gagal" @selected(request('status') === 'gagal')>Dibatalkan / Gagal</option>
                    </select>
                </div>
            </form>
        </div>

        {{-- Table --}}
        <div class="table-responsive">
            <table class="table table-vcenter card-table table-hover">
                <thead>
                    <tr>
                        <th style="width: 140px;">No. Pesanan</th>
                        <th>Guru</th>
                        <th>Paket & Semester</th>
                        <th>Nominal</th>
                        <th>Waktu Transaksi</th>
                        <th>Status Pembayaran</th>
                        <th class="text-end" style="width: 180px;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($pembayarans as $index => $item)
                        @php
                            $user = $item->langganan?->user;
                            $paket = $item->langganan?->paketLangganan;
                            $orderId = $item->order_id ?? ('INV-' . \Carbon\Carbon::parse($item->tanggal_pembayaran)->format('Ymd') . '-' . str_pad((string) $item->id, 4, '0', STR_PAD_LEFT));
                        @endphp
                        <tr>
                            {{-- Order ID --}}
                            <td>
                                <span class="font-monospace fw-bold text-dark small bg-light border px-2 py-1 rounded">
                                    {{ $orderId }}
                                </span>
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

                            {{-- Paket & Semester --}}
                            <td>
                                <div class="fw-semibold text-dark">{{ $paket?->nama ?? '-' }}</div>
                                <div class="mt-1">
                                    <span class="badge bg-primary-lt text-primary">
                                        <i class="ti ti-calendar me-1"></i>{{ $paket?->semester?->nama ?? 'Semester' }}
                                    </span>
                                    <span class="badge bg-light text-secondary border">
                                        Kelas 1–6 SD
                                    </span>
                                </div>
                            </td>

                            {{-- Nominal --}}
                            <td>
                                <div class="fw-bold text-danger fs-5">
                                    Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                                </div>
                            </td>

                            {{-- Waktu Transaksi --}}
                            <td>
                                <div class="text-dark small fw-medium">
                                    {{ \Carbon\Carbon::parse($item->tanggal_pembayaran)->format('d M Y') }}
                                </div>
                                <div class="text-secondary small" style="font-size: 0.75rem;">
                                    {{ \Carbon\Carbon::parse($item->tanggal_pembayaran)->format('H:i') }} WIB
                                </div>
                            </td>

                            {{-- Status --}}
                            <td>
                                @if($item->status === 'berhasil')
                                    <span class="badge bg-success-lt text-success px-2.5 py-1">
                                        <i class="ti ti-check me-1"></i> Lunas
                                    </span>
                                @elseif($item->status === 'menunggu')
                                    <span class="badge bg-warning-lt text-warning px-2.5 py-1">
                                        <i class="ti ti-clock me-1"></i> Menunggu Pembayaran
                                    </span>
                                @else
                                    <span class="badge bg-danger-lt text-danger px-2.5 py-1">
                                        <i class="ti ti-x me-1"></i> Dibatalkan
                                    </span>
                                @endif
                            </td>

                            {{-- Aksi --}}
                            <td>
                                <div class="d-flex justify-content-end align-items-center gap-1">
                                    @if($item->status === 'menunggu')
                                        {{-- Verifikasi Button --}}
                                        <form method="POST" action="{{ route('admin.pembayaran.verifikasi', $item) }}" onsubmit="return confirm('Konfirmasi pelunasan transaksi {{ $orderId }} dan aktifkan masa langganan 12 bulan untuk guru {{ $user?->nama }}?');">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success rounded-pill px-3 shadow-xs" title="Konfirmasi Lunas">
                                                <i class="ti ti-check me-1"></i>Verifikasi
                                            </button>
                                        </form>

                                        {{-- Tolak Button --}}
                                        <form method="POST" action="{{ route('admin.pembayaran.tolak', $item) }}" onsubmit="return confirm('Batalkan transaksi pembayaran ini?');">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-2.5 shadow-xs" title="Batalkan Transaksi">
                                                <i class="ti ti-x"></i>
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-muted small">Selesai</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="text-muted mb-2">
                                    <i class="ti ti-receipt-off fs-1"></i>
                                </div>
                                <div class="fw-bold text-dark">Belum ada transaksi pembayaran</div>
                                <div class="text-secondary small">Seluruh transaksi pembayaran langganan guru akan tampil di halaman ini.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($pembayarans->hasPages())
            <div class="card-footer bg-white border-top py-3 d-flex align-items-center justify-content-between">
                <div class="text-secondary small">
                    Menampilkan <strong>{{ $pembayarans->firstItem() }}</strong> - <strong>{{ $pembayarans->lastItem() }}</strong> dari <strong>{{ $pembayarans->total() }}</strong> transaksi
                </div>
                <div>
                    {{ $pembayarans->links() }}
                </div>
            </div>
        @endif

    </div>

@endsection
