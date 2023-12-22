<?php

namespace App\Livewire\Forms\Admin;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostForm extends Form
{
    public ?Post $post;

    #[Validate('required|min:5')]
    public $title = '';

    #[Validate('required|min:5')]
    public $content = '';
    
    #[Validate('required|integer')]
    public $status = 0;

    #[Validate('required|array')]
    public array $tags = [];

    public $oldCover;

    #[Validate('required|integer')]
    public $user_id;

    #[Validate('nullable')] // 1MB Max
    public $cover;
    
    #[Validate('date|nullable')] // 1MB Max
    public $published_at;

    public function setPost(Post $post)
    {
        $this->post = $post;
        $this->title = $post->title;
        $this->content = $post->content;
        $this->status = $post->status;
        $this->user_id = $post->user_id;
        // $this->published_at = $post->published_at->format('m / d / Y');
        $this->published_at = $post->published_at;
        $this->tags = $post->tags()->pluck('id')->toArray();
        $this->oldCover = $post->cover;
    }
 
    public function store() 
    {
        $validated = $this->validate();
        
        // dd($validated);
        $this->cover = $this->cover->store('posts', 'public');
        
        $post = Post::create($this->all());
        // $post->tags()->toggle([1, 2, 3]);
        $post->tags()->sync($this->tags);
        
    }
   

    public function update()
    {
        $validated = $this->validate();
        // dd($validated);
        if ($this->cover) {
        // if ($this->cover->getClientOriginalName()) {
            if ($this->oldCover !== null && Storage::disk('public')->exists($this->oldCover)) {
                Storage::disk('public')->delete($this->oldCover);
            }
            $this->cover = $this->cover->store('posts', 'public');
         
        } else {
            $this->cover = $this->oldCover;
        }
        // dd($this->all());
        $this->post->update(
            $this->all()
        );
        $this->post->tags()->sync($this->tags);
        // session()->flash('success','Product Updated Successfully!!');
    }
}
