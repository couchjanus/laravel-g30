<?php

namespace App\Livewire\Forms\Admin;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Tag;

class TagForm extends Form
{
    public ?Tag $tag;

    #[Validate('required|min:5')]
    public $name = '';
 
    #[Validate('required')]
    public $text_color = '#ffffff';

    #[Validate('required')]
    public $bg_color = '#ff0000';
   
    public function setTag(Tag $tag)
    {
        $this->tag = $tag;
        $this->name = $tag->name;
        $this->text_color = $tag->text_color;
        $this->bg_color = $tag->bg_color;
    }
 
    public function store() 
    {
        $validated = $this->validate();
        
        // dd($validated);
       
        Tag::create($this->all());
    }

    public function update()
    {
        $validated = $this->validate();

        $this->tag->update(
            $this->all()
        );
    }
    
}
