<?php

namespace App\Livewire\Forms\Admin;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryForm extends Form
{
    public Category $category;

    #[Validate('required|min:5')]
    public $name='';

    #[Validate('required|min:5')]
    public $description='';

    #[Validate('required|boolean')]
    public $status=true;

    #[Validate('required|image|max:1024')]
    public $cover;

    public $oldCover;

    public function setCategory(Category $category)
    {
        $this->category = $category;
        $this->name = $category->name;
        $this->description = $category->description;
        $this->status = $category->status;
        $this->oldCover = $category->cover;
    }

    public function store() 
    {
        $this->validate();
        $this->cover = $this->cover->store('categories', 'public');
        Category::create($this->all());

    }

    public function update() 
    {
        $this->validate();

        if ($this->cover->getClientOriginalName()) {

            if ($this->oldCover !== null && Storage::disk('public')->exists($this->oldCover)) {
                Storage::disk('public')->delete($this->oldCover);
            }

            $this->cover = $this->cover->store('categories', 'public');
        }

        $this->category->update(
            $this->all()
        );
    }
    
}
