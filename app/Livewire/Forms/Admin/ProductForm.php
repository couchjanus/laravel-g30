<?php

namespace App\Livewire\Forms\Admin;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\{Category, Brand, Product};
use Illuminate\Support\Facades\Storage;

class ProductForm extends Form
{
    public ?Product $product;

    #[Validate('required|min:5')]
    public $name='';

    #[Validate('required')]
    public $price = 0;

    #[Validate('required|min:5')]
    public $description='';

    #[Validate('required|integer')]
    public $status=true;

    #[Validate('required|image|max:1024')]
    public $cover;

    public $oldCover;

    #[Validate('required|integer')]
    public $category_id;

    #[Validate('required|integer')]
    public $brand_id;

    public function setProduct(Product $product)
    {
        $this->product = $product;
        $this->name = $product->name;
        $this->price = $product->price;
        $this->category_id = $product->category_id;
        $this->brand_id = $product->brand_id;
        $this->description = $product->description;
        $this->status = $product->status;
        $this->oldCover = $product->cover;
    }

    public function store()
    {
        $validated = $this->validate();
        // dd($validated);
        $this->cover = $this->cover->store('products', 'public');
        Product::create($this->all());

    }

    public function update()
    {
        $this->validate();

        if ($this->cover->getClientOriginalName()) {

            if ($this->oldCover !== null && Storage::disk('public')->exists($this->oldCover)) {
                Storage::disk('public')->delete($this->oldCover);
            }

            $this->cover = $this->cover->store('products', 'public');
        }

        $this->product->update(
            $this->all()
        );
    }

}
