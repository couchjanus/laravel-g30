<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Modelable;

class ButtonGroup extends Component
{
    #[Modelable] 
    public $value = '';

    public function render()
    {
        return view('livewire.admin.button-group');
    }
}
