<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-lg">
        <h2 class="font-headline-md text-headline-md text-on-surface">Masuk ke Akun</h2>
        <p class="font-body-md text-body-md text-on-surface-variant mt-xs">
            Silakan masuk menggunakan email dan password yang telah Anda daftarkan.
        </p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-md">
        @csrf

        <!-- Email Address -->
        <x-auth.icon-input
            icon="mail"
            label="Email"
            name="email"
            type="email"
            placeholder="nama@email.com"
            :value="old('email')"
            required
            autofocus
            autocomplete="username"
        />

        <!-- Password -->
        <x-auth.password-input
            label="Password"
            name="password"
            required
            autocomplete="current-password"
        />

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between py-xs">
            <label for="remember_me" class="flex items-center gap-2 cursor-pointer group">
                <input id="remember_me" type="checkbox" name="remember"
                       class="w-5 h-5 rounded border-outline-variant text-primary focus:ring-primary">
                <span class="font-label-md text-label-md text-on-surface-variant group-hover:text-on-surface transition-colors">
                    Ingat saya
                </span>
            </label>

            @if (Route::has('password.request'))
                <a class="font-label-md text-label-md text-primary hover:underline transition-all"
                   href="{{ route('password.request') }}">
                    Lupa Password?
                </a>
            @endif
        </div>

        <!-- Submit -->
        <x-auth.gradient-button>
            Masuk
        </x-auth.gradient-button>
    </form>

    <!-- Divider -->
    <div class="relative my-lg">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-outline-variant"></div>
        </div>
        <div class="relative flex justify-center text-label-sm uppercase">
            <span class="bg-surface-container-lowest px-4 text-on-surface-variant font-label-sm">atau</span>
        </div>
    </div>

    <!-- Social Login -->
    <x-auth.social-button provider="google" label="Masuk dengan Google" />

    <p class="text-center mt-lg font-body-md text-body-md text-on-surface-variant">
        Belum memiliki akun?
        <a class="text-primary font-bold hover:underline" href="{{ route('register') }}">Daftar Sekarang</a>
    </p>
</x-guest-layout>