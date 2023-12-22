<div>
    <x-slot name="header">
        <div class="flex justify-between">
            <h1 class="text-3xl text-black pb-6">Edit Category</h1> 
            <div class="flex">
                <x-button md href="{{ route('brands.create') }}">Not active categories</x-button>
                <x-button md href="{{ route('brands.trashed') }}" color="orange">Trashed categories</x-button>
            </div>
        </div>
    </x-slot>

    <x-errors title="Ops! There are :count validation errors:" color="orange" />

    <form wire:submit="save">
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
                <span class="inline-flex items-baseline">
                    @if ($form->oldCover)
                        <img src="{{ asset(Storage::url($form->oldCover)) }}" class="object-cover h-64">
                    @endif
                    {{----}} 
                    @if ($form->cover)
                    <img src="{{ $form->cover->temporaryUrl() }}" class="object-cover h-64 overflow-hidden"> 
                    @endif
                </span>
                </div>
                <x-admin.dropzone />
                <input id="dropzone-file" type="file" class="hidden"   wire:model="form.cover" />
            </label>
        </div> 

        <div class="mt-4">
            <x-button text="Update category" type="submit" color="blue" />
        </div>
        
    </form>
</div>

