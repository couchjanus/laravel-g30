<?php

namespace App\Livewire\Admin\Posts;

use Livewire\Component;
use Livewire\Attributes\{Layout, Title};

#[Title('Post List')]
class PostList extends Component
{
    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.posts.post-list');
    }
}
