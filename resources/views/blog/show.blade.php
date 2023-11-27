{{-- post list --}}
<x-main-layout>

    <x-slot name="header">
        <h1>{{ $post->title }}</h1>
    </x-slot>


    <x-blog.detail :post="$post"></x-blog.detail>

    <x-slot name="footer">
        <p>&copy; 2024</p>
    </x-slot>

</x-main-layout>
