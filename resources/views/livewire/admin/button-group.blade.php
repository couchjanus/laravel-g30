<div class="flex">
    <x-button href="{{ route('categories.edit', $value->id) }}" color="green">Edit</x-button>
    <x-button wire:click="deleteCategory({{ $value->id }})" color="red">Delete</x-button>
</div>  
