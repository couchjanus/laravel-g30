<?php

namespace App\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

abstract class Table extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $page = 1;

    public abstract function query():Builder;
    public abstract function columns():array;
    public abstract function deleteItem(int $id);

    public function data()
    {
        return $this
        ->query()
        // ->get();
        ->paginate($this->perPage);
    }
    public function render()
    {
        return view('livewire.table');
    }
}
