<!-- resources/views/components/blog/detail.blade.php -->

<div>

    <p>{{ $post->content }}</p>
    Last modified: {{ $post->updated_at }}
    <hr>
    <a href="/blog">All posts</a>
</div>