<?php

namespace App\Livewire\Main;

use Livewire\Component;
use Livewire\Attributes\{Layout, Title};
use App\Models\Post;
use App\Enums\PostStatus;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\WithPagination;

#[Title('Blog page')]
#[Layout('layouts.main')]
class BlogPage extends Component
{
    use WithPagination;
    public Collection $posts;

    public int $page = 1;
    public $hasMore;

    public $sortDirection = 'desc';

    public function query(): Builder
    {
        return Post::where('status', PostStatus::Active)
        ->with('user')
        ->with('tags')
        ->when($this->sortDirection == 'desc', function($query){
            $query->latest();
        })
        ;
    }

    public function mount()
    {

    }

    public function LoadMore()
    {
        $posts = $this->query()->paginate(7, ['*'], 'page', $this->page);
        $this->page +=1;
        $this->hasMore = $posts->hasMorePages();
        $this->posts->push(...$posts->items());

    }

    public function render()
    {
        $this->posts = new Collection();
        $this->LoadMore();
        return view('livewire.main.blog-page');
    }
}
