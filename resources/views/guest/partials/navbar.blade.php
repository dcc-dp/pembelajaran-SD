<header class="sticky-top guest-navbar">
    <div class="container-xl">
        <div class="d-flex align-items-center justify-content-between py-2 py-md-3">

            {{-- Brand / Logo --}}
            <a href="{{ route('guest.home') }}" class="d-flex align-items-center gap-2 text-decoration-none">
                <img
                    src="{{ asset('assets/admin/img/logosd.png') }}"
                    alt="SD Learning Center Logo"
                    class="rounded-1"
                    style="height: 32px; width: auto; object-fit: contain;"
                >
                <span class="fw-bold text-dark d-none d-sm-inline" style="font-size: 1.05rem; letter-spacing: -0.01em;">
                    SD LEARNING CENTER
                </span>
            </a>

            {{-- Desktop Navigation Links --}}
            <nav class="d-none d-lg-flex align-items-center gap-1">
                <a href="{{ route('guest.home') }}"
                   class="guest-nav-link {{ request()->routeIs('guest.home') ? 'active' : '' }}">
                    Beranda
                </a>

                <a href="{{ route('guest.tentang') }}"
                   class="guest-nav-link {{ request()->routeIs('guest.tentang') ? 'active' : '' }}">
                    Tentang
                </a>

                <a href="{{ route('guest.paket-langganan') }}"
                   class="guest-nav-link {{ request()->routeIs('guest.paket-langganan') ? 'active' : '' }}">
                    Paket Langganan
                </a>

                <a href="{{ route('guest.preview-materi') }}"
                   class="guest-nav-link {{ request()->routeIs('guest.preview-materi*') ? 'active' : '' }}">
                    Preview Materi
                </a>

                <a href="{{ route('guest.faq') }}"
                   class="guest-nav-link {{ request()->routeIs('guest.faq') ? 'active' : '' }}">
                    FAQ
                </a>
            </nav>

            {{-- Right Actions --}}
            <div class="d-flex align-items-center gap-2">
                @auth
                    @if(auth()->user()->hasRole('Guru'))
                        <a href="{{ route('dashboard') }}" class="btn-daftar-solid d-none d-sm-inline-flex align-items-center gap-1">
                            <i class="ti ti-user fs-4"></i>
                            <span>Dashboard Guru</span>
                        </a>
                    @else
                        {{-- Pengguna/Super Admin di halaman guest tetap melihat tombol login pengguna --}}
                        <a href="{{ route('login') }}" class="btn-masuk-outline d-none d-sm-inline-flex">
                            Masuk
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-daftar-solid d-none d-sm-inline-flex">
                                Daftar
                            </a>
                        @endif
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn-masuk-outline d-none d-sm-inline-flex">
                        Masuk
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-daftar-solid d-none d-sm-inline-flex">
                            Daftar
                        </a>
                    @endif
                @endauth

                {{-- Mobile Menu Toggle Button --}}
                <button
                    class="btn btn-light d-lg-none p-2 border-0 shadow-none"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#mobileGuestMenu"
                    aria-controls="mobileGuestMenu"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <i class="ti ti-menu-2 fs-2 text-dark"></i>
                </button>
            </div>

        </div>

        {{-- Mobile Collapsible Menu --}}
        <div class="collapse d-lg-none pb-3 border-top pt-2 guest-mobile-menu" id="mobileGuestMenu">
            <div class="d-flex flex-column gap-1 pt-1">
                <a href="{{ route('guest.home') }}"
                   class="guest-nav-link {{ request()->routeIs('guest.home') ? 'active' : '' }}">
                    <i class="ti ti-home me-2 fs-3 text-secondary"></i> Beranda
                </a>
                <a href="{{ route('guest.tentang') }}"
                   class="guest-nav-link {{ request()->routeIs('guest.tentang') ? 'active' : '' }}">
                    <i class="ti ti-info-circle me-2 fs-3 text-secondary"></i> Tentang
                </a>
                <a href="{{ route('guest.paket-langganan') }}"
                   class="guest-nav-link {{ request()->routeIs('guest.paket-langganan') ? 'active' : '' }}">
                    <i class="ti ti-crown me-2 fs-3 text-secondary"></i> Paket Langganan
                </a>
                <a href="{{ route('guest.preview-materi') }}"
                   class="guest-nav-link {{ request()->routeIs('guest.preview-materi*') ? 'active' : '' }}">
                    <i class="ti ti-file-search me-2 fs-3 text-secondary"></i> Preview Materi
                </a>
                <a href="{{ route('guest.faq') }}"
                   class="guest-nav-link {{ request()->routeIs('guest.faq') ? 'active' : '' }}">
                    <i class="ti ti-help-circle me-2 fs-3 text-secondary"></i> FAQ
                </a>

                <div class="pt-2 border-top mt-2">
                    @auth
                        @if(auth()->user()->hasRole('Guru'))
                            <a href="{{ route('dashboard') }}" class="btn-daftar-solid w-100 text-center py-2 d-inline-flex align-items-center justify-content-center gap-2">
                                <i class="ti ti-user fs-4"></i>
                                <span>Dashboard Guru</span>
                            </a>
                        @else
                            <div class="d-flex gap-2">
                                <a href="{{ route('login') }}" class="btn-masuk-outline text-center flex-fill py-2">
                                    Masuk
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn-daftar-solid text-center flex-fill py-2">
                                        Daftar
                                    </a>
                                @endif
                            </div>
                        @endif
                    @else
                        <div class="d-flex gap-2">
                            <a href="{{ route('login') }}" class="btn-masuk-outline text-center flex-fill py-2">
                                Masuk
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn-daftar-solid text-center flex-fill py-2">
                                    Daftar
                                </a>
                            @endif
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</header>
