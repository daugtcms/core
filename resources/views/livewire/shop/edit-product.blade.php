<div>
    <x-daugt::layouts.dashboard-bar>
        <h1 class="text-lg font-medium text-neutral-800 flex items-center gap-x-2">{{$name ?: __('daugt::shop.manage_product')}}</h1>

        <div class="flex items-center gap-x-2">
            <x-daugt::form.icon-button
                    wire:click="delete"
                    wire:confirm="{{__('daugt::general.delete_confirmation')}}"
                    class="flex-shrink-0 ml-2"
                    icon="lucide:trash"
                    style="danger">
                {{__('daugt::general.add')}}
                <div class="i-lucide:plus w-5 h-5"></div>
            </x-daugt::form.icon-button>
            <x-daugt::form.button wire:click="save">
                {{__('daugt::general.save')}}
            </x-daugt::form.button>
        </div>
    </x-daugt::layouts.dashboard-bar>
    <div class="max-w-7xl mx-auto p-4">
        <form class="p-3" wire:submit="save">
            <div class="flex flex-col gap-y-2">
                <div>
                    <x-daugt::form.label for="name">{{__('daugt::general.name')}}</x-daugt::form.label>
                    <x-daugt::form.input id="name" wire:model.blur="name" :error="$errors->first('name')"/>
                </div>
                <div>
                    <x-daugt::form.label for="price">{{__('daugt::general.price')}}</x-daugt::form.label>
                    <x-daugt::form.input id="price" type="number" wire:model.blur="price" step=".01"
                                            pattern="^\d*(\.\d{0,2})?$" placeholder="99,99" :error="$errors->first('price')"/>
                </div>

                <div>
                    <x-daugt::form.label for="description">
                        {{__('daugt::general.description')}}
                        <x-slot name="additional">
                            {{__('daugt::shop.disclaimer_no_real_data_without_saving')}}
                        </x-slot>
                    </x-daugt::form.label>
                    <x-daugt::form.button class="w-full" type="button" style="light" wire:click="openBlockEditor()"
                                             :disabled="empty($product->id)">{{__('daugt::blocks.open_block_editor')}}</x-daugt::form.button>
                </div>

                <div>
                    @php
                        $categories = \Daugt\Models\Listing\Listing::where('type', 'shop_categories')->first()->items
                        ->map(function (\Daugt\Models\Listing\ListingItem $item){
                            return [
                                'value' => $item->id,
                                'title' => $item->name
                            ];
                        })->values()->toJson();
                    @endphp
                    <x-daugt::form.label for="categories">
                        {{__('daugt::general.categories')}}
                    </x-daugt::form.label>
                    <x-daugt::form.multi-select :options="$categories" :multi="true"
                                                   wire:model="categories"></x-daugt::form.multi-select>
                </div>

                <div>
                    <x-daugt::form.label for="media">
                        {{__('daugt::shop.product_media')}}
                        <x-slot name="additional">
                            {{__('daugt::shop.product_media_description')}}
                        </x-slot>
                    </x-daugt::form.label>
                    <x-daugt::form.media name="media" wire:model="media" wire:key="media"></x-daugt::form.media>
                </div>

                <x-daugt::tabs.tabs class="bg-neutral-100 mt-2 mb-1 py-1.5 px-1.5 rounded-md border-neutral-200 border-2">
                    <x-daugt::tabs.item :active="!$isExternal"
                                           wire:click="setIsExternal(false)">{{__('daugt::shop.normal_shop_product')}}</x-daugt::tabs.item>
                    <x-daugt::tabs.item :active="$isExternal"
                                           wire:click="setIsExternal(true)">{{__('daugt::shop.external_shop_product')}}</x-daugt::tabs.item>
                </x-daugt::tabs.tabs>

                @if($isExternal)
                    <div>
                        <x-daugt::form.label for="external_url">{{__('daugt::shop.external_product_url')}}
                            <x-slot name="additional">
                                {{__('daugt::shop.external_product_description')}}
                            </x-slot>
                        </x-daugt::form.label>
                        <x-daugt::form.input id="external_url" wire:model.blur="external_url"
                                                :error="$errors->first('external_url')"/>
                    </div>
                @else
                    <div>
                        @php
                            $taxCodes = \Daugt\Models\Shop\StripeTaxCode::all()->map(function (\Daugt\Models\Shop\StripeTaxCode $taxCode){
                                return [
                                    'value' => $taxCode->id,
                                    'title' => $taxCode->name
                                ];
                            })->values()->toJson();
                        @endphp
                        <x-daugt::form.label for="tax_code">{{__('daugt::shop.tax_code')}}
                            <x-slot name="additional">
                                {{__('daugt::shop.tax_code_description')}}
                            </x-slot>
                        </x-daugt::form.label>
                        <x-daugt::form.select id="tax_code" wire:model.live="stripe_tax_code_id"
                                                 :options="$taxCodes"></x-daugt::form.select>
                    </div>
                    <div>
                        <x-daugt::form.label for="shipping">{{__('daugt::shop.shipping')}}
                            <x-slot name="additional">
                                {{__('daugt::shop.shipping_description')}}
                            </x-slot>
                        </x-daugt::form.label>
                        <x-daugt::form.checkbox name="shipping"
                                                   wire:model.live="shipping">{{__('daugt::shop.shipping')}}</x-daugt::form.checkbox>
                    </div>
                    @if($shipping)
                        <div>
                            <x-daugt::form.label for="multi">{{__('daugt::shop.multi_order')}}
                                <x-slot name="additional">
                                    {{__('daugt::shop.multi_order_description')}}
                                </x-slot>
                            </x-daugt::form.label>
                            <x-daugt::form.checkbox
                                    name="multi"
                                    wire:model.live="multi">{{__('daugt::shop.multi_order')}}</x-daugt::form.checkbox>
                        </div>
                    @endif

                    <x-daugt::tabs.tabs
                            class="bg-neutral-100 mt-2 mb-1 py-1.5 px-1.5 rounded-md border-neutral-200 border-2">
                        <x-daugt::tabs.item :active="!$isCourse"
                                               wire:click="setIsCourse(false)">{{__('daugt::shop.contains_post')}}</x-daugt::tabs.item>
                        <x-daugt::tabs.item :active="$isCourse"
                                               wire:click="setIsCourse(true)">{{__('daugt::shop.contains_course')}}</x-daugt::tabs.item>
                    </x-daugt::tabs.tabs>
                    @if(!$isCourse)
                        <div>
                            <x-daugt::form.label for="linked_post">{{__('daugt::shop.linked_post')}}
                                <x-slot name="additional">
                                    {{__('daugt::shop.linked_post_description')}}
                                </x-slot>
                            </x-daugt::form.label>
                            <x-daugt::form.button style="light" class="w-full mb-1.5" type="button"
                                                     wire:click="$dispatch('openModal', { component: 'daugt::table.select-table-items', arguments: { tableName: 'daugt::content.content-table', dispatch: 'updateContent', 'selected': [{{$content_id}}] } })">
                                {{__('daugt::shop.select_post')}}
                            </x-daugt::form.button>
                            @if($content_id)
                                @livewire('daugt::content.content-table', ['ids' => [$content_id], 'readonly' => true, 'fullWidth' => true], key('content-table-'.$content_id))
                            @endif
                        </div>
                    @else
                        <div>
                            @php
                                $courses = $courses->map(function (\Daugt\Models\Listing\Listing $course){
                                    return [
                                        'value' => $course->id,
                                        'title' => $course->name
                                    ];
                                })->values()->toJson();
                            @endphp
                            <x-daugt::form.label for="linked_post">{{__('daugt::shop.linked_course')}}
                                <x-slot name="additional">
                                    {{__('daugt::shop.linked_course_description')}}
                                </x-slot>
                            </x-daugt::form.label>
                            <x-daugt::form.select wire:model.live="course_id" :options="$courses"></x-daugt::form.select>
                        </div>
                        <div>
                            <x-daugt::form.label for="starts_at">{{__('daugt::general.starts_at')}}
                                <x-slot name="additional">{{__('daugt::content.leave_empty_for_continuous_access')}}</x-slot>
                            </x-daugt::form.label>
                            <x-daugt::form.input id="starts_at" wire:model.blur="starts_at" type="date"
                                                    :error="$errors->first('starts_at')"/>
                        </div>
                        <div>
                            <x-daugt::form.label for="ends_at">{{__('daugt::general.ends_at')}}
                                <x-slot name="additional">{{__('daugt::content.leave_empty_for_continuous_access')}}</x-slot>
                            </x-daugt::form.label>
                            <x-daugt::form.input id="ends_at" wire:model.blur="ends_at" type="date"
                                                    :error="$errors->first('ends_at')"/>
                        </div>
                    @endif
                @endif
            </div>
        </form>
    </div>
</div>