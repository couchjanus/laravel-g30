<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;

use Livewire\WithPagination;

abstract class Table extends Component
{
    use WithPagination;

    public $perPage = 10;

    public $page = 1;

    public $sortBy = '';

    public $sortDirection = 'asc';

    public $filter = 0;

    public abstract function query() : Builder;
    public abstract function columns() : array;
    public abstract function deleteItem(int $id);
    public abstract function forceDeleteItem(int $id);
    public abstract function restoreItem(int $id);
    

    public $filters = [
        ['label' => 'Choose One', 'value' => 0],
        ['label' => 'With trashed', 'value' => 1],
        ['label' => 'Without trashed', 'value' => 2],
        ['label' => 'Only trashed', 'value' => 3],
    ];


    public function data()
    {
        return $this
        ->query()
        ->when($this->sortBy !== '', function ($query) {
            $query->orderBy($this->sortBy, $this->sortDirection);
        })
        ->when($this->filter != 0 , function (Builder $query) {
            switch($this->filter) {
                case "1":
                    $query->withTrashed();
                    break;
                case "2":
                    $query->withoutTrashed();
                    break;
                case "3":
                    $query->onlyTrashed();
                    break;
            }

        })
        ->paginate($this->perPage);
    }

    
    public function sort($key) {
        $this->resetPage();
      
        if ($this->sortBy === $key) {
            $direction = $this->sortDirection === 'asc' ? 'desc' : 'asc';
            $this->sortDirection = $direction;
      
            return;
        }
      
        $this->sortBy = $key;
        $this->sortDirection = 'asc';
    }
    
    public function filterTable($key) {
        $this->resetPage();

        $this->filter = $key;
        
    }
  
    public function render()
    {
        return view('livewire.table');
    }
}
