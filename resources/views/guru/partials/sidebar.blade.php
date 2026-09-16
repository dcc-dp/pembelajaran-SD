<aside class="navbar navbar-vertical navbar-expand-lg guru-sidebar">
    <div class="container-fluid d-flex flex-column h-100 p-0">

        {{-- Brand / Logo --}}
        <h1 class="navbar-brand w-100 mb-0">
            <a href="{{ route('guru.dashboard.index') }}" class="d-flex align-items-center gap-2 text-decoration-none">
                <img
                    src="{{ asset('assets/admin/img/logosd.png') }}"
                    alt="SD Learning Center Logo"
                    class="rounded-2"
                    style="height: 38px; width: auto; object-fit: contain;"
                >
                <div class="d-flex flex-column text-start">
                    <span class="fw-bold text-dark" style="font-size: 1.05rem; line-height: 1.2; letter-spacing: -0.02em;">
                        SD Learning Center
                    </span>
                    <span class="text-secondary small fw-medium" style="font-size: 0.725rem; letter-spacing: 0.02em;">
                        Elementary Education
                    </span>
                </div>
            </a>
        </h1>

        {{-- Mobile Toggler --}}
        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#guru-sidebar-menu"
            aria-controls="guru-sidebar-menu"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Navigation Menu Container --}}
        <div class="collapse navbar-collapse flex-column align-items-stretch w-100 h-100" id="guru-sidebar-menu">

            {{-- Main Navigation Links --}}
            <nav class="guru-sidebar-nav w-100">
                {{-- 1. Dashboard --}}
                <a href="{{ route('guru.dashboard.index') }}"
                   class="guru-nav-link {{ request()->routeIs('guru.dashboard.*') ? 'active' : '' }}">
                    <i class="ti ti-layout-dashboard"></i>
                    <span>Dashboard</span>
                </a>

                {{-- 2. Repository --}}
                <a href="#" class="guru-nav-link">
                    <i class="ti ti-folder"></i>
                    <span>Repository</span>
                </a>

                {{-- 3. Riwayat Download --}}
                <a href="#" class="guru-nav-link">
                    <i class="ti ti-history"></i>
                    <span>Riwayat Download</span>
                </a>

                {{-- 4. Langganan Saya --}}
                <a href="#" class="guru-nav-link">
                    <i class="ti ti-device-desktop"></i>
                    <span>Langganan Saya</span>
                </a>

                {{-- 5. Profil --}}
                <a href="{{ route('profile.edit') }}" class="guru-nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                    <i class="ti ti-user"></i>
                    <span>Profil</span>
                </a>

                {{-- 6. FAQ --}}
                <a href="#" class="guru-nav-link">
                    <i class="ti ti-help-circle"></i>
                    <span>FAQ</span>
                </a>
            </nav>

            {{-- Push bottom items to bottom --}}
            <div class="mt-auto w-100">

                {{-- CTA Box: Upgrade to Pro / Lihat Paket --}}
                <div class="guru-sidebar-cta">
                    <div class="guru-sidebar-cta-title">Upgrade to Pro</div>
                    <div class="guru-sidebar-cta-desc">Dapatkan akses ribuan modul dan perangkat ajar terlengkap</div>
                    <a href="#" class="btn-sidebar-cta">
                        Lihat Paket
                    </a>
                </div>

                {{-- 7. Logout --}}
                <div class="guru-sidebar-logout">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="guru-logout-btn">
                            <i class="ti ti-logout"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>

            </div>

        </div>

    </div>
</aside>
