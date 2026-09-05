<button
    {{ $attributes->merge([
        'type' => 'submit',
        'class' => 'w-full py-4 rounded-xl text-on-primary font-label-md text-label-md btn-primary-gradient shadow-md flex items-center justify-center gap-2',
    ]) }}
>
    {{ $slot }}
    <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
</button>