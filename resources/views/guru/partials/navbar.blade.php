<header class="navbar navbar-expand-md d-print-none guru-navbar">
    <div class="container-fluid d-flex align-items-center justify-content-between p-0">

        {{-- Mobile Sidebar Toggle Button --}}
        <button
            class="navbar-toggler d-lg-none"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#guru-sidebar-menu"
            aria-controls="guru-sidebar-menu"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Search Bar UI --}}
        <div class="guru-search-box d-none d-sm-block">
            <i class="ti ti-search"></i>
            <input
                type="text"
                class="guru-search-input"
                placeholder="Cari modul ajar, LKPD..."
                aria-label="Cari perangkat ajar"
            >
        </div>

        {{-- Right Side Actions --}}
        <div class="d-flex align-items-center gap-2 ms-auto">

            {{-- Notification Icon --}}
            <a href="#" class="guru-icon-btn" title="Notifikasi" aria-label="Notifikasi">
                <i class="ti ti-bell fs-2"></i>
                <span class="guru-notification-dot"></span>
            </a>

            {{-- Settings Icon --}}
            <a href="#" class="guru-icon-btn" title="Pengaturan" aria-label="Pengaturan">
                <i class="ti ti-settings fs-2"></i>
            </a>

            <div class="vr mx-1 my-2 text-secondary opacity-25 d-none d-sm-block"></div>

            {{-- User Profile Dropdown --}}
            <div class="dropdown">
                <a href="#" class="guru-user-profile dropdown-toggle text-decoration-none" data-bs-toggle="dropdown" aria-expanded="false">
                    <img
                        src="{{ auth()->user()?->foto_url ?? asset('assets/admin/img/user.jpg') }}"
                        alt="Foto Profil"
                        class="guru-avatar"
                    >
                    <div class="d-none d-md-block text-start lh-1">
                        <div class="fw-bold text-dark" style="font-size: 0.875rem;">
                            {{ auth()->user()?->nama ?? 'Al Fina' }}
                        </div>
                        <div class="text-secondary small mt-1" style="font-size: 0.725rem;">
                            {{ auth()->user()?->nama_sekolah ?? 'SDN 01 Menteng' }}
                        </div>
                    </div>
                </a>

                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3 mt-2">
                    <li class="dropdown-header text-uppercase text-secondary fw-bold" style="font-size: 0.675rem; letter-spacing: 0.05em;">
                        Akun Guru
                    </li>
                    <li>
                        <a class="dropdown-item py-2" href="{{ route('profile.edit') }}">
                            <i class="ti ti-user me-2 text-muted"></i>
                            Profil Saya
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item py-2" href="#">
                            <i class="ti ti-help-circle me-2 text-muted"></i>
                            Bantuan & FAQ
                        </a>
                    </li>
                    <li><hr class="dropdown-divider my-1"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item py-2 text-danger">
                                <i class="ti ti-logout me-2"></i>
                                Keluar
                            </button>
                        </form>
                    </li>
                </ul>
            </div>

        </div>

    </div>
</header>
