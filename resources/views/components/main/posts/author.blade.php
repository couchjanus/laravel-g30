
@props(['author', 'size'])

@php

    $imageSize = match ($size ?? null) {
        'xs' => 'w-7 h-7',
        'sm' => 'w-9 h-9',
        'md' => 'w-10 h-10',
        'lg' => 'w-14 h-14',
        default => 'w-10 h-10',
    };

    $textSize = match ($size ?? null) {
        'xs' => 'text-xs',
        'sm' => 'text-sm',
        'md' => 'text-base',
        'lg' => 'text-xl',
        default => 'text-base',
    };

@endphp

<img class="mr-3 w-7 h-7 rounded-full {{ $imageSize }}" src="{{ $author->profile_photo_url ?? 'https://res.cloudinary.com/dgrpkngjn/image/upload/f_auto,q_auto,w_100,h_100,g_face,c_thumb/v1657646841/profile-image/assets/default_profile.png' }}" alt="Test">
<span class="mr-1 {{ $textSize }}">Test Test </span>

