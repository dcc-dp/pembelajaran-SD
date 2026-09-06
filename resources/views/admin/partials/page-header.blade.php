<div class="page-header d-print-none mb-4">
    <div class="container-xl">
        <div class="row g-2 align-items-center">

            <div class="col">
                @hasSection('page-breadcrumbs')
                    <div class="mb-1">
                        @yield('page-breadcrumbs')
                    </div>
                @elseif(View::hasSection('page-pretitle'))
                    <div class="page-pretitle text-uppercase fw-bold text-muted mb-1" style="font-size: 0.7rem; letter-spacing: 0.06em;">
                        @yield('page-pretitle')
                    </div>
                @endif

                <h2 class="page-title fw-extrabold text-dark mb-1" style="font-size: 1.5rem; letter-spacing: -0.025em;">
                    @yield('page-title', 'Dashboard')
                </h2>

                @hasSection('page-description')
                    <p class="text-secondary mb-0" style="font-size: 0.875rem;">
                        @yield('page-description')
                    </p>
                @endif
            </div>

            @hasSection('page-actions')
                <div class="col-auto ms-auto d-print-none">
                    <div class="d-flex align-items-center gap-2">
                        @yield('page-actions')
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>