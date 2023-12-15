<?php

namespace App\Livewire\Admin\Posts;

use Livewire\Component;
use App\Models\Post;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PostTable extends DataTableComponent
{

    protected $model = Post::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id')
                ->sortable(),
            Column::make('Title', 'title')
                ->sortable()
                ->searchable(),
            Column::make('Status', 'status')
                ->sortable()
                ->searchable(),
            Column::make('Created At', 'created_at')
                ->sortable()
                ->searchable()
                ->collapseOnTablet(),
        ];
    }

    // public function render()
    // {
    //     return view('livewire.admin.posts.post-table');
    // }
}
