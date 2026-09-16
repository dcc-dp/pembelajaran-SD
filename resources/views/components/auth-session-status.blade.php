@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'p-3.5 mb-4 text-sm font-medium text-emerald-800 bg-emerald-50 border border-emerald-200 rounded-xl flex items-center gap-2.5 shadow-sm']) }}>
        <span class="material-symbols-outlined text-emerald-600 text-[20px] shrink-0">check_circle</span>
        <span>{{ $status }}</span>
    </div>
@endif
