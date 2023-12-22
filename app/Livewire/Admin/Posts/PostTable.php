<?php

namespace App\Livewire\Admin\Posts;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;

use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\Rule;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridColumns;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use Livewire\Attributes\On;

class PostTable extends PowerGridComponent
{

    public string $sortField = 'posts.id';

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Header::make()
                ->showToggleColumns()
                ->showSoftDeletes()
                ->showSearchInput(),

            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): ?Builder
    {
        return Post::query();
    }

    public function onUpdatedToggleable(string|int $id, string $field, string $value): void
    {
        Post::query()->where('id', $id)->update([
            $field => $value,
        ]);

        $this->skipRender();
    }

    #[On('postDelete')]
    public function postDelete(): void
    {
        // dd($this->checkboxValues);
        Post::destroy($this->checkboxValues);
        // $this->dispatch('openModal', 'delete-user', [
        //     'userIds' => $this->checkboxValues,
        //     'confirmationTitle' => 'Delete user',
        //     'confirmationDescription' => 'Are you sure you want to delete this user?',
        // ]);
    }

    public function header(): array
    {
        return [
            Button::add('post-delete')
                ->slot(__('Post delete'))
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('postDelete', []),
        ];
    }


    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('title')
            ->addColumn('status')
            ->addColumn('created_at_formatted', fn (Post $model) => 
            Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {
        return [
            Column::add()
                ->title(__('ID'))
                ->field('id', 'posts.id')
                ->searchable()
                ->sortable(),
            
            Column::make('Title', 'title')
                ->sortable()
                ->searchable(),


            Column::make('Status', 'status')
                ->toggleable(),

            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable(),

            Column::action('Action'),
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('title')->operators(['contains']),
            Filter::boolean('active'),
            Filter::datetimepicker('created_at'),
        ];
    }

    public function actions(Post $post): array
    {
        return [
            Button::make('edit', '<i class="fas fa-edit"></i>')
                    ->class('focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800')
                    // ->route('posts.remove', ['post' => 'id'])
                    ->route('advices.edit', ['advice' => $post->id])
                    // ->target('_self')
                    ->tooltip('Edit Record'),
            Button::make('delete', '<i class="fas fa-trash"></i>') 
                    ->class('focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900')
                    // ->route('posts.remove', ['post' => 'id'])
                    ->route('advices.edit', ['advice' => $post->id])
                    ->tooltip('Delete Record')
            
        ];
    }
}
