<!-- resources/views/livewire/admin/product-list.blade.php -->
<div>

    <x-slot name="header">
        <div class="flex justify-between">
            <h1 class="text-3xl text-black pb-6">Products management</h1> 
            <div class="flex">
                <x-button href="{{ route('products.create') }}">Create New</x-button>
                <x-button href="{{ route('brands.trashed') }}" color="orange">Trashed brands</x-button>
            </div>
        </div>
    </x-slot>

    
    <div class="flex flex-col min-w-0 flex-1 overflow-hidden">
        @livewire('admin.products.product-table')
        
    </div>
    

</div>
