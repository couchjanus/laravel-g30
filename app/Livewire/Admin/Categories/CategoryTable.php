<?php

namespace App\Livewire\Admin\Categories;

use App\Livewire\Column;
use App\Livewire\Table;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Category;

class CategoryTable extends Table
{
    public function query():Builder
    {
        return Category::query();
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
