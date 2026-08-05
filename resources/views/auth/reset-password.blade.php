<x-guest-layout
    title="Atur Ulang Password"
    subtitle="Buat password baru untuk akun Anda."
>
    <div class="mb-md">
        <h2 class="font-headline-md text-headline-md text-on-surface">Atur Ulang Password</h2>
        <p class="font-body-md text-body-md text-on-surface-variant mt-xs">
            Masukkan password baru Anda di bawah ini.
        </p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-sm">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email -->
        <x-auth.icon-input
            icon="mail"
            label="Email"
            name="email"
            type="email"
            placeholder="nama@email.com"
            :value="old('email', $request->email)"
            required
            autofocus
            autocomplete="username"
        />

        <!-- Password & Confirm Password -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-sm">
            <x-auth.password-input
                label="Password Baru"
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

        <!-- Submit -->
        <x-auth.gradient-button>
            Atur Ulang Password
        </x-auth.gradient-button>
    </form>
</x-guest-layout>