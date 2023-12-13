<?php

namespace App\Livewire\Admin\Categories;

use App\Livewire\Column;
use App\Livewire\Table;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Category;

class CategoryTable extends Table
{
    public $route_edit = 'categories.edit';
    public string $searchQuery = '';

    public function query():Builder
    {
        return Category::query()->when($this->searchQuery !== '', fn(Builder $query) => $query->where('name', 'like', '%'.$this->searchQuery.'%'));
    }

    public function updated($key):void
    {
        if ($key === 'searchQuery') {
            $this->resetPage();
        }
    }

    public function deleteItem(int $id)
    {
        $category = Category::find($id);
        $category->delete();
    }

    public  function restoreItem(int $id)
    {
        Category::withTrashed()->find($id)->restore();
    }
    public  function forceDeleteItem(int $id)
    {
        Category::withTrashed()->find($id)->forceDelete();
    }

    public function columns():array
    {
        return [

            Column::make('name', 'Name'),
            Column::make('status', 'Status')->component('columns.status'),
            Column::make('created_at', 'Created At')->component('columns.human-diff'),
        ];

    }

}
