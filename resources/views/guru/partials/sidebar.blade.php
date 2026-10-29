
<aside class="navbar navbar-vertical navbar-expand-lg guru-sidebar">
    <div class="container-fluid d-flex flex-column h-100 p-0">

        {{-- Brand / Logo --}}
        <h1 class="navbar-brand w-100 mb-0">
            <a href="{{ route('guru.dashboard.index') }}"
               class="d-flex align-items-center gap-2 text-decoration-none">

                <img
                    src="{{ asset('assets/admin/img/logosd.png') }}"
                    alt="Guru Cerdas Logo"
                    class="rounded-2"
                    style="height: 38px; width: auto; object-fit: contain;"
                >

                <div class="d-flex flex-column text-start">
                    <span class="fw-bold text-dark"
                          style="font-size: 1.05rem; line-height: 1.2; letter-spacing: -0.02em;">
                        GuruCerdas
                    </span>

                    <span class="text-secondary small fw-medium"
                          style="font-size: 0.725rem; letter-spacing: 0.02em;">
                        Elementary Mentor
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

        {{-- Navigation Menu --}}
        <div class="collapse navbar-collapse flex-column align-items-stretch w-100 h-100"
             id="guru-sidebar-menu">

            <nav class="guru-sidebar-nav w-100">

                {{-- 1. Dashboard --}}
                <a href="{{ route('guru.dashboard.index') }}"
                   class="guru-nav-link {{ request()->routeIs('guru.dashboard.*') ? 'active' : '' }}">
                    <i class="ti ti-layout-dashboard"></i>
                    <span>Dashboard</span>
                </a>

                {{-- 2. Repository --}}
                <a href="{{ route('guru.repository.index') }}"
                   class="guru-nav-link {{ request()->routeIs('guru.repository.*') ? 'active' : '' }}">
                    <i class="ti ti-layout-grid"></i>
                    <span>Repository</span>
                </a>

                {{-- 3. Riwayat Download --}}
                <a href="{{ route('guru.riwayat-download.index') }}"
                   class="guru-nav-link {{ request()->routeIs('guru.riwayat-download.*') ? 'active' : '' }}">
                    <i class="ti ti-history"></i>
                    <span>History</span>
                </a>

                {{-- 4. Langganan --}}
                <a href="#"
                   class="guru-nav-link">
                    <i class="ti ti-wallet"></i>
                    <span>Subscription</span>
                </a>

                {{-- 5. Profil --}}
                <a href="{{ route('profile.edit') }}"
                   class="guru-nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                    <i class="ti ti-user"></i>
                    <span>Profile</span>
                </a>

                {{-- 6. FAQ --}}
                <a href="{{ route('guest.faq') }}"
                   class="guru-nav-link {{ request()->routeIs('guest.faq') ? 'active' : '' }}">
                    <i class="ti ti-help-circle"></i>
                    <span>FAQ</span>
                </a>

            </nav>

            {{-- Bagian Bawah Sidebar --}}
            <div class="mt-auto w-100">

                {{-- Upgrade to Pro --}}
                <div class="guru-sidebar-cta">
                    <div class="guru-sidebar-cta-title">
                        AKSES TERBATAS
                    </div>

                    <div class="guru-sidebar-cta-desc">
                        Nikmati fitur lengkap dengan akun Premium.
                    </div>

                    <a href="{{ route('guest.paket-langganan') }}"
                       class="btn-sidebar-cta">
                        Upgrade ke Pro
                    </a>
                </div>

                {{-- Logout --}}
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

