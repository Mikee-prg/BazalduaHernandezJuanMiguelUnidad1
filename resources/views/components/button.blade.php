@props([
    'variant' => 'primary', // primary, secondary, danger, success
    'size' => 'md', // sm, md, lg
    'type' => 'button',
    'disabled' => false,
    'icon' => null,
    'loading' => false,
])

@php
$baseClasses = 'font-semibold transition transform hover:scale-105 focus:outline-none flex items-center gap-2 justify-center';

$variants = [
    'primary' => 'bg-red-700 hover:bg-red-800 text-white disabled:bg-gray-400',
    'secondary' => 'bg-gray-300 hover:bg-gray-400 text-gray-800 disabled:bg-gray-200',
    'danger' => 'bg-red-600 hover:bg-red-700 text-white disabled:bg-gray-400',
    'success' => 'bg-green-600 hover:bg-green-700 text-white disabled:bg-gray-400',
];

$sizes = [
    'sm' => 'px-3 py-1 text-sm rounded',
    'md' => 'px-4 py-2 rounded-lg',
    'lg' => 'px-6 py-3 text-lg rounded-lg',
];

$classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['primary']) . ' ' . ($sizes[$size] ?? $sizes['md']);
@endphp

<button 
    type="{{ $type }}"
    {{ $disabled ? 'disabled' : '' }}
    @if($loading) disabled @endif
    {{ $attributes->merge(['class' => $classes]) }}>
    @if($icon && !$loading)
        <i class="{{ $icon }}"></i>
    @endif
    @if($loading)
        <i class="fas fa-spinner fa-spin"></i>
    @endif
    {{ $slot }}
</button>
