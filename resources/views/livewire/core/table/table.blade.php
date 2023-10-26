<div class="w-full">
    <div class="relative overflow-x-auto sm:rounded-lg">
        <table class="w-full text-sm text-left text-neutral-500">
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
                <tr class="bg-white hover:bg-neutral-50">
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