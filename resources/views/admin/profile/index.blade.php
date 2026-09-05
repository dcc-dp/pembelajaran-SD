@extends('admin.layouts.admin')

@section('title', 'Profil Admin')
@section('page-title', 'Profil Admin')
@section('page-pretitle', 'Dashboard')

@section('content')

    {{-- Breadcrumb --}}
    <div class="mb-4 pb-3 border-bottom">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}" class="text-secondary text-decoration-none">Dashboard</a>
                </li>
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">
                    Profil Admin
                </li>
            </ol>
        </nav>
        <p class="text-secondary small mt-2 mb-0">
            Kelola informasi akun dan data profil administrator.
        </p>
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

    {{-- Alert Error / Validation Summary --}}
    @if($errors->any() || session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
            <div class="d-flex">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alert-circle text-danger me-2 flex-shrink-0" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                    <path d="M12 8l0 4" />
                    <path d="M12 16l.01 0" />
                </svg>
                <div>
                    <strong>Profil gagal diperbarui. Silakan periksa kembali data yang dimasukkan:</strong>
                    <ul class="mb-0 mt-1 ps-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
        </div>
    @endif

    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-4">

            {{-- Kolom Kiri: Card Foto Profil --}}
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 rounded-3 text-center">
                    <div class="card-header bg-white py-3 border-bottom text-start">
                        <h3 class="card-title fw-bold text-dark mb-0">
                            Foto Profil
                        </h3>
                    </div>
                    <div class="card-body p-4">

                        {{-- Avatar Preview --}}
                        <div class="mb-3 position-relative d-inline-block">
                            <img
                                id="avatar-preview"
                                src="{{ $user->foto_url }}"
                                alt="{{ $user->nama }}"
                                class="rounded-circle border shadow-sm"
                                style="width: 130px; height: 130px; object-fit: cover;"
                            >
                        </div>

                        <h3 class="fw-bold text-dark mb-1">
                            {{ $user->nama }}
                        </h3>

                        <div>
                            <span class="badge bg-danger-subtle text-danger rounded-pill px-3 py-1 fw-bold fs-6">
                                {{ $user->roles->first()?->name ?? 'Super Admin' }}
                            </span>
                        </div>

                        <div class="text-secondary small mt-2">
                            {{ $user->email }}
                        </div>

                        <div class="mt-4 pt-3 border-top">
                            {{-- Hidden file input --}}
                            <input
                                type="file"
                                name="foto"
                                id="foto-input"
                                class="d-none @error('foto') is-invalid @enderror"
                                accept="image/jpeg,image/png,image/jpg,image/webp"
                            >

                            <button
                                type="button"
                                class="btn btn-outline-primary rounded-pill px-4"
                                onclick="document.getElementById('foto-input').click();"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-photo-up me-1" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M15 8h.01" />
                                    <path d="M12.5 21h-6.5a3 3 0 0 1 -3 -3v-12a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v6.5" />
                                    <path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l3.5 3.5" />
                                    <path d="M14 14l1 -1c.679 -.653 1.473 -.829 2.214 -.526" />
                                    <path d="M19 22v-6" />
                                    <path d="M22 19l-3 -3l-3 3" />
                                </svg>
                                Ubah Foto
                            </button>

                            @error('foto')
                                <div class="invalid-feedback d-block mt-2">
                                    {{ $message }}
                                </div>
                            @enderror

                            <p class="text-secondary small mt-2 mb-0" style="font-size: 0.8rem;">
                                Format: JPG, JPEG, PNG, WEBP.<br>Maksimal ukuran file: 2 MB.
                            </p>
                        </div>

                    </div>
                </div>
            </div>

            {{-- Kolom Kanan: Form Data & Keamanan --}}
            <div class="col-lg-8">

                {{-- Section 1: Informasi Akun --}}
                <div class="card shadow-sm border-0 rounded-3 mb-4">
                    <div class="card-header bg-white py-3 border-bottom">
                        <div class="d-flex align-items-center gap-2">
                            <div class="avatar avatar-xs bg-primary-subtle text-primary rounded-circle">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                </svg>
                            </div>
                            <h3 class="card-title fw-bold text-dark mb-0">
                                Informasi Akun
                            </h3>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <div class="row g-3">

                            {{-- Nama Lengkap --}}
                            <div class="col-md-12">
                                <label class="form-label required fw-bold">
                                    Nama Lengkap
                                </label>
                                <input
                                    type="text"
                                    name="nama"
                                    value="{{ old('nama', $user->nama) }}"
                                    class="form-control @error('nama') is-invalid @enderror"
                                    placeholder="Masukkan nama lengkap..."
                                    required
                                >
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div class="col-md-6">
                                <label class="form-label required fw-bold">
                                    Email
                                </label>
                                <input
                                    type="email"
                                    name="email"
                                    value="{{ old('email', $user->email) }}"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="admin@sdlearningcenter.com"
                                    required
                                >
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- No. HP --}}
                            <div class="col-md-6">
                                <label class="form-label fw-bold">
                                    No. HP
                                </label>
                                <input
                                    type="text"
                                    name="no_hp"
                                    value="{{ old('no_hp', $user->no_hp) }}"
                                    class="form-control @error('no_hp') is-invalid @enderror"
                                    placeholder="Contoh: 081234567890"
                                >
                                @error('no_hp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Role (Read-only) --}}
                            <div class="col-md-12">
                                <label class="form-label fw-bold">
                                    Role
                                </label>
                                <input
                                    type="text"
                                    class="form-control bg-light text-secondary"
                                    value="{{ $user->roles->first()?->name ?? 'Super Admin' }}"
                                    readonly
                                    disabled
                                >
                                <small class="form-hint text-secondary">
                                    Role pengguna bersifat informasi dan hanya dapat dikelola melalui manajemen hak akses.
                                </small>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Section 2: Keamanan Akun --}}
                <div class="card shadow-sm border-0 rounded-3 mb-4">
                    <div class="card-header bg-white py-3 border-bottom">
                        <div class="d-flex align-items-center gap-2">
                            <div class="avatar avatar-xs bg-warning-subtle text-warning rounded-circle">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-lock" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M5 11m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z" />
                                    <path d="M8 11v-4a4 4 0 0 1 8 0v4" />
                                </svg>
                            </div>
                            <h3 class="card-title fw-bold text-dark mb-0">
                                Keamanan Akun
                            </h3>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <div class="alert alert-light border small text-secondary mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-circle me-1" width="16" height="16" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                                <path d="M12 9h.01" />
                                <path d="M11 12h1v4h1" />
                            </svg>
                            Kosongkan seluruh bidang kata sandi di bawah ini jika Anda tidak ingin mengubah password akun Anda saat ini.
                        </div>

                        <div class="row g-3">

                            {{-- Password Saat Ini --}}
                            <div class="col-md-12">
                                <label class="form-label fw-bold">
                                    Password Saat Ini
                                </label>
                                <input
                                    type="password"
                                    name="current_password"
                                    class="form-control @error('current_password') is-invalid @enderror"
                                    placeholder="Masukkan password saat ini jika ingin mengganti password"
                                    autocomplete="current-password"
                                >
                                @error('current_password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Password Baru --}}
                            <div class="col-md-6">
                                <label class="form-label fw-bold">
                                    Password Baru
                                </label>
                                <input
                                    type="password"
                                    name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Minimal 8 karakter"
                                    autocomplete="new-password"
                                >
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Konfirmasi Password Baru --}}
                            <div class="col-md-6">
                                <label class="form-label fw-bold">
                                    Konfirmasi Password Baru
                                </label>
                                <input
                                    type="password"
                                    name="password_confirmation"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    placeholder="Ulangi password baru"
                                    autocomplete="new-password"
                                >
                                @error('password_confirmation')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Action Bar --}}
                <div class="d-flex justify-content-end gap-2 mb-5">
                    <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check me-1" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M5 12l5 5l10 -10" />
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>

            </div>

        </div>

    </form>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const fotoInput = document.getElementById('foto-input');
        const avatarPreview = document.getElementById('avatar-preview');

        if (fotoInput && avatarPreview) {
            fotoInput.addEventListener('change', function (e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (event) {
                        avatarPreview.src = event.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    });
</script>
@endpush
