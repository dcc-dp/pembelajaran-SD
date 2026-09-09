@include('admin.partials.head')

<body class="layout-fluid">

    <div class="page">

        @include('admin.partials.sidebar')

        <div class="page-wrapper">

            @include('admin.partials.navbar')

            @include('admin.partials.page-header')

            <main class="page-body">
                <div class="container-xl">
                    @yield('content')
                </div>
            </main>

            @include('admin.partials.footer')

        </div>

    </div>

    <script src="{{ asset('assets/admin/js/tabler.min.js') }}" defer></script>

<script>
    (function () {
        const htmlEl = document.documentElement;
        const btn = document.getElementById('theme-toggle-btn');
        const iconLight = document.getElementById('theme-icon-light');
        const iconDark = document.getElementById('theme-icon-dark');

        function applyTheme(theme) {
            htmlEl.setAttribute('data-bs-theme', theme);
            localStorage.setItem('admin-theme', theme);
            if (theme === 'dark') {
                iconLight.classList.add('d-none');
                iconDark.classList.remove('d-none');
            } else {
                iconLight.classList.remove('d-none');
                iconDark.classList.add('d-none');
            }
        }

        const savedTheme = localStorage.getItem('admin-theme') || 'light';
        applyTheme(savedTheme);

        btn.addEventListener('click', function (e) {
            e.preventDefault();
            const current = htmlEl.getAttribute('data-bs-theme');
            applyTheme(current === 'dark' ? 'light' : 'dark');
        });
    })();
</script>

</body>
</html>