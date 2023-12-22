<!-- resources/views/livewire/admin/index.blade.php -->
<div>

    <x-slot name="header">
        <div class="flex justify-between">
            <h1 class="text-3xl text-black pb-6">Users management</h1> 
            <div class="flex">
                <x-button href="{{ route('brands.create') }}">Create New</x-button>
                <x-button href="{{ route('brands.trashed') }}" color="orange">Trashed brands</x-button>
            </div>
        </div>
    </x-slot>

    <div class="w-full mt-12">
        <p class="text-xl pb-3 flex items-center">
            <i class="fas fa-list mr-3"></i> All Users
        </p>

        <div class="bg-white overflow-auto">
            
            
        </div>

    </div>


</div>
