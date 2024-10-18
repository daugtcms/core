<div class="@if($fullWidth) w-full @else mx-auto max-w-7xl sm:px-4 py-4 @endif">
    @if($allowCreate && !$readonly)
        <div class="w-full flex justify-between items-center py-2.5">
            <x-daugt::form.input class="opacity-0 pointer-events-none h-[34px] max-w-xs"
                                    placeholder="{{__('daugt::general.search_items')}}"></x-daugt::form.input>
            <x-daugt::form.button type="button" style="light" wire:click="add()"
                                  class="flex-shrink-0 h-full"><div class="i-lucide:plus w-4 h-4"></div>{{__('daugt::general.add_element')}}</x-daugt::form.button>
        </div>
    @endif

    <div class="relative overflow-x-auto sm:rounded-lg">
        <table class="w-full text-sm text-left text-neutral-700">
            <thead class="text-xs text-gray-700 uppercase bg-neutral-100 sticky top-0">
            <tr>
                @if($selectable)
                    <th></th>
                @endif
                @foreach($this->columns() as $column)
                    @if($readonly && in_array($column->component, \Daugt\Livewire\Table\Column::$modifierColumns))
                        @continue
                    @endif
                    <th>
                        <div class="py-2 px-3 flex items-center whitespace-nowrap">
                            {{ $column->label }}
                        </div>
                    </th>
                @endforeach
            </tr>
            </thead>
            <tbody class="divide-y-2 divide-neutral-100" @if($sortable) wire:sortable="updateSortOrder"
                   wire:sortable.options="{ animation: 100 }" @endif>
            @foreach($this->data() as $row)
                <tr @class([
                        'bg-neutral-50/50 hover:bg-neutral-50',
                        'bg-primary-50/50 hover:bg-primary-50' => in_array($row['id'],$selected) ])
                    @if($sortable) wire:sortable.item="{{ $row['id'] }}" wire:key="task-{{ $row['id'] }}" @endif>
                    @if($selectable)
                        <td>
                            <div class="py-2 px-3 flex items-center">
                                <x-daugt::form.checkbox name="selected-{{$row['id']}}"
                                                           wire:model.live="selected.{{ $row['id'] }}"></x-daugt::form.checkbox>
                            </div>
                        </td>
                    @endif
                    @foreach($this->columns() as $column)
                        @if($readonly && in_array($column->component, \Daugt\Livewire\Table\Column::$modifierColumns))
                            @continue
                        @endif
                        <td>
                            <div class="py-2 px-3 flex items-center cursor-pointer">
                                <x-dynamic-component
                                        :component="$column->component"
                                        :value="!empty($column->key) ? $row[$column->key] : $row"
                                        :readonly="$readonly"
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