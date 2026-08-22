@extends('admin.layouts.admin')

@section('title', 'Mata Pelajaran')

@section('content')

<div class="container-xl">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('success') }}

            <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card mb-4">

        <div class="card-header d-flex align-items-center justify-content-between">

            <h3 class="card-title">
                Mata Pelajaran
            </h3>

            <a href="{{ route('admin.mata-pelajaran.create') }}"
               class="btn btn-primary btn-sm">

                <x-admin-icon name="package" />

                Tambah Data
            </a>

        </div>

        <div class="table-responsive">

            <table class="table table-vcenter card-table" id="simple-datatable-demo">

                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Urutan</th>
                        <th>Status</th>
                        <th class="w-1">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($mataPelajarans as $mataPelajaran)

                        <tr>

                            <td>
                                {{ $mataPelajaran->nama }}
                            </td>

                            <td>
                                {{ $mataPelajaran->urutan }}
                            </td>

                            <td>

                                @if($mataPelajaran->status === 'aktif')

                                    <span class="badge bg-green-lt text-green">
                                        Aktif
                                    </span>

                                @else

                                    <span class="badge bg-red-lt text-red">
                                        Nonaktif
                                    </span>

                                @endif

                            </td>

                            <td>

                                <div class="d-flex gap-1">

                                    {{-- Edit --}}
                                    <a href="{{ route('admin.mata-pelajaran.edit', $mataPelajaran) }}"
                                       class="btn btn-sm btn-outline-primary">

                                        Edit

                                    </a>

                                    <form action="{{ route('admin.mata-pelajaran.destroy', $mataPelajaran) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus mata pelajaran ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-sm btn-outline-danger">

                                            Hapus

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="4" class="text-center text-secondary py-5">
                                Belum ada data mata pelajaran.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection