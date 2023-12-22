<?php

namespace App\Livewire\Admin\Products;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Livewire\Forms\Admin\ProductForm;
use Livewire\WithFileUploads;
use App\Models\{Product, Category, Brand};
use App\Enums\ProductStatus;

#[Title('Edit Product')]
class UpdateProduct extends Component
{
    use WithFileUploads;

    public ProductForm $form;
    public Array $categories;
    public Array $brands;
    public Array $productStatus;

    public function mount(Product $product)
    {
        $this->form->setProduct($product);
        $this->categories = Category::all('id', 'name')->toArray();
        $this->brands = Brand::all('id', 'name')->toArray();
        $this->productStatus = ProductStatus::asArray();
    }

    public function save()
    {
        $this->form->update();

        return $this->redirect('/admin/products');
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.products.update-product');
    }
}
