<div class="mx-auto max-w-7xl sm:px-4 py-4">
    <div class="w-full flex justify-between items-center py-2.5">
        <x-sitebrew::form.input class="opacity-0 pointer-events-none h-[34px] max-w-xs" placeholder="{{__('sitebrew::general.search_items')}}"> </x-sitebrew::form.input>
        @if($allowCreate)
            <x-sitebrew::form.button style="light" wire:click="add()" class="flex-shrink-0 h-full">@svg('plus', 'w-4 h-4'){{__('sitebrew::general.add_element')}}</x-sitebrew::form.button>
        @endif
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
                                        :value="!empty($column->key) ? $row[$column->key] : $row"
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