@props([
    'label' => 'Password',
    'name' => 'password',
])

@php
    $fieldId = $name . '-field';
    $iconId = $name . '-icon';
@endphp

<div class="space-y-xs">
    @if ($label)
        <label for="{{ $fieldId }}" class="font-label-md text-label-md text-on-surface-variant ml-base">
            {{ $label }}
        </label>
    @endif

    <div class="relative group">
        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline group-focus-within:text-primary transition-colors">
            lock
        </span>

        <input
            id="{{ $fieldId }}"
            name="{{ $name }}"
            type="password"
            placeholder="••••••••"
            {{ $attributes->merge([
                'class' => 'w-full pl-12 pr-12 py-3.5 bg-surface border border-outline-variant rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all font-body-md',
            ]) }}
        />

        <button
            type="button"
            class="absolute right-4 top-1/2 -translate-y-1/2 text-outline hover:text-on-surface transition-colors"
            onclick="togglePasswordVisibility('{{ $fieldId }}', '{{ $iconId }}')"
        >
            <span class="material-symbols-outlined" id="{{ $iconId }}">visibility</span>
        </button>
    </div>

    <x-input-error :messages="$errors->get($name)" class="mt-2" />
</div>

@once
    @push('scripts')
    <script>
        function togglePasswordVisibility(fieldId, iconId) {
            const field = document.getElementById(fieldId);
            const icon = document.getElementById(iconId);

            if (field.type === 'password') {
                field.type = 'text';
                icon.innerText = 'visibility_off';
            } else {
                field.type = 'password';
                icon.innerText = 'visibility';
            }
        }
    </script>
    @endpush
@endonce