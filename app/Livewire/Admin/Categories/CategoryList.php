<?php

namespace App\Livewire\Admin\Categories;

use Livewire\Component;
use Livewire\Attributes\{Layout, Title};

#[Title('Categories List')]
class CategoryList extends Component
{
    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.categories.category-list');
    }
}
