<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="SD Learning Center - Platform sumber daya dan perangkat ajar digital terlengkap untuk Guru Sekolah Dasar di Indonesia.">

    <title>@yield('title', 'Beranda') - SD Learning Center</title>

    <link rel="icon" href="{{ asset('assets/admin/img/favicon.ico') }}">

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

    <!-- Stylesheets -->
    <link href="{{ asset('assets/admin/css/tabler.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.46.0/dist/tabler-icons.min.css">
    <link href="{{ asset('assets/guest/css/guest.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body class="d-flex flex-column min-vh-100">

    {{-- Navbar Publik --}}
    @include('guest.partials.navbar')

    {{-- Konten Utama --}}
    <main class="flex-grow-1">
        @yield('content')
    </main>

    {{-- Footer Publik --}}
    @include('guest.partials.footer')

    <!-- Scripts -->
    <script src="{{ asset('assets/admin/js/tabler.min.js') }}" defer></script>
    @stack('scripts')
</body>
</html>
