<div class="flex flex-col gap-5">
  <div class="relative overflow-x-auto shadow-md rounded-lg">
  
    <div class="flex text-sm text-left text-gray-500">
    <div class="flex-1 text-sm text-left text-gray-500">
      <input wire:model.live="searchQuery" type="search" id="search" placeholder="Search..." class="mt-1 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 ring-1 ring-inset transition duration-150 ease-in-out focus:ring-2 sm:text-sm sm:leading-6 focus:ring-primary-600 dark:bg-dark-800 dark:placeholder-dark-500 dark:text-dark-300 dark:border-dark-900 dark:ring-dark-600 dark:focus:ring-primary-600 text-gray-700 ring-gray-300">
      
    </div>
      <div class="flex-1 text-sm text-left text-gray-500">
      <x-select.native x-on:change="
        $wire.filterTable( $event.target.value )"
        :options="$filters"
        select="label:label|value:value"
      />
      </div>
      
      
    </div>
  
    <table class="w-full text-sm text-left text-gray-500">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50">
        <tr>
          @foreach($this->columns() as $column)
            <th wire:click="sort('{{ $column->key }}')">
              <div class="py-3 px-6 flex items-center">
                {{ $column->label }}
                @if($sortBy === $column->key)
                  @if ($sortDirection === 'asc')
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z"
                              clip-rule="evenodd"/>
                    </svg>
                  @else
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                              clip-rule="evenodd"/>
                    </svg>
                  @endif
                @endif
              </div>
            </th>
          @endforeach
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($this->data() as $row)
          <tr class="bg-white border-b hover:bg-gray-50">
            @foreach($this->columns() as $column)
              <td>
                <div class="py-3 px-6 flex items-center cursor-pointer">
                  <x-dynamic-component
                      :component="$column->component"
                      :value="$row[$column->key]"
                  >
                  </x-dynamic-component>
                </div>
              </td>
            @endforeach
            <td>
            @if ($this->filter != 3)
            <div class="flex">
                <x-button href="{{ route($this->route_edit, $row->id) }}" color="green">Edit</x-button>
                <x-button wire:click="deleteItem({{ $row->id }})" color="red">Delete</x-button>
            </div>
            @else
            <div class="flex">
              <x-button wire:click="restoreItem({{ $row->id }})" color="green">Restore</x-button>
              <x-button wire:click="forceDeleteItem({{ $row->id }})" color="red">Force Delete</x-button>
            </div>
            @endif
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  {{ $this->data()->links() }}
</div>

