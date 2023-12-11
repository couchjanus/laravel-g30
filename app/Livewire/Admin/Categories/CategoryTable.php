<?php

namespace App\Livewire\Admin\Categories;

use App\Livewire\Column;
use App\Livewire\Table;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Category;

class CategoryTable extends Table
{
    public $route_edit = 'categories.edit';

    public function query():Builder
    {
        return Category::query();
    }

    public function deleteItem(int $id)
    {
        $category = Category::find($id);
        $category->delete();
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
