@props([
    'type' => 'info', // success, error, warning, info
    'title' => null,
    'dismissible' => true,
    'icon' => null,
])

@php
$colors = [
    'success' => ['bg' => 'bg-green-50', 'border' => 'border-green-600', 'text' => 'text-green-700', 'icon' => 'fas fa-check-circle'],
    'error' => ['bg' => 'bg-red-50', 'border' => 'border-red-600', 'text' => 'text-red-700', 'icon' => 'fas fa-exclamation-circle'],
    'warning' => ['bg' => 'bg-yellow-50', 'border' => 'border-yellow-600', 'text' => 'text-yellow-700', 'icon' => 'fas fa-exclamation-triangle'],
    'info' => ['bg' => 'bg-blue-50', 'border' => 'border-blue-600', 'text' => 'text-blue-700', 'icon' => 'fas fa-info-circle'],
];
$config = $colors[$type] ?? $colors['info'];
@endphp

<div id="alert-{{ uniqid() }}" class="{{ $config['bg'] }} border-l-4 {{ $config['border'] }} p-4 rounded {{ $config['text'] }}" role="alert">
    <div class="flex items-start justify-between">
        <div class="flex items-start gap-3">
            <i class="{{ $icon ?? $config['icon'] }} flex-shrink-0 mt-0.5"></i>
            <div>
                @if($title)
                    <h4 class="font-bold mb-1">{{ $title }}</h4>
                @endif
                <div class="text-sm">
                    {{ $slot }}
                </div>
            </div>
        </div>
        @if($dismissible)
            <button type="button" onclick="this.closest('[role=alert]').remove()" class="text-gray-400 hover:text-gray-600 transition">
                <i class="fas fa-times"></i>
            </button>
        @endif
    </div>
</div>
