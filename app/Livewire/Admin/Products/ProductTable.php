<?php

namespace App\Livewire\Admin\Products;

use App\Livewire\Column;
use App\Livewire\Table;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Product;

class ProductTable extends Table
{

    public $route_edit = 'products.edit';

    public function query():Builder
    {
        return Product::query();
    }

    public function deleteItem(int $id)
    {
        $product = Product::find($id);
        $product->delete();
    }

    public function columns():array
    {
        return [

            Column::make('name', 'Name'),
            Column::make('status', 'Status')->component('columns.status'),
            Column::make('created_at', 'Created At')->component('columns.human-diff'),
        ];

    }
    // public function render()
    // {
    //     return view('livewire.admin.products.product-table');
    // }
}
