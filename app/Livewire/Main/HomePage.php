<?php

namespace App\Livewire\Main;

use Livewire\Component;

use Livewire\Attributes\{Layout, Title};
use App\Models\Post;
use App\Enums\PostStatus;

#[Title('Home page')]
#[Layout('layouts.main')]
class HomePage extends Component
{
    public $posts;

    public function mount()
    {
        $this->posts = Post::latest()->take(3)->get();
    }

    public function render()
    {
        return view('livewire.main.home-page');
    }
}
