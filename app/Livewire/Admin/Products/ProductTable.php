<?php

namespace App\Livewire\Admin\Products;

use App\Livewire\Table;
use App\Models\{Product, Category};
use App\Livewire\Column;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class ProductTable extends Table
{
    public Collection $categories;
    public string $searchQuery = '';

    public function mount(): void
    {
        $this->categories = Category::pluck('name', 'id');
    }

    public function updating($key): void
    {
        if ($key === 'searchQuery') {
            $this->resetPage();
        }
    }

    public function query() : Builder
    {
        return Product::with('category')
            ->when($this->searchQuery !== '', fn(Builder $query) => $query->where('name', 'like', '%'. $this->searchQuery .'%'));

    }

    public function category($id)
    {
        return App\Models\Product::find($id)->category->name;
    }

    public function columns() : array
    {
        return [
            Column::make('name', 'Name'),
            // Column::make('categoryName', 'Category'),
            Column::make('category_id', 'Category')->component('columns.category'),
            Column::make('status', 'Status')->component('columns.status'),
            Column::make('created_at', 'Created At')->component('columns.human-diff'),
            
        ];
    }

    public $route_edit = 'products.edit';

    public function deleteItem($id)
    {
        $product = Product::find($id);
 
        $product->delete();
    }

    public function forceDeleteItem(int $id){
        Product::withTrashed()->find($id)->forceDelete();
 
    }

    public function restoreItem(int $id){
        $product = Product::withTrashed()->where('id', $id)->restore();
    }

}
