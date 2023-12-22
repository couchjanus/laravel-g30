<?php

namespace App\Livewire\Admin\Posts;

use App\Models\Post;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\{BooleanColumn, ButtonGroupColumn, LinkColumn, ComponentColumn};
 
class PostsTable extends DataTableComponent
{
    protected $model = Post::class;
    public array $posts = [];

    public function configure(): void
    {
        $this->setPrimaryKey('id')
        ->setAdditionalSelects(['posts.id as id'])
        ;
    }

    public function deleteItem($id)
    {
        $post = Post::find($id);
 
        $post->delete();
    }


    public function getTableRowUrl($row): string
    {
        return route('posts.edit', $row->id);
    }

    public function columns(): array
    {
        return [
            Column::make('Title', 'title')
                ->sortable()
                ->searchable(),

            Column::make('Status', 'status')
                ->sortable()
                ->searchable(),

            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable()
                ->collapseOnTablet(),

            
            ButtonGroupColumn::make('Actions')
                    ->attributes(function($row) {
                        return [
                            'class' => 'space-x-2',
                        ];
                    })
                    ->buttons([
                        LinkColumn::make('Edit')
                            ->title(fn($row) => 'Edit ')
                            ->location(fn($row) => route('posts.edit', $row->id))
                            ->attributes(function($row) {
                                return [
                                    'class' => 'underline text-blue-500 hover:no-underline',
                                ];
                            }),
                        
                        LinkColumn::make('Delete')
                            ->title(fn($row) => 'Delete ')
                            ->location(fn($row) => url('#!'))
                            ->attributes(function($row) {
                                return [
                                    'class' => 'underline text-red-500 hover:no-underline',
                                    "wire:click"=>"deleteItem($row->id)"
                                ];
                            }),

                    ]),
        ];

    }

}

