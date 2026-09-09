<x-guest-layout
    title="Lupa Password"
    subtitle="Masukkan email Anda dan kami akan mengirimkan link untuk mengatur ulang password Anda."
>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-md">
        <h2 class="font-headline-md text-headline-md text-on-surface">Lupa Password</h2>
        <p class="font-body-md text-body-md text-on-surface-variant mt-xs">
            Masukkan email yang terdaftar, kami akan mengirimkan link reset password ke email tersebut.
        </p>
    </div>

    <form method="POST" action="{{ route('password.email') }}" class="space-y-sm">
        @csrf

        <!-- Email -->
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

        <!-- Submit -->
        <x-auth.gradient-button>
            Kirim Link Reset Password
        </x-auth.gradient-button>
    </form>

    <p class="text-center mt-md font-body-md text-body-md text-on-surface-variant">
        Sudah ingat password Anda?
        <a class="text-primary font-bold hover:underline" href="{{ route('login') }}">Masuk</a>
    </p>
</x-guest-layout>