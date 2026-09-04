<header class="navbar navbar-expand-md d-print-none bg-white border-bottom">
    <div class="container-xl">

        {{-- Mobile Sidebar Toggle --}}
        <button
            class="navbar-toggler d-lg-none"
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
        <div class="navbar-nav flex-row order-md-last ms-auto align-items-center gap-2">

            {{-- Search --}}
            <div class="nav-item me-2 d-none d-md-flex">
                <div class="input-icon navbar-search-box">
                    <span class="input-icon-addon">
                        <i class="ti ti-search text-muted"></i>
                    </span>
                    <input type="text" class="form-control rounded-pill bg-light border-0 px-4" style="padding-left: 2.4rem !important;" placeholder="Cari data, materi, transaksi...">
                </div>
            </div>

            {{-- Theme Toggle --}}
            <div class="nav-item">
                <a href="#" class="nav-link px-2 text-secondary" id="theme-toggle-btn" aria-label="Ganti tema" title="Ganti Tema">
                    <span id="theme-icon-light">
                        <i class="ti ti-sun fs-2"></i>
                    </span>
                    <span id="theme-icon-dark" class="d-none">
                        <i class="ti ti-moon fs-2"></i>
                    </span>
                </a>
            </div>

            {{-- Notifikasi --}}
            <div class="nav-item">
                <a href="#" class="nav-link px-2 text-secondary position-relative" aria-label="Notifikasi" title="Notifikasi">
                    <i class="ti ti-bell fs-2"></i>
                    @if(($totalNotifikasi ?? 0) > 0)
                        <span class="badge bg-danger position-absolute top-0 start-100 translate-middle p-1 rounded-circle"></span>
                    @endif
                </a>
            </div>

            <div class="vr mx-1 my-2 text-secondary opacity-25 d-none d-sm-block"></div>

            {{-- User Dropdown --}}
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0 align-items-center" data-bs-toggle="dropdown" aria-label="Open user menu">
                    <span class="avatar avatar-sm rounded-circle shadow-sm" style="background-image: url('{{ asset('assets/admin/img/user.jpg') }}')"></span>

                    <div class="d-none d-xl-block ps-2 text-start">
                        <div class="fw-semibold text-dark fs-5" style="line-height: 1.2;">
                            {{ auth()->user()->nama ?? auth()->user()->name ?? 'Super Admin' }}
                        </div>
                        <div class="small text-muted" style="font-size: 0.75rem;">
                            Super Admin
                        </div>
                    </div>
                </a>

                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow shadow-sm border-0 rounded-3 mt-2">
                    <div class="dropdown-header text-uppercase text-secondary fw-bold" style="font-size: 0.7rem; letter-spacing: 0.05em;">
                        Akun Admin
                    </div>

                    <a href="{{ route('profile.edit') }}" class="dropdown-item py-2">
                        <i class="ti ti-user me-2 text-muted"></i>
                        Profil Saya
                    </a>

                    <div class="dropdown-divider my-1"></div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item py-2 text-danger">
                            <i class="ti ti-logout me-2"></i>
                            Keluar
                        </button>
                    </form>
                </div>
            </div>

        </div>

    </div>
</header>