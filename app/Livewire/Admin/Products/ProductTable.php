<?php

namespace App\Livewire\Admin\Products;

use App\Livewire\Column;
use App\Livewire\Table;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Product;

class ProductTable extends Table
{
    public string $searchQuery = '';



    public $route_edit = 'products.edit';

    public function query():Builder
    {
        return Product::with('category')
        ->when($this->searchQuery !== '', fn(Builder $query) => $query->where('name', 'like', '%'.$this->searchQuery.'%'));
    }

    public function updated($key):void
    {
        if ($key === 'searchQuery') {
            $this->resetPage();
        }
    }

    public function deleteItem(int $id)
    {
        $product = Product::find($id);
        $product->delete();
    }

    public  function restoreItem(int $id)
    {
        Product::withTrashed()->where('id', $id)->restore();
    }
    public  function forceDeleteItem(int $id)
    {
        Product::withTrashed()->find($id)->forceDelete();
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
