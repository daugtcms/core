<div>
    <x-site-core::layouts.dashboard-bar>
        <x-site-core::core.tabs>
            @foreach($navigations as $navigation)
                <x-site-core::core.tabs.item
                        wire:click="setCurrentNavigation({{$navigation->id}})"
                        :active="$navigation->id === $currentNavigation->id"
                >
                    {{$navigation->name}}
                </x-site-core::core.tabs.item>
            @endforeach
        </x-site-core::core.tabs>
        <x-site-core::core.button
                wire:click="$dispatch('openModal', { component: 'site-core::navigation.edit-navigation' })"
                class="flex-shrink-0 ml-2">
            {{__('site-core::general.add')}}
            @svg('plus', 'w-5 h-5')
        </x-site-core::core.button>
    </x-site-core::layouts.dashboard-bar>
    @if($currentNavigation)
        <div class="text-neutral-700 block flex-col overflow-y-auto p-2 max-w-3xl mx-auto">

            <div class="bg-neutral-50 rounded-md border border-neutral-200 p-2 w-full">
                <x-site-core::form.label>{{__('site-core::general.description')}}</x-site-core::form.label>
                {{$currentNavigation->description}}
                @empty($currentNavigation->description)
                    <span class="text-neutral-500 italic">{{__('site-core::general.no_value_available')}}</span>
                @endempty
                <div class="flex gap-x-2 justify-end">
                    <x-site-core::core.button
                            wire:click="$dispatch('openModal', { component: 'site-core::navigation.edit-navigation', arguments: { navigation: {{$currentNavigation->id}} } })"
                    >@svg('pencil', 'w-5 h-5'){{__('site-core::general.edit')}}</x-site-core::core.button>
                    <x-site-core::core.button
                            style="danger"
                            wire:click="deleteNavigation({{$currentNavigation->id}})"
                            onclick="confirm('{{__('site-core::navigation.delete_navigation_confirmation')}}') || event.stopImmediatePropagation()">@svg('trash-2', 'w-5 h-5'){{__('site-core::general.delete')}}</x-site-core::core.button>
                </div>
            </div>

            <x-site-core::form.label
                    class="mt-3 mb-1">{{__('site-core::navigation.navigation_items')}}</x-site-core::form.label>
            <ul wire:sortable="updateItemOrder" wire:sortable.options="{ animation: 100 }"
                @beforeunload.window="{{$this->unsavedChanges() ? '$event.preventDefault(); $event.returnValue = \'\'' : 'true'}}">
                @foreach($items as $key => $item)
                    <div class="bg-neutral-50 rounded-md border border-neutral-200 p-2 w-72 my-2"
                         wire:sortable.item="{{ $item->uuid }}" wire:key="task-{{ $item->uuid }}">
                        <div class="flex justify-between min-w-0 w-full">
                            <div class="inline-flex items-center gap-x-1 font-medium flex-grow min-w-0">
                                <x-site-core::core.icon-button icon="grip-vertical"
                                                               wire:sortable.handle/>
                                <span class="truncate inline-flex items-center gap-x-2">
                                    @if(!empty($item->icon))
                                        <div class="flex-shrink-0">
                                            @svg($item->icon)
                                        </div>
                                    @endif
                                    @if(!empty($item->name))
                                        {{$item->name}}
                                    @else
                                        <span class="text-neutral-500 italic truncate">{{__('site-core::general.no_value_available')}}wadawdawd awdadwaw</span>
                                    @endisset
                                </span>
                            </div>
                            <div class="flex-shrink-0 inline-flex gap-x-1">
                                <x-site-core::core.icon-button icon="pencil"
                                                               wire:click="setCurrentItem('{{$item->uuid}}')"/>
                                <x-site-core::core.icon-button icon="trash-2" style="danger"
                                                               wire:click="removeItem('{{$item->uuid}}')"/>
                            </div>
                        </div>
                        @if(!empty($currentItem->uuid) && $currentItem->uuid === $item->uuid)
                            <div class="py-1.5 gap-y-1 flex flex-col">
                                <div>
                                    <x-site-core::form.label
                                            for="name">{{__('site-core::general.name')}}</x-site-core::form.label>
                                    <x-site-core::form.input id="name"
                                                             wire:model.blur="currentItem.name"
                                                             :error="$errors->first('currentItem.name')"></x-site-core::form.input>
                                </div>
                                <div>
                                    <x-site-core::form.label
                                            for="url">{{__('site-core::general.url')}}</x-site-core::form.label>
                                    <x-site-core::form.input id="url"
                                                             wire:model.blur="currentItem.url"
                                                             :error="$errors->first('currentItem.url')"
                                    ></x-site-core::form.input>
                                </div>
                                <div>
                                    <x-site-core::form.label
                                            for="description">{{__('site-core::general.description')}}</x-site-core::form.label>
                                    <x-site-core::form.textarea id="description"
                                                                wire:model.blur="currentItem.description"></x-site-core::form.textarea>
                                </div>
                                <div>
                                    <x-site-core::form.label
                                            for="icon">{{__('site-core::general.icon')}}</x-site-core::form.label>
                                    <x-site-core::form.icon-picker id="icon"
                                                                   wire:model.live="currentItem.icon"></x-site-core::form.icon-picker>
                                </div>
                                <div class="mt-2.5">
                                    <x-site-core::form.checkbox
                                            name="target"
                                            wire:model.live="currentItem.target"
                                            value="_blank"
                                            :checked="$currentItem->target == '_blank'"
                                    >{{__('site-core::navigation.open_in_new_tab')}}</x-site-core::form.checkbox>
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </ul>
            <div class="flex flex-col">
                <x-site-core::core.button class="w-72 mt-3" style="light" wire:click="addItem()" x-data
                                          x-mousetrap.n="$wire.addItem()"
                                          :disabled="!$errors->isEmpty()">
                    @svg('plus')
                    {{__('site-core::general.add_element')}}
                </x-site-core::core.button>
                <x-site-core::core.button class="w-72 mt-3" style="secondary" wire:click="saveItems()"
                                          :disabled="!$errors->isEmpty()">
                    {{__('site-core::general.save')}}
                </x-site-core::core.button>
            </div>

        </div>
    @endif
</div>