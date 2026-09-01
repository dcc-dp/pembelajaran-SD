<aside class="navbar navbar-vertical navbar-expand-lg">
    <div class="container-fluid">

        {{-- Logo / Brand --}}
        <h1 class="navbar-brand navbar-brand-autodark">
            <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center gap-2">
                <img
                    src="{{ asset('assets/admin/img/logosd.png') }}"
                    alt="SD Learning Center"
                    class="navbar-brand-image"
                    style="height: 36px; width: auto;"
                >
                <span class="fw-bold" style="font-size: 1.1rem; line-height: 1.1;">
                    SD Learning Center
                </span>
            </a>
        </h1>

        {{-- Mobile Toggle --}}
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
            <ul class="navbar-nav pt-lg-3 sidebar-nav-custom">

                {{-- Dashboard --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <x-admin-icon name="dashboard" />
                        </span>
                        <span class="nav-link-title">
                            Dashboard
                        </span>
                    </a>
                </li>

                {{-- Master Data --}}
                <li class="nav-item dropdown">
                    
                      <a  class="nav-link dropdown-toggle {{ request()->routeIs('admin.master-data.*') ? 'active' : '' }}"
                        href="#navbar-master-data"
                        data-bs-toggle="dropdown"
                        data-bs-auto-close="false"
                        role="button"
                        aria-expanded="false"
                    >
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <x-admin-icon name="database" />
                        </span>
                        <span class="nav-link-title">
                            Master Data
                        </span>
                    </a>

                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">
                            Kurikulum
                        </a>

                        <a class="dropdown-item" href="#">
                            Semester
                        </a>

                        <a class="dropdown-item" href="#">
                            Kelas
                        </a>

                        <a class="dropdown-item" href="{{ route('admin.mata-pelajaran.index') }}">
                            Mata Pelajaran
                        </a>

                        <a class="dropdown-item" href="{{ route('admin.kategori-dokumen.index') }}">
                            Kategori Dokumen
                        </a>

                        <a class="dropdown-item" href="{{ route('admin.jenis-dokumen.index') }}">
                            Jenis Dokumen
                        </a>
                    </div>
                </li>

                {{-- Repository --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.repository.*') ? 'active' : '' }}" href="#">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <x-admin-icon name="books" />
                        </span>
                        <span class="nav-link-title">
                            Repository
                        </span>
                    </a>
                </li>

                {{-- Paket Langganan --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.paket-langganan.*') ? 'active' : '' }}" href="#">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <x-admin-icon name="package" />
                        </span>
                        <span class="nav-link-title">
                            Paket Langganan
                        </span>
                    </a>
                </li>

                {{-- Langganan --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.langganan.*') ? 'active' : '' }}" href="#">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <x-admin-icon name="repeat" />
                        </span>
                        <span class="nav-link-title">
                            Langganan
                        </span>
                    </a>
                </li>

                {{-- Pembayaran --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.pembayaran.*') ? 'active' : '' }}" href="#">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <x-admin-icon name="credit-card" />
                        </span>
                        <span class="nav-link-title">
                            Pembayaran
                        </span>
                    </a>
                </li>

                {{-- FAQ --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.faq.*') ? 'active' : '' }}" href="#">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <x-admin-icon name="help-circle" />
                        </span>
                        <span class="nav-link-title">
                            FAQ
                        </span>
                    </a>
                </li>

                {{-- UI Kit (Referensi Komponen — hapus sebelum launching) --}}
                <li class="nav-item mt-3 pt-3 border-top">
                    <a class="nav-link {{ request()->routeIs('admin.ui-kit') ? 'active' : '' }}" href="{{ route('admin.ui-kit') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <x-admin-icon name="package" />
                        </span>
                        <span class="nav-link-title">
                            UI Kit
                        </span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</aside>