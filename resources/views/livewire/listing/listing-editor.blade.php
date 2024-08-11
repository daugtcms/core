<div>
    <x-daugt::layouts.dashboard-bar>
        <x-daugt::tabs.tabs>
            @foreach($listings as $listing)
                <x-daugt::tabs.item
                        wire:click="setCurrentListing({{$listing->id}})"
                        :active="$listing->id === $currentListing->id"
                >
                    {{$listing->name}}
                </x-daugt::tabs.item>
            @endforeach
        </x-daugt::tabs.tabs>
        <x-daugt::form.button
                wire:click="$dispatch('openModal', { component: 'daugt::listing.edit-listing' })"
                class="flex-shrink-0 ml-2">
            {{__('daugt::general.add')}}
            @svg('plus', 'w-5 h-5')
        </x-daugt::form.button>
    </x-daugt::layouts.dashboard-bar>
    @if($currentListing)
        <div class="text-neutral-700 block flex-col overflow-y-auto p-2 max-w-3xl mx-auto">

            <div class="bg-neutral-50 rounded-md border border-neutral-200 p-2 w-full">
                <x-daugt::form.label>{{__('daugt::general.description')}}</x-daugt::form.label>
                {{$currentListing->description}}
                @empty($currentListing->description)
                    <span class="text-neutral-500 italic">{{__('daugt::general.no_value_available')}}</span>
                @endempty
                <div class="flex gap-x-2 justify-end">
                    <x-daugt::form.button
                            wire:click="$dispatch('openModal', { component: 'daugt::listing.edit-listing', arguments: { listing: {{$currentListing->id}} } })"
                    >@svg('pencil', 'w-5 h-5'){{__('daugt::general.edit')}}</x-daugt::form.button>
                    <x-daugt::form.button
                            style="danger"
                            wire:click="deleteListing({{$currentListing->id}})"
                            onclick="confirm('{{__('daugt::listing.delete_list_confirmation')}}') || event.stopImmediatePropagation()">@svg('trash-2', 'w-5 h-5'){{__('daugt::general.delete')}}</x-daugt::form.button>
                </div>
            </div>

            <x-daugt::form.label
                    class="mt-3 mb-1">{{__('daugt::listing.listing_items')}}</x-daugt::form.label>
            <ul wire:sortable="updateItemOrder" wire:sortable.options="{ animation: 100 }"
                @beforeunload.window="{{$this->unsavedChanges() ? '$event.preventDefault(); $event.returnValue = \'\'' : 'true'}}">
                @foreach($items as $key => $item)
                    <div class="bg-neutral-50 rounded-md border border-neutral-200 p-2 w-72 my-2"
                         wire:sortable.item="{{ $item->uuid }}" wire:key="task-{{ $item->uuid }}">
                        <div class="flex justify-between min-w-0 w-full">
                            <div class="inline-flex items-center gap-x-1 font-medium flex-grow min-w-0">
                                <x-daugt::form.icon-button icon="grip-vertical"
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
                                        <span class="text-neutral-500 italic truncate">{{__('daugt::general.no_value_available')}}wadawdawd awdadwaw</span>
                                    @endisset
                                </span>
                            </div>
                            <div class="flex-shrink-0 inline-flex gap-x-1">
                                <x-daugt::form.icon-button icon="pencil"
                                                              wire:click="setCurrentItem('{{$item->uuid}}')"/>
                                <x-daugt::form.icon-button icon="trash-2" style="danger"
                                                              wire:click="removeItem('{{$item->uuid}}')"/>
                            </div>
                        </div>
                        @if(!empty($currentItem->uuid) && $currentItem->uuid === $item->uuid)
                            <div class="py-1.5 gap-y-1 flex flex-col">
                                <div>
                                    <x-daugt::form.label
                                            for="name">{{__('daugt::general.name')}}</x-daugt::form.label>
                                    <x-daugt::form.input id="name"
                                                            wire:model.blur="currentItem.name"
                                                            :error="$errors->first('currentItem.name')"></x-daugt::form.input>
                                </div>
                                <div>
                                    <x-daugt::form.label
                                            for="description">{{__('daugt::general.description')}}</x-daugt::form.label>
                                    <x-daugt::form.textarea id="description"
                                                               wire:model.blur="currentItem.description"></x-daugt::form.textarea>
                                </div>

                                @if(isset($currentListing->type) && isset(\Daugt\Misc\ListingTypeRegistry::getListingType($currentListing->type)->itemAttributes))
                                    <div class="flex flex-col gap-y-2">
                                        @foreach(\Daugt\Misc\ListingTypeRegistry::getListingType($currentListing->type)->itemAttributes as $key => $attribute)
                                            <div>
                                                <x-daugt::blocks.attribute-input
                                                        :attribute="$attribute"
                                                        :key="'data.' . $attribute->name"
                                                        wire:model.live="currentItem.data.{{$key}}"
                                                />
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                {{--
                                @if($currentListing->usage == \Daugt\Enums\Listing\ListingUsage::NAVIGATION->value)
                                    <div>
                                        <x-daugt::form.label
                                                for="url">{{__('daugt::general.url')}}</x-daugt::form.label>
                                        <x-daugt::form.input id="url"
                                                                 wire:model.blur="currentItem.data.url"
                                                                 :error="$errors->first('currentItem.data.url')"
                                        ></x-daugt::form.input>
                                    </div>
                                    <div class="mt-2.5">
                                        <x-daugt::form.checkbox
                                                name="target"
                                                wire:model.live="currentItem.data.target"
                                                value="_blank"
                                                :checked="isset($currentItem->data['target']) ? $currentItem->data['target'] == '_blank' : false"
                                        >{{__('daugt::listing.open_in_new_tab')}}</x-daugt::form.checkbox>
                                    </div>
                                @elseif($currentListing->usage == \Daugt\Enums\Listing\ListingUsage::COURSE->value)
                                    <div class="flex flex-col gap-y-2 mt-2">
                                        <x-daugt::form.checkbox name="users_can_comment" wire:model="currentItem.data.users_can_comment">{{__('daugt::content.users_can_comment')}}</x-daugt::form.checkbox>
                                        <x-daugt::form.checkbox name="users_can_post" wire:model="currentItem.data.users_can_post">{{__('daugt::content.users_can_post')}}</x-daugt::form.checkbox>
                                        <x-daugt::form.checkbox name="users_can_post_anonymously" wire:model="currentItem.data.users_can_post_anonymously">{{__('daugt::content.users_can_post_anonymously')}}</x-daugt::form.checkbox>
                                    </div>
                                @endif
                                --}}
                            </div>
                        @endif
                    </div>
                @endforeach
            </ul>
            <div class="flex flex-col">
                <x-daugt::form.button class="w-72 mt-3" style="light" wire:click="addItem()" x-data
                                         x-mousetrap.n="$wire.addItem()"
                                         :disabled="!$errors->isEmpty()">
                    @svg('plus')
                    {{__('daugt::general.add_element')}}
                </x-daugt::form.button>
                <x-daugt::form.button class="w-72 mt-3" style="primary" wire:click="saveItems()"
                                         :disabled="!$errors->isEmpty()">
                    {{__('daugt::general.save')}}
                </x-daugt::form.button>
            </div>

        </div>
    @endif
</div>