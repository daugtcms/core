<form class="p-3" wire:submit="save">
    <x-sitebrew::modal.header>{{__('sitebrew::shop.manage_product')}}</x-sitebrew::modal.header>
    <div class="flex flex-col gap-y-2">
        <div>
            <x-sitebrew::form.label for="name">{{__('sitebrew::general.name')}}</x-sitebrew::form.label>
            <x-sitebrew::form.input id="name" wire:model.blur="name" :error="$errors->first('name')"/>
        </div>
        <div>
            <x-sitebrew::form.label for="price">{{__('sitebrew::general.price')}}</x-sitebrew::form.label>
            <x-sitebrew::form.input id="price" type="number" wire:model.blur="price" step=".01"
                                    pattern="^\d*(\.\d{0,2})?$" placeholder="99,99" :error="$errors->first('price')"/>
        </div>

        <div>
            <x-sitebrew::form.label for="description">
                {{__('sitebrew::general.description')}}
                <x-slot name="additional">
                    {{__('sitebrew::shop.disclaimer_no_real_data_without_saving')}}
                </x-slot>
            </x-sitebrew::form.label>
            <x-sitebrew::form.button class="w-full" type="button" style="light" wire:click="openBlockEditor()" :disabled="empty($product->id)">{{__('sitebrew::blocks.open_block_editor')}}</x-sitebrew::form.button>
        </div>

        <div>
            @php
                $categories = \Sitebrew\Models\Listing\Listing::where('usage', \Sitebrew\Enums\Listing\ListingUsage::SHOP_CATEGORIES)->first()->items
                ->map(function (\Sitebrew\Models\Listing\ListingItem $item){
                    return [
                        'value' => $item->id,
                        'title' => $item->name
                    ];
                })->values()->toJson();
            @endphp
            <x-sitebrew::form.label for="categories">
                {{__('sitebrew::general.categories')}}
            </x-sitebrew::form.label>
            <x-sitebrew::form.multi-select :options="$categories" :multi="true" wire:model="categories"></x-sitebrew::form.multi-select>
        </div>

        <div>
            <x-sitebrew::form.label for="media">
                {{__('sitebrew::shop.product_media')}}
                <x-slot name="additional">
                    {{__('sitebrew::shop.product_media_description')}}
                </x-slot>
            </x-sitebrew::form.label>
            <x-sitebrew::form.media name="media" wire:model="media" wire:key="media"></x-sitebrew::form.media>
        </div>

        <x-sitebrew::tabs.tabs class="bg-neutral-100 mt-2 mb-1 py-1.5 px-1.5 rounded-md border-neutral-200 border-2">
            <x-sitebrew::tabs.item :active="!$isExternal"
                                   wire:click="setIsExternal(false)">{{__('sitebrew::shop.normal_shop_product')}}</x-sitebrew::tabs.item>
            <x-sitebrew::tabs.item :active="$isExternal"
                                   wire:click="setIsExternal(true)">{{__('sitebrew::shop.external_shop_product')}}</x-sitebrew::tabs.item>
        </x-sitebrew::tabs.tabs>

        @if($isExternal)
            <div>
                <x-sitebrew::form.label for="external_url">{{__('sitebrew::shop.external_product_url')}}
                    <x-slot name="additional">
                        {{__('sitebrew::shop.external_product_description')}}
                    </x-slot>
                </x-sitebrew::form.label>
                <x-sitebrew::form.input id="external_url" wire:model.blur="external_url"
                                        :error="$errors->first('external_url')"/>
            </div>
        @else
            <div>
                <x-sitebrew::form.label for="shipping">{{__('sitebrew::shop.shipping')}}
                    <x-slot name="additional">
                        {{__('sitebrew::shop.shipping_description')}}
                    </x-slot>
                </x-sitebrew::form.label>
                <x-sitebrew::form.checkbox name="shipping" wire:model.live="shipping">{{__('sitebrew::shop.shipping')}}</x-sitebrew::form.checkbox>
            </div>
            @if($shipping)
                <div>
                    <x-sitebrew::form.label for="multi">{{__('sitebrew::shop.multi_order')}}
                        <x-slot name="additional">
                            {{__('sitebrew::shop.multi_order_description')}}
                        </x-slot>
                    </x-sitebrew::form.label>
                    <x-sitebrew::form.checkbox
                            name="multi" wire:model.live="multi">{{__('sitebrew::shop.multi_order')}}</x-sitebrew::form.checkbox>
                </div>
            @endif

            <x-sitebrew::tabs.tabs class="bg-neutral-100 mt-2 mb-1 py-1.5 px-1.5 rounded-md border-neutral-200 border-2">
                <x-sitebrew::tabs.item :active="!$isCourse"
                                       wire:click="setIsCourse(false)">{{__('sitebrew::shop.contains_post')}}</x-sitebrew::tabs.item>
                <x-sitebrew::tabs.item :active="$isCourse"
                                       wire:click="setIsCourse(true)">{{__('sitebrew::shop.contains_course')}}</x-sitebrew::tabs.item>
            </x-sitebrew::tabs.tabs>
            @if(!$isCourse)
            <div>
                <x-sitebrew::form.label for="linked_post">{{__('sitebrew::shop.linked_post')}}
                    <x-slot name="additional">
                        {{__('sitebrew::shop.linked_post_description')}}
                    </x-slot>
                </x-sitebrew::form.label>
                <x-sitebrew::form.button style="light" class="w-full mb-1.5" type="button" wire:click="$dispatch('modal.open', { component: 'sitebrew::table.select-table-items', arguments: { tableName: 'sitebrew::content.content-table', dispatch: 'updateContent', 'selected': [{{$content_id}}] } })">
                    {{__('sitebrew::shop.select_post')}}
                </x-sitebrew::form.button>
                @if($content_id)
                    @livewire('sitebrew::content.content-table', ['ids' => [$content_id], 'readonly' => true, 'fullWidth' => true], key('content-table-'.$content_id))
                @endif
            </div>
            @else
            <div>
                @php
                    $courses = $courses->map(function (\Sitebrew\Models\Content\Course $course){
                        return [
                            'value' => $course->id,
                            'title' => $course->name
                        ];
                    })->values()->toJson();
                @endphp
                <x-sitebrew::form.label for="linked_post">{{__('sitebrew::shop.linked_course')}}
                    <x-slot name="additional">
                        {{__('sitebrew::shop.linked_course_description')}}
                    </x-slot>
                </x-sitebrew::form.label>
                <x-sitebrew::form.select wire:model.live="course_id" :options="$courses"></x-sitebrew::form.select>
            </div>
            <div>
                <x-sitebrew::form.label for="starts_at">{{__('sitebrew::general.starts_at')}}
                    <x-slot name="additional">{{__('sitebrew::content.leave_empty_for_continuous_access')}}</x-slot>
                </x-sitebrew::form.label>
                <x-sitebrew::form.input id="starts_at" wire:model.blur="starts_at" type="date" :error="$errors->first('starts_at')"/>
            </div>
            <div>
                <x-sitebrew::form.label for="ends_at">{{__('sitebrew::general.ends_at')}}
                    <x-slot name="additional">{{__('sitebrew::content.leave_empty_for_continuous_access')}}</x-slot>
                </x-sitebrew::form.label>
                <x-sitebrew::form.input id="ends_at" wire:model.blur="ends_at" type="date" :error="$errors->first('ends_at')"/>
            </div>
            @endif
        @endif
    </div>
    <x-sitebrew::modal.footer class="justify-end">
        <x-sitebrew::form.button style="primary">{{__('sitebrew::general.save')}}</x-sitebrew::form.button>
    </x-sitebrew::modal.footer>
</form>