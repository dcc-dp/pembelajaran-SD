@props([
    'icon' => 'mail',
    'label' => '',
    'name' => '',
    'type' => 'text',
])

<div class="space-y-xs">
    @if ($label)
        <label for="{{ $name }}" class="font-label-md text-label-md text-on-surface-variant ml-base">
            {{ $label }}
        </label>
    @endif

    <div class="relative group">
        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline group-focus-within:text-primary transition-colors text-[20px]">
            {{ $icon }}
        </span>

        <input
            id="{{ $name }}"
            name="{{ $name }}"
            type="{{ $type }}"
            {{ $attributes->merge([
                'class' => 'w-full pl-12 pr-4 py-3 bg-surface border border-outline-variant rounded-xl focus:outline-none focus:ring-1 focus:ring-primary/30 focus:border-primary transition-all font-body-md',
            ]) }}
        />
    </div>

    <x-input-error :messages="$errors->get($name)" class="mt-2" />
</div>