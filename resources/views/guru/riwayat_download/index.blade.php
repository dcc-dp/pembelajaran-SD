
@extends('guru.layouts.guru')

@section('title', 'Riwayat Download')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/guru/css/riwayat-download.css') }}">
@endpush

@section('content')
<div class="history-page">

    {{-- Breadcrumb --}}
    <nav class="history-breadcrumb" aria-label="Breadcrumb">
        <a href="{{ route('guru.dashboard.index') }}">Dashboard</a>
        <i class="ti ti-chevron-right"></i>
        <span class="current">Riwayat Download</span>
    </nav>

    {{-- Judul Halaman --}}
    <div class="history-header">
        <h1 class="history-heading">Riwayat Download</h1>
        <p class="history-description">
            Lihat seluruh perangkat ajar yang pernah Anda unduh
            dan unduh kembali kapan saja.
        </p>
    </div>

    {{-- Filter Pencarian --}}
    <div class="history-panel">
        <form action="{{ route('guru.riwayat-download.index') }}"
              method="GET"
              class="history-filter">

            <div class="history-filter-grid">

                {{-- Pencarian --}}
                <div class="history-field">
                    <label for="search">Pencarian</label>

                    <div class="history-input-wrap">
                        <i class="ti ti-search"></i>

                        <input
                            type="text"
                            id="search"
                            name="search"
                            class="history-input"
                            placeholder="Cari judul perangkat ajar..."
                            value="{{ request('search') }}"
                        >
                    </div>
                </div>

                {{-- Semester --}}
                <div class="history-field">
                    <label for="semester_id">Semester</label>

                    <select name="semester_id"
                            id="semester_id"
                            class="history-select">

                        <option value="">Semua</option>

                        @foreach ($semesters as $semester)
                            <option value="{{ $semester->id }}"
                                @selected((string) request('semester_id') === (string) $semester->id)>
                                {{ $semester->nama ?? 'Semester '.$semester->urutan }}
                            </option>
                        @endforeach

                    </select>
                </div>

                {{-- Kelas --}}
                <div class="history-field">
                    <label for="kelas_id">Kelas</label>

                    <select name="kelas_id"
                            id="kelas_id"
                            class="history-select">

                        <option value="">Semua Kelas</option>

                        @foreach ($kelas as $itemKelas)
                            <option value="{{ $itemKelas->id }}"
                                @selected((string) request('kelas_id') === (string) $itemKelas->id)>
                                {{ $itemKelas->nama ?? 'Kelas '.$itemKelas->urutan }}
                            </option>
                        @endforeach

                    </select>
                </div>

                {{-- Mata Pelajaran --}}
                <div class="history-field">
                    <label for="mata_pelajaran_id">Mata Pelajaran</label>

                    <select name="mata_pelajaran_id"
                            id="mata_pelajaran_id"
                            class="history-select">

                        <option value="">Semua Mapel</option>

                        @foreach ($mataPelajarans as $mapel)
                            <option value="{{ $mapel->id }}"
                                @selected((string) request('mata_pelajaran_id') === (string) $mapel->id)>
                                {{ $mapel->nama }}
                            </option>
                        @endforeach

                    </select>
                </div>

                {{-- Jenis Dokumen --}}
                <div class="history-field">
                    <label for="jenis_dokumen_id">Jenis Dokumen</label>

                    <select name="jenis_dokumen_id"
                            id="jenis_dokumen_id"
                            class="history-select">

                        <option value="">Semua Jenis</option>

                        @foreach ($jenisDokumens as $jenis)
                            <option value="{{ $jenis->id }}"
                                @selected((string) request('jenis_dokumen_id') === (string) $jenis->id)>
                                {{ $jenis->nama }}
                            </option>
                        @endforeach

                    </select>
                </div>

            </div>

            {{-- Tombol Filter --}}
            <div class="history-filter-actions">

                <a href="{{ route('guru.riwayat-download.index') }}"
                   class="history-btn history-btn-reset">
                    Reset Filter
                </a>

                <button type="submit"
                        class="history-btn history-btn-search">
                    <i class="ti ti-search"></i>
                    Cari
                </button>

            </div>
        </form>
    </div>

    {{-- Tabel Riwayat Download --}}
    <div class="history-panel">

        <div class="history-table-wrap">
            <table class="history-table">

                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Judul Dokumen</th>
                        <th>Semester</th>
                        <th>Kelas</th>
                        <th>Mata Pelajaran</th>
                        <th>Jenis</th>
                        <th>Tgl Download</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($riwayatUnduhan as $riwayat)

                        @php
                            $dokumen = $riwayat->repository;

                            $warnaIkon = match (strtolower($dokumen?->tipe_file ?? '')) {
                                'pdf' => 'pdf',
                                'doc', 'docx' => 'blue',
                                'xls', 'xlsx' => 'green',
                                'ppt', 'pptx' => 'orange',
                                default => 'purple',
                            };

                            $ikon = match ($warnaIkon) {
                                'pdf' => 'ti-file-type-pdf',
                                'blue' => 'ti-file-text',
                                'green' => 'ti-file-spreadsheet',
                                'orange' => 'ti-book',
                                default => 'ti-file-description',
                            };
                        @endphp

                        <tr>
                            {{-- Nomor --}}
                            <td class="history-number">
                                {{ str_pad(
                                    (string) ($riwayatUnduhan->firstItem() + $loop->index),
                                    2,
                                    '0',
                                    STR_PAD_LEFT
                                ) }}
                            </td>

                            {{-- Judul Dokumen --}}
                            <td>
                                <div class="history-document">

                                    <span class="history-document-icon {{ $warnaIkon }}">
                                        <i class="ti {{ $ikon }}"></i>
                                    </span>

                                    <span class="history-document-name">
                                        {{ $dokumen?->judul ?? 'Materi tidak tersedia' }}
                                    </span>

                                </div>
                            </td>

                            {{-- Semester --}}
                            <td>
                                @if ($dokumen?->semester)
                                    {{ $dokumen->semester->nama
                                        ?? 'Semester '.$dokumen->semester->urutan }}
                                @else
                                    -
                                @endif
                            </td>

                            {{-- Kelas --}}
                            <td>
                                @if ($dokumen?->kelas)
                                    <span class="history-class">
                                        Kelas {{ $dokumen->kelas->urutan
                                            ?? $dokumen->kelas->nama }}
                                    </span>
                                @else
                                    -
                                @endif
                            </td>

                            {{-- Mata Pelajaran --}}
                            <td>
                                {{ $dokumen?->mataPelajaran?->nama ?? '-' }}
                            </td>

                            {{-- Jenis Dokumen --}}
                            <td>
                                {{ $dokumen?->jenisDokumen?->nama ?? '-' }}
                            </td>

                            {{-- Tanggal Download --}}
                            <td class="history-date">
                                {{ $riwayat->created_at
                                    ? $riwayat->created_at->format('d M Y')
                                    : '-' }}
                            </td>

                            {{-- Unduh Kembali --}}
                            <td>
                                @if ($dokumen && $dokumen->file)
                                    <a
                                        href="{{ route('guru.repository.download', $dokumen->id) }}"
                                        class="history-download-btn"
                                        title="Unduh kembali dokumen"
                                        aria-label="Unduh kembali dokumen"
                                    >
                                        <i class="ti ti-download"></i>
                                    </a>
                                @else
                                    <span class="history-download-btn history-download-disabled"
                                          title="Berkas tidak tersedia">
                                        <i class="ti ti-download"></i>
                                    </span>
                                @endif
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="8" class="history-empty">

                                <i class="ti ti-history"></i>

                                <h3>Belum Ada Riwayat Download</h3>

                                <p>
                                    Materi yang berhasil kamu unduh
                                    akan muncul di halaman ini.
                                </p>

                                <a href="{{ route('guru.repository.index') }}"
                                   class="history-btn history-btn-search">
                                    <i class="ti ti-folder"></i>
                                    Jelajahi Repository
                                </a>

                            </td>
                        </tr>

                    @endforelse
                </tbody>

            </table>
        </div>

        {{-- Footer Tabel --}}
        <div class="history-footer">

            <div class="history-footer-text">
                @if ($riwayatUnduhan->total() > 0)
                    Menampilkan
                    {{ $riwayatUnduhan->firstItem() }}–{{ $riwayatUnduhan->lastItem() }}
                    dari {{ $riwayatUnduhan->total() }} dokumen
                @else
                    Tidak ada dokumen yang ditemukan
                @endif
            </div>

            {{-- Pagination --}}
            @if ($riwayatUnduhan->hasPages())
                <div class="history-pagination">
                    {{ $riwayatUnduhan->onEachSide(1)->links() }}
                </div>
            @endif

        </div>

    </div>

</div>
@endsection
