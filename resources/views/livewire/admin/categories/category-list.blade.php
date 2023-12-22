<!-- resources/views/livewire/admin/category-list.blade.php -->
<div>

    <x-slot name="header">
        <div class="flex justify-between">
            <h1 class="text-3xl text-black pb-6">Categories management</h1> 
            <div class="flex">
                <x-button href="{{ route('categories.create') }}">Create New</x-button>
                <x-button href="{{ route('brands.trashed') }}" color="orange">Trashed brands</x-button>
            </div>
        </div>
    </x-slot>

    
    <div class="flex flex-col min-w-0 flex-1 overflow-hidden">
        @livewire('admin.categories.category-table')
        
    </div>
    

</div>
