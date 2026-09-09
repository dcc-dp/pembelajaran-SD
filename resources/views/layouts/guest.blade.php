@props(['title' => 'Selamat Datang Kembali', 'subtitle' => 'Masuk untuk mengakses SD Learning Center — kelola akun, materi, dan aktivitas Anda di satu tempat.'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'EduMentor') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .material-symbols-outlined {
                font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            }
            .btn-primary-gradient {
                background: linear-gradient(135deg, #b7131a 0%, #ff8f06 100%);
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }
            .btn-primary-gradient:hover {
                transform: translateY(-2px);
                box-shadow: 0px 12px 32px rgba(229, 57, 53, 0.12);
            }
            .btn-primary-gradient:active {
                transform: scale(0.98);
            }
        </style>
    </head>
    <body class="bg-surface text-on-surface font-body-md overflow-x-hidden">

        <main class="min-h-screen w-full flex flex-col md:flex-row">

            <!-- Left: full-height branding panel -->
            <div class="hidden md:flex md:w-1/2 relative flex-col justify-center px-xl py-2xl bg-primary-fixed/40 overflow-hidden">
                <div class="max-w-lg mx-auto w-full space-y-lg">
                    <div class="rounded-2xl overflow-hidden bg-surface-container-lowest/70 shadow-[0px_8px_30px_rgba(0,0,0,0.06)]">
                        <img class="w-full h-auto object-contain"
                            src="{{ asset('images/auth/login.png') }}"
                            alt="Ilustrasi guru SD menggunakan laptop" />
                    </div>

                    <div class="space-y-sm">
                          <h1 class="font-headline-lg text-headline-lg text-primary">{{ $title }}</h1>
                            <p class="font-body-lg text-body-lg text-on-surface-variant">
                                {{ $subtitle }}
                            </p>
                    </div>

                    <ul class="space-y-sm">
                        <li class="flex items-center gap-sm text-body-md text-on-surface">
                            <span class="w-8 h-8 rounded-full bg-primary-fixed flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-primary text-[20px]">menu_book</span>
                            </span>
                            <span>Akses semua fitur platform</span>
                        </li>
                        <li class="flex items-center gap-sm text-body-md text-on-surface">
                            <span class="w-8 h-8 rounded-full bg-secondary-fixed flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-secondary text-[20px]">download</span>
                            </span>
                            <span>Kelola dan unduh dokumen</span>
                        </li>
                        <li class="flex items-center gap-sm text-body-md text-on-surface">
                            <span class="w-8 h-8 rounded-full bg-tertiary-fixed flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-tertiary text-[20px]">sync</span>
                            </span>
                            <span>Update materi terbaru</span>
                        </li>
                    </ul>
                    </ul>
                </div>
            </div>

            <!-- Right: full-height form panel -->
            <div class="w-full md:w-1/2 flex items-center justify-center px-md py-2xl">
                <div class="w-full max-w-[440px]">
                    {{ $slot }}
                </div>
            </div>

        </main>

        @stack('scripts')
    </body>
</html>