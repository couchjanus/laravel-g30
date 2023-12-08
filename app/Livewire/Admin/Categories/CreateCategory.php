<?php

namespace App\Livewire\Admin\Categories;

use Livewire\Component;
use Livewire\Attributes\{Layout, Title};
use App\Livewire\Forms\Admin\CategoryForm;
use Livewire\WithFileUploads;

#[Title('Create Category')]
class CreateCategory extends Component
{
    use WithFileUploads;
    
    public CategoryForm $form;

    public function save() 
    {
        $this->form->store();
        return $this->redirect('/admin/categories');
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.categories.create-category');
    }
}
