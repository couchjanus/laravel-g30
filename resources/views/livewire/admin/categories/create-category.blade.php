<div>
    <x-slot name="header">
        <div class="flex justify-between">
            <h1 class="text-3xl text-black pb-6">Create New Category</h1> 
            <div class="flex">
                <x-button md href="{{ route('brands.create') }}">Not active categories</x-button>
                <x-button md href="{{ route('brands.trashed') }}" color="orange">Trashed categories</x-button>
            </div>
        </div>
    </x-slot>

    @if($success)
        <span class="block mb-4 text-green-500">Post saved successfully.</span>
    @endif

    <x-errors title="Ops! There are :count validation errors:" color="orange" />

    <form method="POST" wire:submit="save">
        <div>
            <x-input label="Name *" hint="Insert category name" wire:model.blur="form.name" />
        </div>

        <div class="mt-4">
            <x-textarea label="Description *" wire:model.blur="form.description" />
        </div>
        
        <div class="mt-4">
            <x-toggle label="Category status:" position="left" wire:model="form.status" />
        </div>

        <div class="flex items-center justify-center w-full mt-4">
            
            <label for="dropzone-file" class=<x-admin.label-dropzone />>
                <div class="flex-col flex-1 items-center pt-5 pb-6">
                    @if ($form->cover)
                        <img src="{{ $form->cover->temporaryUrl() }}" class="object-cover h-48 w-96">
                    @endif        
                </div>
                <x-admin.dropzone />
                <input id="dropzone-file" type="file" class="hidden"   wire:model="form.cover" />
            </label>
        </div> 

        <div class="flex items-center justify-center w-full mt-4">
            
            <label for="dropzone-file" class="flex items-center justify-between w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
            
                <div class="flex-col flex-1 items-center pt-5 pb-6">
                @if ($form->cover)
                    <img src="{{ $form->cover->temporaryUrl() }}" class="object-cover h-48 w-96">
                @endif        
                </div>
                <div class="flex-col flex-1 items-center  pt-5 pb-6">
                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                    </svg>
                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                </div>
            
                <input id="dropzone-file" type="file" class="hidden"   wire:model="form.cover" />
            </label>

        </div>


        <div class="mt-4">
            <x-button text="Create New" type="submit" color="blue" />
        </div>
        
    </form>
</div>
