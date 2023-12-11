<?php

namespace App\Livewire\Admin\Products;

use Livewire\Component;
use Livewire\Attributes\{Layout, Title};
use App\Livewire\Forms\Admin\ProductForm;
use Livewire\WithFileUploads;
use App\Models\{Category, Brand};
use App\Enums\ProductStatus;

#[Title('Create Product')]
class CreateProduct extends Component
{
    use WithFileUploads;

    public ProductForm $form;
    public Array $categories;
    public Array $brands;
    public Array $productStatus;

    public function mount(): void
    {
        $this->categories = Category::all('id', 'name')->toArray();
        $this->brands = Brand::all('id', 'name')->toArray();
        $this->productStatus = ProductStatus::asArray();
    }


    public function save()
    {
        $this->form->store();
        return $this->redirect('/admin/products');
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.products.create-product');
    }
}
