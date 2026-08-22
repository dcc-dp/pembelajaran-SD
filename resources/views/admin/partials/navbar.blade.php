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
                    <span class="avatar avatar-sm" style="background-image: url('{{ asset('assets/admin/img/user.jpg') }}')"></span>

                    <div class="d-none d-xl-block ps-2">
                        <div>{{ auth()->user()->name }}</div>
                        <div class="mt-1 small text-secondary">
                            Super Admin
                        </div>
                    </div>
                </a>

                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">

                    <a href="#" class="dropdown-item">
                        <i class="ti ti-user me-2"></i>
                        Profil
                    </a>

                    <div class="dropdown-divider"></div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit" class="dropdown-item">
                            <i class="ti ti-logout me-2"></i>
                            Keluar
                        </button>
                    </form>

                </div>
            </div>
        </div>

    </div>
</header>