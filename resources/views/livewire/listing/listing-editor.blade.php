<div>
    <x-sitebrew::layouts.dashboard-bar>
        <x-sitebrew::tabs.tabs>
            @foreach($listings as $listing)
                <x-sitebrew::tabs.item
                        wire:click="setCurrentListing({{$listing->id}})"
                        :active="$listing->id === $currentListing->id"
                >
                    {{$listing->name}}
                </x-sitebrew::tabs.item>
            @endforeach
        </x-sitebrew::tabs.tabs>
        <x-sitebrew::form.button
                wire:click="$dispatch('modal.open', { component: 'sitebrew::listing.edit-listing' })"
                class="flex-shrink-0 ml-2">
            {{__('sitebrew::general.add')}}
            @svg('plus', 'w-5 h-5')
        </x-sitebrew::form.button>
    </x-sitebrew::layouts.dashboard-bar>
    @if($currentListing)
        <div class="text-neutral-700 block flex-col overflow-y-auto p-2 max-w-3xl mx-auto">

            <div class="bg-neutral-50 rounded-md border border-neutral-200 p-2 w-full">
                <x-sitebrew::form.label>{{__('sitebrew::general.description')}}</x-sitebrew::form.label>
                {{$currentListing->description}}
                @empty($currentListing->description)
                    <span class="text-neutral-500 italic">{{__('sitebrew::general.no_value_available')}}</span>
                @endempty
                <div class="flex gap-x-2 justify-end">
                    <x-sitebrew::form.button
                            wire:click="$dispatch('modal.open', { component: 'sitebrew::listing.edit-listing', arguments: { listing: {{$currentListing->id}} } })"
                    >@svg('pencil', 'w-5 h-5'){{__('sitebrew::general.edit')}}</x-sitebrew::form.button>
                    <x-sitebrew::form.button
                            style="danger"
                            wire:click="deleteListing({{$currentListing->id}})"
                            onclick="confirm('{{__('sitebrew::listing.delete_list_confirmation')}}') || event.stopImmediatePropagation()">@svg('trash-2', 'w-5 h-5'){{__('sitebrew::general.delete')}}</x-sitebrew::form.button>
                </div>
            </div>

            <x-sitebrew::form.label
                    class="mt-3 mb-1">{{__('sitebrew::listing.listing_items')}}</x-sitebrew::form.label>
            <ul wire:sortable="updateItemOrder" wire:sortable.options="{ animation: 100 }"
                @beforeunload.window="{{$this->unsavedChanges() ? '$event.preventDefault(); $event.returnValue = \'\'' : 'true'}}">
                @foreach($items as $key => $item)
                    <div class="bg-neutral-50 rounded-md border border-neutral-200 p-2 w-72 my-2"
                         wire:sortable.item="{{ $item->uuid }}" wire:key="task-{{ $item->uuid }}">
                        <div class="flex justify-between min-w-0 w-full">
                            <div class="inline-flex items-center gap-x-1 font-medium flex-grow min-w-0">
                                <x-sitebrew::form.icon-button icon="grip-vertical"
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
                                        <span class="text-neutral-500 italic truncate">{{__('sitebrew::general.no_value_available')}}wadawdawd awdadwaw</span>
                                    @endisset
                                </span>
                            </div>
                            <div class="flex-shrink-0 inline-flex gap-x-1">
                                <x-sitebrew::form.icon-button icon="pencil"
                                                               wire:click="setCurrentItem('{{$item->uuid}}')"/>
                                <x-sitebrew::form.icon-button icon="trash-2" style="danger"
                                                               wire:click="removeItem('{{$item->uuid}}')"/>
                            </div>
                        </div>
                        @if(!empty($currentItem->uuid) && $currentItem->uuid === $item->uuid)
                            <div class="py-1.5 gap-y-1 flex flex-col">
                                <div>
                                    <x-sitebrew::form.label
                                            for="name">{{__('sitebrew::general.name')}}</x-sitebrew::form.label>
                                    <x-sitebrew::form.input id="name"
                                                             wire:model.blur="currentItem.name"
                                                             :error="$errors->first('currentItem.name')"></x-sitebrew::form.input>
                                </div>
                                <div>
                                    <x-sitebrew::form.label
                                            for="description">{{__('sitebrew::general.description')}}</x-sitebrew::form.label>
                                    <x-sitebrew::form.textarea id="description"
                                                               wire:model.blur="currentItem.description"></x-sitebrew::form.textarea>
                                </div>

                                @if(isset($currentListing->type) && isset(\Sitebrew\Misc\ListingTypeRegistry::getListingType($currentListing->type)->itemAttributes))
                                    <div class="flex flex-col gap-y-2">
                                        @foreach(\Sitebrew\Misc\ListingTypeRegistry::getListingType($currentListing->type)->itemAttributes as $key => $attribute)
                                            <div>
                                                <x-sitebrew::blocks.attribute-input
                                                        :attribute="$attribute"
                                                        :key="'data.' . $attribute->name"
                                                        wire:model.live="currentItem.data.{{$key}}"
                                                />
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                {{--
                                @if($currentListing->usage == \Sitebrew\Enums\Listing\ListingUsage::NAVIGATION->value)
                                    <div>
                                        <x-sitebrew::form.label
                                                for="url">{{__('sitebrew::general.url')}}</x-sitebrew::form.label>
                                        <x-sitebrew::form.input id="url"
                                                                 wire:model.blur="currentItem.data.url"
                                                                 :error="$errors->first('currentItem.data.url')"
                                        ></x-sitebrew::form.input>
                                    </div>
                                    <div class="mt-2.5">
                                        <x-sitebrew::form.checkbox
                                                name="target"
                                                wire:model.live="currentItem.data.target"
                                                value="_blank"
                                                :checked="isset($currentItem->data['target']) ? $currentItem->data['target'] == '_blank' : false"
                                        >{{__('sitebrew::listing.open_in_new_tab')}}</x-sitebrew::form.checkbox>
                                    </div>
                                @elseif($currentListing->usage == \Sitebrew\Enums\Listing\ListingUsage::COURSE->value)
                                    <div class="flex flex-col gap-y-2 mt-2">
                                        <x-sitebrew::form.checkbox name="users_can_comment" wire:model="currentItem.data.users_can_comment">{{__('sitebrew::content.users_can_comment')}}</x-sitebrew::form.checkbox>
                                        <x-sitebrew::form.checkbox name="users_can_post" wire:model="currentItem.data.users_can_post">{{__('sitebrew::content.users_can_post')}}</x-sitebrew::form.checkbox>
                                        <x-sitebrew::form.checkbox name="users_can_post_anonymously" wire:model="currentItem.data.users_can_post_anonymously">{{__('sitebrew::content.users_can_post_anonymously')}}</x-sitebrew::form.checkbox>
                                    </div>
                                @endif
                                --}}
                            </div>
                        @endif
                    </div>
                @endforeach
            </ul>
            <div class="flex flex-col">
                <x-sitebrew::form.button class="w-72 mt-3" style="light" wire:click="addItem()" x-data
                                          x-mousetrap.n="$wire.addItem()"
                                          :disabled="!$errors->isEmpty()">
                    @svg('plus')
                    {{__('sitebrew::general.add_element')}}
                </x-sitebrew::form.button>
                <x-sitebrew::form.button class="w-72 mt-3" style="primary" wire:click="saveItems()"
                                          :disabled="!$errors->isEmpty()">
                    {{__('sitebrew::general.save')}}
                </x-sitebrew::form.button>
            </div>

        </div>
    @endif
</div>