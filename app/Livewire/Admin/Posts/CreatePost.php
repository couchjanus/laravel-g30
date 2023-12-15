<?php

namespace App\Livewire\Admin\Posts;

use Livewire\Component;
use Livewire\Attributes\{Layout, Title};
use App\Livewire\Forms\Admin\PostForm;
use Livewire\WithFileUploads;
use App\Models\{Post, User, Tag};
use App\Enums\PostStatus;

#[Title('Create Post')]
class CreatePost extends Component
{
    use WithFileUploads;

    public PostForm $form;
    public Array $users;
    public Array $tags;
    public Array $postStatus;

    public function mount(): void
    {
        $this->tags = Tag::all('id', 'name')->toArray();
        $this->users = User::all('id', 'name')->toArray();
        $this->postStatus = PostStatus::asArray();

    }

    public function save()
    {
        $this->form->store();
        return $this->redirect('/admin/posts');
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.posts.create-post');
    }
}
