<?php

namespace App\Livewire\Main;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Title('Products List')]
#[Layout('layouts.main')]
class ProductsList extends Component
{
    public function render()
    {
        return view('livewire.main.products-list');
    }
}
