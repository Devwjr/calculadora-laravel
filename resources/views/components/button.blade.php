@props([
    'variant' => 'num',
    'action' => '',
    'value' => '',
    'wide' => false,
])

@php
    $baseClasses = 'py-3.5 rounded-lg cursor-pointer transition-all duration-75 active:translate-y-[2px]';

    $variantClasses = match ($variant) {
        'num' => 'bg-white text-black text-xl font-semibold shadow-[0_3px_0_rgba(0,0,0,0.15)] border border-black/20 active:shadow-[0_1px_0_rgba(0,0,0,0.15)]',
        'op' => 'bg-black text-white text-xl font-semibold shadow-[0_3px_0_rgba(0,0,0,0.3)] active:shadow-[0_1px_0_rgba(0,0,0,0.3)]',
        'eq' => 'bg-black text-white text-2xl font-bold shadow-[0_3px_0_rgba(0,0,0,0.3)] active:shadow-[0_1px_0_rgba(0,0,0,0.3)]',
        'clear' => 'bg-black text-white text-lg font-semibold shadow-[0_3px_0_rgba(0,0,0,0.3)] active:shadow-[0_1px_0_rgba(0,0,0,0.3)]',
        'back' => 'bg-neutral-700 text-white text-base font-semibold shadow-[0_3px_0_rgba(0,0,0,0.3)] active:shadow-[0_1px_0_rgba(0,0,0,0.3)]',
        default => 'bg-white text-black text-xl font-semibold shadow-[0_3px_0_rgba(0,0,0,0.15)] border border-black/20 active:shadow-[0_1px_0_rgba(0,0,0,0.15)]',
    };

    $colspanClass = $wide ? 'col-span-2' : 'col-span-1';
@endphp

<button
    type="submit"
    class="{{ $baseClasses }} {{ $variantClasses }} {{ $colspanClass }}"
    onclick="setAction('{{ $action }}', '{{ $value }}')"
>
    {{ $slot }}
</button>
