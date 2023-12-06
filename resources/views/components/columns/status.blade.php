@props([
    'value'
])

<div class="flex">
    <div @class([
        'text-white rounded-xl px-2 uppercase font-bold text-xs',
        'bg-green-500' => $value === 1,
        'bg-gray-500' => $value === 0,
    ])>
    {{ $value }}
    </div>
</div>