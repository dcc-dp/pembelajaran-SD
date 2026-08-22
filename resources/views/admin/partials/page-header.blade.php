<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">

            <div class="col">
                @hasSection('page-pretitle')
                    <div class="page-pretitle">
                        @yield('page-pretitle')
                    </div>
                @endif

                <h2 class="page-title">
                    @yield('page-title', 'Dashboard')
                </h2>
            </div>

            @hasSection('page-actions')
                <div class="col-auto ms-auto d-print-none">
                    @yield('page-actions')
                </div>
            @endif

        </div>
    </div>
</div>