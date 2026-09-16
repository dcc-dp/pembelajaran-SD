<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard Guru') - SD Learning Center</title>

    <link rel="icon" href="{{ asset('assets/admin/img/favicon.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

    <!-- Stylesheets -->
    <link href="{{ asset('assets/admin/css/tabler.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.46.0/dist/tabler-icons.min.css">
    <link href="{{ asset('assets/guru/css/guru.css') }}" rel="stylesheet">

    @stack('styles')
</head>
<body class="layout-fluid guru-portal">

    <div class="page">

        {{-- Sidebar Guru --}}
        @include('guru.partials.sidebar')

        <div class="page-wrapper">

            {{-- Navbar Guru --}}
            @include('guru.partials.navbar')

            {{-- Main Content --}}
            <main class="page-body py-4">
                <div class="container-xl">
                    @yield('content')
                </div>
            </main>

        </div>

    </div>

    <!-- Scripts -->
    <script src="{{ asset('assets/admin/js/tabler.min.js') }}" defer></script>
    @stack('scripts')

</body>
</html>
