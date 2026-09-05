<header class="navbar navbar-expand-md d-print-none">
    <div class="container-xl">

        {{-- Mobile Sidebar Toggle --}}
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

        {{-- Right side: search, theme toggle, notif, user --}}
        <div class="navbar-nav flex-row order-md-last ms-auto align-items-center">

            {{-- Search --}}
            <div class="nav-item me-3 d-none d-md-flex">
                <div class="input-icon navbar-search-box">
                    <span class="input-icon-addon">
                        <x-admin-icon name="search" />
                    </span>
                    <input type="text" class="form-control" placeholder="Cari guru, sekolah, transaksi...">
                </div>
            </div>

            {{-- Theme Toggle --}}
            <div class="nav-item me-3">
                <a href="#" class="nav-link px-0" id="theme-toggle-btn" aria-label="Ganti tema">
                    <span id="theme-icon-light">
                        <x-admin-icon name="sun" />
                    </span>
                    <span id="theme-icon-dark" class="d-none">
                        <x-admin-icon name="moon" />
                    </span>
                </a>
            </div>

            {{-- Notifikasi --}}
            <div class="nav-item me-3">
                <a href="#" class="nav-link px-0 position-relative" aria-label="Notifikasi">
                    <x-admin-icon name="bell" />
                    @if(($totalNotifikasi ?? 0) > 0)
                        <span class="badge bg-red position-absolute top-0 start-100 translate-middle p-1 rounded-circle"></span>
                    @endif
                </a>
            </div>

            {{-- User --}}
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                    <span class="avatar avatar-sm rounded-circle" style="background-image: url('{{ auth()->user()->foto_url }}')"></span>

                    <div class="d-none d-xl-block ps-2">
                        <div class="fw-semibold text-dark">{{ auth()->user()->nama ?? auth()->user()->name }}</div>
                        <div class="mt-1 small text-secondary">
                            {{ auth()->user()->roles->first()?->name ?? 'Super Admin' }}
                        </div>
                    </div>
                </a>

                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow shadow-sm border-0">
                    <div class="dropdown-header text-uppercase text-secondary fw-bold" style="font-size: 0.675rem; letter-spacing: 0.05em;">
                        Akun Admin
                    </div>

                    <a href="{{ route('admin.profile') }}" class="dropdown-item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user me-2 text-secondary" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                        </svg>
                        Profil Saya
                    </a>

                    <div class="dropdown-divider"></div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit" class="dropdown-item text-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout me-2 text-danger" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                                <path d="M9 12h12l-3 -3" />
                                <path d="M18 15l3 -3" />
                            </svg>
                            Keluar
                        </button>
                    </form>

                </div>
            </div>
        </div>

    </div>
</header>