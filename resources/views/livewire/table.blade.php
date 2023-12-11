<div class="flex flex-col gap-5">
 <div class="relative overflow-x-auto shadow-md rounded-lg">
   <table class="w-full text-sm text-left text-gray-500">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
       <tr>
         @foreach($this->columns() as $column)
           <th>
             <div class="py-3 px-6 flex items-center">
               {{ $column->label }}
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
                    <x-dynamic-component :component="$column->component"  :value="$row[$column->key]" />
                    </div>
                </td>
                @endforeach
                <td>
                    <div class="flex">
                        <x-button href="{{ route($this->route_edit, $row->id) }}" color="green">Edit</x-button>
                        <x-button wire:click="deleteItem({{ $row->id }})" color="red">Delete</x-button>
                    </div>
                </td>


        </tr>
      @endforeach
    </tbody>
   </table>
 </div>
 {{ $this->data()->links() }}
</div>
