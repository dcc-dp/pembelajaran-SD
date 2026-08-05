<x-guest-layout
    title="Buat Akun Baru"
    subtitle="Daftar sekarang untuk mengakses perangkat ajar digital, unduh materi, dan kelola langganan Anda."
>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-md">
        <h2 class="font-headline-md text-headline-md text-on-surface">Daftar Akun</h2>
        <p class="font-body-md text-body-md text-on-surface-variant mt-xs">
            Lengkapi data di bawah ini untuk membuat akun baru.
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-sm">
        @csrf

        <!-- Nama Lengkap -->
        <x-auth.icon-input
            icon="person"
            label="Nama Lengkap"
            name="name"
            type="text"
            placeholder="Nama lengkap Anda"
            :value="old('name')"
            required
            autofocus
            autocomplete="name"
        />

        <!-- Nama Sekolah -->
        <x-auth.icon-input
            icon="school"
            label="Nama Sekolah"
            name="nama_sekolah"
            type="text"
            placeholder="Nama sekolah Anda"
            :value="old('nama_sekolah')"
            required
            autocomplete="organization"
        />

        <!-- Email -->
        <x-auth.icon-input
            icon="mail"
            label="Email"
            name="email"
            type="email"
            placeholder="nama@email.com"
            :value="old('email')"
            required
            autocomplete="username"
        />

        <!-- No. HP -->
        <x-auth.icon-input
            icon="call"
            label="No. HP"
            name="no_hp"
            type="text"
            placeholder="08xxxxxxxxxx"
            :value="old('no_hp')"
            required
            autocomplete="tel"
        />

        <!-- Password & Confirm Password: sejajar 2 kolom seperti contoh -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-sm">
            <x-auth.password-input
                label="Password"
                name="password"
                required
                autocomplete="new-password"
            />

            <x-auth.password-input
                label="Konfirmasi Password"
                name="password_confirmation"
                required
                autocomplete="new-password"
            />
        </div>

        <!-- Terms -->
        <label class="flex items-start gap-2 cursor-pointer group py-xs">
            <input id="terms" type="checkbox" name="terms" required
                class="w-5 h-5 mt-0.5 rounded border-outline-variant text-primary focus:ring-primary">
            <span class="font-label-md text-label-md text-on-surface-variant group-hover:text-on-surface transition-colors">
                Saya menyetujui
                <a href="#" class="text-primary hover:underline">Syarat & Ketentuan</a>
                dan
                <a href="#" class="text-primary hover:underline">Kebijakan Privasi</a>
            </span>
        </label>

        <!-- Submit -->
        <x-auth.gradient-button>
            Daftar
        </x-auth.gradient-button>
    </form>

    <!-- Divider -->
    <div class="relative my-md">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-outline-variant"></div>
        </div>
        <div class="relative flex justify-center text-label-sm uppercase">
            <span class="bg-surface-container-lowest px-4 text-on-surface-variant font-label-sm">atau</span>
        </div>
    </div>

    <!-- Social Register -->
    <x-auth.social-button provider="google" label="Daftar dengan Google" />

    <p class="text-center mt-md font-body-md text-body-md text-on-surface-variant">
        Sudah memiliki akun?
        <a class="text-primary font-bold hover:underline" href="{{ route('login') }}">Masuk</a>
    </p>
</x-guest-layout>