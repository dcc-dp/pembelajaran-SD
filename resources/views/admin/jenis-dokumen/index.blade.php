@extends('admin.layouts.admin')

@section('title', 'Jenis Dokumen')
@section('page-title', 'Jenis Dokumen')

@section('content')

    <div class="container-xl">

        {{-- Breadcrumb --}}
        <div class="mb-4 pb-3 border-bottom">

            <nav aria-label="breadcrumb">

                <ol class="breadcrumb mb-0">

                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}"
                            class="text-decoration-none">
                            Dashboard
                        </a>
                    </li>

                    <li class="breadcrumb-item">
                        <a href="#"
                            class="text-decoration-none">
                            Master Data
                        </a>
                    </li>

                    <li class="breadcrumb-item active" aria-current="page">
                        Jenis Dokumen
                    </li>

                </ol>

            </nav>

        </div>


        {{-- Alert Success --}}
        @if(session('success'))

            <div class="alert alert-success alert-dismissible fade show" role="alert">

                {{ session('success') }}

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
                </button>

            </div>

        @endif


        {{-- Alert Danger --}}
        @if(session('danger'))

            <div class="alert alert-danger alert-dismissible fade show" role="alert">

                {{ session('danger') }}

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
                </button>

            </div>

        @endif


        {{-- Card --}}
        <div class="card mb-4">

            {{-- Card Header --}}
            <div class="card-header d-flex align-items-center justify-content-between">

                <h3 class="card-title">
                    Jenis Dokumen
                </h3>


                <a
                    href="{{ route('admin.jenis-dokumen.create') }}"
                    class="btn btn-primary btn-sm">

                    <x-admin-icon name="package" />

                    Tambah Data

                </a>

            </div>


            {{-- Table --}}
            <div class="table-responsive">

                <table
                    class="table table-vcenter card-table"
                    id="simple-datatable-demo">

                    <thead>

                        <tr>

                            <th>Kategori Dokumen</th>

                            <th>Nama</th>

                            <th>Deskripsi</th>

                            <th>Urutan</th>

                            <th>Status</th>

                            <th class="w-1">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($jenisDokumens as $jenisDokumen)

                            <tr>

                                {{-- Kategori Dokumen --}}
                                <td>

                                    {{ $jenisDokumen->kategoriDokumen->nama ?? '-' }}

                                </td>


                                {{-- Nama --}}
                                <td>

                                    {{ $jenisDokumen->nama }}

                                </td>


                                {{-- Deskripsi --}}
                                <td>

                                    @if($jenisDokumen->deskripsi)

                                        {{ $jenisDokumen->deskripsi }}

                                    @else

                                        <span class="text-secondary">
                                            -
                                        </span>

                                    @endif

                                </td>


                                {{-- Urutan --}}
                                <td>

                                    {{ $jenisDokumen->urutan }}

                                </td>


                                {{-- Status --}}
                                <td>

                                    @if($jenisDokumen->status === 'aktif')

                                        <span class="badge bg-green-lt text-green">

                                            Aktif

                                        </span>

                                    @else

                                        <span class="badge bg-red-lt text-red">

                                            Nonaktif

                                        </span>

                                    @endif

                                </td>


                                {{-- Aksi --}}
                                <td>

                                    <div class="d-flex gap-1">

                                        {{-- Edit --}}
                                        <a
                                            href="{{ route(
                                                'admin.jenis-dokumen.edit',
                                                $jenisDokumen
                                            ) }}"
                                            class="btn btn-sm btn-outline-primary">

                                            Edit

                                        </a>


                                        {{-- Hapus --}}
                                        <form
                                            action="{{ route(
                                                'admin.jenis-dokumen.destroy',
                                                $jenisDokumen
                                            ) }}"
                                            method="POST"
                                            onsubmit="return confirm('Data ini akan dihapus permanen.')"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-outline-danger">

                                                Hapus

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="6"
                                    class="text-center text-secondary py-5">

                                    Belum ada data jenis dokumen.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    {{-- Assets Simple-DataTables --}}
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css">

    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest"></script>


    <script>

        document.addEventListener("DOMContentLoaded", function () {

            const table = document.querySelector(
                "#simple-datatable-demo"
            );

            if (table) {

                new simpleDatatables.DataTable(table, {

                    searchable: true,

                    perPage: 5,

                    labels: {

                        placeholder: "Cari jenis dokumen...",

                        perPage: "{select} data per halaman",

                        noRows: "Tidak ada data ditemukan",

                        info: "Menampilkan {start} - {end} dari {rows} data",

                    }

                });

            }

        });

    </script>

@endsection