<div class="mx-auto max-w-7xl sm:px-4 py-4">
    <div class="w-full flex justify-between items-center py-2.5">
        <x-sitebrew::form.input class="opacity-0 pointer-events-none h-[34px] max-w-xs" placeholder="{{__('sitebrew::general.search_items')}}"> </x-sitebrew::form.input>
        <x-sitebrew::form.button style="primary" wire:click="addElement()" class="flex-shrink-0 h-full">{{__('sitebrew::general.add_element')}}</x-sitebrew::form.button>
    </div>
    <div class="relative overflow-x-auto sm:rounded-lg">
        <table class="w-full text-sm text-left text-neutral-700">
            <thead class="text-xs text-gray-700 uppercase bg-neutral-100 sticky top-0">
            <tr>
                @foreach($this->columns() as $column)
                    <th>
                        <div class="py-2 px-3 flex items-center whitespace-nowrap">
                            {{ $column->label }}
                        </div>
                    </th>
                @endforeach
            </tr>
            </thead>
            <tbody class="divide-y-2 divide-neutral-100">
            @foreach($this->data() as $row)
                <tr class="bg-neutral-50/50 hover:bg-neutral-50">
                    @foreach($this->columns() as $column)
                        <td>
                            <div class="py-2 px-3 flex items-center cursor-pointer">
                                <x-dynamic-component
                                        :component="$column->component"
                                        :value="$row[$column->key]"
                                >
                                </x-dynamic-component>
                            </div>
                        </td>
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>