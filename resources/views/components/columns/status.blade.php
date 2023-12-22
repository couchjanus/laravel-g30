@props([
    'value'
])

<div class="flex">
    <div @class([
        'text-white rounded-xl px-2 uppercase font-bold text-xs',
        'bg-green-500' => $value === 1,
        'bg-gray-500' => $value === 0,
        'bg-yellow-500' => $value === 2,
        'bg-blue-500' => $value === 3,
        'bg-red-500' => $value === 4,
        'bg-beige-500' => $value === 5,
])>
        {{ $value }}
    </div>
</div>
