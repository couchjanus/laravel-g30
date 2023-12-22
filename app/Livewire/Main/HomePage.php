<?php

namespace App\Livewire\Main;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Post;
use App\Enums\PostStatus;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

#[Title('Home page')]
#[Layout('layouts.main')]
class HomePage extends Component
{
    public $latestPosts;
 
    public function mount() 
    {
        // $this->posts = Post::where('status', PostStatus::Active)->with('user')->with('tags')->latest('updated_at')->take(3)->get();
        
        $this->latestPosts = Cache::remember('latestPosts', now()->addDay(), function () {
            return Post::published()->with('tags')->latest('published_at')->take(3)->get();
        });
    }

    public function render()
    {
        return view('livewire.main.home-page');
    }
}
