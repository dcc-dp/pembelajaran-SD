@extends('admin.layouts.admin')

@section('title', 'Dashboard')

@section('page-pretitle', 'Overview')
@section('page-title', 'Dashboard Admin')

@section('content')

    {{-- Welcome Banner --}}
    <div class="card mb-4 admin-welcome-banner">
        <div class="card-body d-flex align-items-center justify-content-between">
            <div>
                <h2 class="mb-1 banner-title">
                    Selamat Datang, {{ auth()->user()->nama }}! 👋
                </h2>
                    <div class="text-secondary">
                        Kelola platform SD Learning Center dengan mudah dan efisien.
                    </div>
            </div>
            <div class="d-none d-md-block">
                <x-admin-icon name="school" class="icon-xl" />
            </div>
        </div>
    </div>

    {{-- Stat Cards --}}
    <div class="row row-deck row-cards">

        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <span class="avatar avatar-md bg-blue-lt me-3">
                            <x-admin-icon name="users" />
                        </span>
                        <div>
                            <div class="subheader">Total Guru</div>
                            <div class="h1 mb-0">0</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <span class="avatar avatar-md bg-orange-lt me-3">
                            <x-admin-icon name="book" />
                        </span>
                        <div>
                            <div class="subheader">Materi</div>
                            <div class="h1 mb-0">0</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <span class="avatar avatar-md bg-green-lt me-3">
                            <x-admin-icon name="credit-card" />
                        </span>
                        <div>
                            <div class="subheader">Langganan Aktif</div>
                            <div class="h1 mb-0">0</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <span class="avatar avatar-md bg-purple-lt me-3">
                            <x-admin-icon name="building" />
                        </span>
                        <div>
                            <div class="subheader">Sekolah</div>
                            <div class="h1 mb-0">0</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection