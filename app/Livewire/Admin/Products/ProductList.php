<?php

namespace App\Livewire\Admin\Products;

use Livewire\Component;
use Livewire\Attributes\{Layout, Title};

#[Title('Product List')]
class ProductList extends Component
{
    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.products.product-list');
    }
}
