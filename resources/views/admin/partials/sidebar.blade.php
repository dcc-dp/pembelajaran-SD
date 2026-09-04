<aside class="navbar navbar-vertical navbar-expand-lg navbar-light bg-white border-end">
    <div class="container-fluid">

        {{-- Logo / Brand --}}
        <h1 class="navbar-brand navbar-brand-autodark px-2 py-3 mb-0">
            <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center gap-2 text-decoration-none">
                <img
                    src="{{ asset('assets/admin/img/logosd.png') }}"
                    alt="SD Learning Center Logo"
                    class="navbar-brand-image rounded-2"
                    style="height: 38px; width: auto; object-fit: contain;"
                >
                <div class="d-flex flex-column text-start">
                    <span class="fw-bold text-dark" style="font-size: 1.05rem; line-height: 1.2; letter-spacing: -0.02em;">
                        SD Learning Center
                    </span>
                    <span class="text-secondary small fw-medium" style="font-size: 0.725rem; letter-spacing: 0.02em;">
                        Admin Management
                    </span>
                </div>
            </a>
        </h1>

        {{-- Mobile Toggle Button --}}
        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#sidebar-menu"
            aria-controls="sidebar-menu"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Sidebar Menu --}}
        <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav pt-lg-2 sidebar-nav-custom">

                <li class="nav-item-header text-uppercase text-secondary fw-bold px-3 pt-3 pb-1" style="font-size: 0.675rem; letter-spacing: 0.06em;">
                    Utama
                </li>

                {{-- Dashboard --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                        <span class="nav-link-icon">
                            <i class="ti ti-layout-dashboard fs-2"></i>
                        </span>
                        <span class="nav-link-title">
                            Dashboard
                        </span>
                    </a>
                </li>

                <li class="nav-item-header text-uppercase text-secondary fw-bold px-3 pt-3 pb-1" style="font-size: 0.675rem; letter-spacing: 0.06em;">
                    Manajemen Data
                </li>

                @php
                    $isMasterDataActive = request()->routeIs('admin.mata-pelajaran.*') || request()->routeIs('admin.kategori-dokumen.*') || request()->routeIs('admin.master-data.*');
                @endphp

                {{-- Master Data --}}
                <li class="nav-item dropdown {{ $isMasterDataActive ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle {{ $isMasterDataActive ? 'active show' : '' }}"
                        href="#navbar-master-data"
                        data-bs-toggle="dropdown"
                        data-bs-auto-close="false"
                        role="button"
                        aria-expanded="{{ $isMasterDataActive ? 'true' : 'false' }}"
                    >
                        <span class="nav-link-icon">
                            <i class="ti ti-database fs-2"></i>
                        </span>
                        <span class="nav-link-title">
                            Master Data
                        </span>
                    </a>

                    <div class="dropdown-menu {{ $isMasterDataActive ? 'show' : '' }} border-0 ps-3">
                        <a class="dropdown-item py-2" href="#">
                            <span class="dropdown-item-dot me-2"></span>
                            Kurikulum
                        </a>

                        <a class="dropdown-item py-2" href="#">
                            <span class="dropdown-item-dot me-2"></span>
                            Semester
                        </a>

                        <a class="dropdown-item py-2" href="#">
                            <span class="dropdown-item-dot me-2"></span>
                            Kelas
                        </a>

                        <a class="dropdown-item py-2 {{ request()->routeIs('admin.mata-pelajaran.*') ? 'active fw-bold' : '' }}" href="{{ route('admin.mata-pelajaran.index') }}">
                            <span class="dropdown-item-dot me-2"></span>
                            Mata Pelajaran
                        </a>

                        <a class="dropdown-item py-2 {{ request()->routeIs('admin.kategori-dokumen.*') ? 'active fw-bold' : '' }}" href="{{ route('admin.kategori-dokumen.index') }}">
                            <span class="dropdown-item-dot me-2"></span>
                            Kategori Dokumen
                        </a>

                        <a class="dropdown-item py-2" href="#">
                            <span class="dropdown-item-dot me-2"></span>
                            Jenis Dokumen
                        </a>
                    </div>
                </li>

                {{-- Repository --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.repository.*') ? 'active' : '' }}" href="#">
                        <span class="nav-link-icon">
                            <i class="ti ti-books fs-2"></i>
                        </span>
                        <span class="nav-link-title">
                            Repository
                        </span>
                    </a>
                </li>

                <li class="nav-item-header text-uppercase text-secondary fw-bold px-3 pt-3 pb-1" style="font-size: 0.675rem; letter-spacing: 0.06em;">
                    Layanan & Langganan
                </li>

                {{-- Paket Langganan --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.paket-langganan.*') ? 'active' : '' }}"
                        href="{{ route('admin.paket-langganan.index') }}">
                        <span class="nav-link-icon">
                            <i class="ti ti-package fs-2"></i>
                        </span>
                        <span class="nav-link-title">
                            Paket Langganan
                        </span>
                    </a>
                </li>

                {{-- Langganan --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.langganan.*') ? 'active' : '' }}" href="#">
                        <span class="nav-link-icon">
                            <i class="ti ti-repeat fs-2"></i>
                        </span>
                        <span class="nav-link-title">
                            Langganan
                        </span>
                    </a>
                </li>

                {{-- Pembayaran --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.pembayaran.*') ? 'active' : '' }}" href="#">
                        <span class="nav-link-icon">
                            <i class="ti ti-credit-card fs-2"></i>
                        </span>
                        <span class="nav-link-title">
                            Pembayaran
                        </span>
                    </a>
                </li>

                <li class="nav-item-header text-uppercase text-secondary fw-bold px-3 pt-3 pb-1" style="font-size: 0.675rem; letter-spacing: 0.06em;">
                    Pusat Bantuan
                </li>

                {{-- FAQ --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.faq.*') ? 'active' : '' }}" href="#">
                        <span class="nav-link-icon">
                            <i class="ti ti-help-circle fs-2"></i>
                        </span>
                        <span class="nav-link-title">
                            FAQ
                        </span>
                    </a>
                </li>

                {{-- UI Kit --}}
                <li class="nav-item mt-3 pt-3 border-top">
                    <a class="nav-link {{ request()->routeIs('admin.ui-kit') ? 'active' : '' }}" href="{{ route('admin.ui-kit') }}">
                        <span class="nav-link-icon">
                            <i class="ti ti-components fs-2 text-warning"></i>
                        </span>
                        <span class="nav-link-title">
                            UI Kit
                        </span>
                        <span class="badge bg-warning-subtle text-warning ms-auto rounded-pill px-2" style="font-size: 0.65rem;">Dev</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</aside>