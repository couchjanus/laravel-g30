<?php

namespace App\Livewire\Forms\Admin;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\{Post};
use Illuminate\Support\Facades\Storage;

class PostForm extends Form
{
    public ?Post $post;

    #[Validate('required|min:5')]
    public $title='';

    #[Validate('required|min:5')]
    public $content='';

    #[Validate('required|integer')]
    public $status = 0;

    #[Validate('required|image|max:1024')]
    public $cover = '';

    public $oldCover;

    #[Validate('required|integer')]
    public $user_id;

    #[Validate('required|array')]
    public array $tags = [];

    public function setPost(Post $post)
    {
        $this->post = $post;
        $this->title = $post->title;

        $this->user_id = $post->user_id;
        $this->tags = $post->title;
        $this->content = $post->tags()->pluck('id')->toArray();
        $this->status = $post->status;
        $this->oldCover = $post->cover;
    }

    public function store()
    {
        $validated = $this->validate();
        // dd($validated);

        $this->cover = $this->cover->store('posts', 'public');
        $post = Post::create($this->all());
        $post->tags()->sync($this->tags);

    }

    public function update()
    {
        $this->validate();

        if ($this->cover->getClientOriginalName()) {

            if ($this->oldCover !== null && Storage::disk('public')->exists($this->oldCover)) {
                Storage::disk('public')->delete($this->oldCover);
            }

            $this->cover = $this->cover->store('posts', 'public');
        }

        $this->post->update(
            $this->all()
        );
        $this->post->tags()->sync($this->tags);
    }

}
