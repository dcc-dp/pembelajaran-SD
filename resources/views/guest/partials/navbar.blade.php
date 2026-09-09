<header class="sticky-top guest-navbar">
    <div class="container-xl">
        <div class="d-flex align-items-center justify-content-between py-3">

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
                        <a href="{{ route('dashboard') }}" class="btn-daftar-solid d-inline-flex align-items-center gap-1">
                            <i class="ti ti-user fs-4"></i>
                            <span>Dashboard Guru</span>
                        </a>
                    @else
                        {{-- Pengguna/Super Admin di halaman guest tetap melihat tombol login pengguna --}}
                        <a href="{{ route('login') }}" class="btn-masuk-outline">
                            Masuk
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-daftar-solid">
                                Daftar
                            </a>
                        @endif
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn-masuk-outline">
                        Masuk
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-daftar-solid">
                            Daftar
                        </a>
                    @endif
                @endauth

                {{-- Mobile Menu Toggle Button --}}
                <button
                    class="btn btn-light d-lg-none p-2 border-0"
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
        <div class="collapse d-lg-none pb-3 border-top pt-2" id="mobileGuestMenu">
            <div class="d-flex flex-column gap-2">
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

                <div class="d-flex gap-2 pt-2 border-top mt-2">
                    <a href="{{ route('login') }}" class="btn-masuk-outline text-center flex-fill">
                        Masuk
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-daftar-solid text-center flex-fill">
                            Daftar
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>
