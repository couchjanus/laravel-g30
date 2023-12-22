@props(['textColor', 'bgColor'])

@php
    $textColor = match ($textColor) {
        'gray' => 'text-gray-800',
        'blue' => 'text-blue-800',
        'red' => 'text-red-800',
        'yellow' => 'text-yellow-800',
        'pink' => 'text-pink-800',
        'indigo' => 'text-indigo-800',
        'purple' => 'text-purple-800',
        'green' => 'text-green-800',
        'lime' => 'text-lime-800',
        default => 'text-white',
    };
    
    $bgColor = match ($bgColor) {
        'gray' => 'bg-gray-100',
        '#1e40af' => 'bg-blue-800',
        '#991b1b' => 'bg-red-800',
        '#9a3412' => 'bg-yellow-100',
        '#9d174d' => 'bg-pink-100',
        '#3730a3' => 'bg-indigo-100',
        '#6b21a8' => 'bg-purple-100',
        '#166534' => 'bg-green-100',
        '#3f6212' => 'bg-lime-100',
        default => 'bg-red-300',

    };
@endphp

<button {{ $attributes }} class="text-white {{ $bgColor }} rounded-xl px-3 py-1 text-base">
    {{ $slot }} </button>
