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
        <form wire:submit="save">
            <div class="flex flex-col md:grid grid-cols-4 gap-3">
                <div class="col-span-2">
                    <x-daugt::form.label for="name">{{__('daugt::general.name')}}</x-daugt::form.label>
                    <x-daugt::form.input id="name" wire:model.blur="name" :error="$errors->first('name')" class="w-full"/>
                </div>
                <div class="col-span-4">
                    <x-daugt::form.label for="description">
                        {{__('daugt::general.description')}}
                    </x-daugt::form.label>
                    <livewire:daugt::content.content-editor :group="\Daugt\Enums\Content\ContentGroup::MARKETING" wire:model="description"></livewire:daugt::content.content-editor>
                </div>
                <div class="col-span-2">
                    <x-daugt::form.label for="price">{{__('daugt::general.price')}}</x-daugt::form.label>
                    <x-daugt::form.input id="price" type="number" wire:model.blur="price" step=".01"
                                         pattern="^\d*(\.\d{0,2})?$" placeholder="99,99" :error="$errors->first('price')"/>
                </div>


                <div class="col-span-2">
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

                <div class="col-span-4">
                    <x-daugt::form.label for="media">
                        {{__('daugt::shop.product_media')}}
                        <x-slot name="additional">
                            {{__('daugt::shop.product_media_description')}}
                        </x-slot>
                    </x-daugt::form.label>
                    <x-daugt::form.media name="media" wire:model="media" wire:key="media"></x-daugt::form.media>
                </div>

                <x-daugt::tabs.tabs class="bg-neutral-100 mt-2 mb-1 py-1.5 px-1.5 rounded-md border-neutral-200 border-2 col-span-4">
                    <x-daugt::tabs.item :active="!$isExternal"
                                        wire:click="setIsExternal(false)">{{__('daugt::shop.normal_shop_product')}}</x-daugt::tabs.item>
                    <x-daugt::tabs.item :active="$isExternal"
                                        wire:click="setIsExternal(true)">{{__('daugt::shop.external_shop_product')}}</x-daugt::tabs.item>
                </x-daugt::tabs.tabs>

                @if($isExternal)
                    <div class="col-span-3">
                        <x-daugt::form.label for="external_url">{{__('daugt::shop.external_product_url')}}
                            <x-slot name="additional">
                                {{__('daugt::shop.external_product_description')}}
                            </x-slot>
                        </x-daugt::form.label>
                        <x-daugt::form.input id="external_url" wire:model.blur="external_url"
                                             :error="$errors->first('external_url')"/>
                    </div>
                @else
                    <div class="col-span-4">
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
                    <div class="col-span-2">
                        <x-daugt::form.label for="shipping">{{__('daugt::shop.shipping')}}
                            <x-slot name="additional">
                                {{__('daugt::shop.shipping_description')}}
                            </x-slot>
                        </x-daugt::form.label>
                        <x-daugt::form.checkbox name="shipping"
                                                wire:model.live="shipping">{{__('daugt::shop.shipping')}}</x-daugt::form.checkbox>
                    </div>
                    @if($shipping)
                        <div class="col-span-2">
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

                    <div class="col-span-4 border-t-2 border-neutral-200 pt-1.5 mt-4">
                        <x-daugt::form.label>{{__('daugt::shop.access_management')}}
                            <x-slot name="additional">
                                {{__('daugt::shop.access_management_description')}}
                            </x-slot>
                        </x-daugt::form.label>
                        <div class="flex flex-col divide-y divide-neutral-100">
                            @foreach($hasAccess as $access)
                                <div class="py-2">
                                    <div class="flex justify-between items-center text-neutral-800">
                                        <span>{{$access->accessName}} - <span class="font-bold text-neutral-700">{{ucfirst($access->accessType)}}</span></span>
                                        <x-daugt::form.icon-button
                                                wire:click="removeAccess({{$loop->index}})"
                                                icon="lucide:trash"
                                                style="danger">
                                        </x-daugt::form.icon-button>
                                    </div>
                                    <x-daugt::form.label class="text-sm opacity-75">{{__('daugt::shop.access_type')}}</x-daugt::form.label>
                                    <x-daugt::tabs.tabs class="w-full pb-1">
                                        <x-daugt::tabs.item :active="$access->type == \Daugt\Enums\Shop\AccessType::PERMANENT"
                                                            wire:click="setAccessType({{$loop->index}}, '{{\Daugt\Enums\Shop\AccessType::PERMANENT->value}}')">{{__('daugt::shop.access_types.' . \Daugt\Enums\Shop\AccessType::PERMANENT->value)}}</x-daugt::tabs.item>
                                        <x-daugt::tabs.item :active="$access->type == \Daugt\Enums\Shop\AccessType::DATES"
                                                            wire:click="setAccessType({{$loop->index}}, '{{\Daugt\Enums\Shop\AccessType::DATES->value}}')">{{__('daugt::shop.access_types.' . \Daugt\Enums\Shop\AccessType::DATES->value)}}</x-daugt::tabs.item>
                                        <x-daugt::tabs.item :active="$access->type == \Daugt\Enums\Shop\AccessType::DURATION"
                                                            wire:click="setAccessType({{$loop->index}}, '{{\Daugt\Enums\Shop\AccessType::DURATION->value}}')">{{__('daugt::shop.access_types.' . \Daugt\Enums\Shop\AccessType::DURATION->value)}}</x-daugt::tabs.item>
                                    </x-daugt::tabs.tabs>
                                    @if($access->type == \Daugt\Enums\Shop\AccessType::DATES)
                                        <x-daugt::form.label for="start_date">{{__('daugt::shop.dates')}}
                                            <x-slot name="additional">
                                                {{__('daugt::shop.dates_description')}}
                                            </x-slot>
                                        </x-daugt::form.label>
                                        <x-daugt::form.input type="datetime-local" wire:model="hasAccess.{{$loop->index}}.startDate"
                                                             :error="$errors->first('hasAccess.'.$loop->index.'.startDate')"
                                                             :placeholder="__('daugt::shop.from')" class="mb-1"/>
                                        <x-daugt::form.input type="datetime-local" wire:model="hasAccess.{{$loop->index}}.endDate"
                                                             :error="$errors->first('hasAccess.'.$loop->index.'.endDate')"
                                                             :placeholder="__('daugt::shop.to')"/>
                                    @elseif($access->type == \Daugt\Enums\Shop\AccessType::DURATION)
                                        <x-daugt::form.label for="duration">{{__('daugt::shop.duration')}}
                                            <x-slot name="additional">
                                                {{__('daugt::shop.duration_description')}}
                                            </x-slot>
                                        </x-daugt::form.label>
                                        <x-daugt::form.input type="number" name="duration" wire:model="hasAccess.{{$loop->index}}.duration"
                                                             :error="$errors->first('hasAccess.'.$loop->index.'.duration')"
                                                             :placeholder="__('daugt::shop.duration')" class="mb-1"/>
                                        @php
                                            $units = collect(\Daugt\Enums\Shop\BillingDurationUnit::cases());
                                            $options = $units->map(function ($unit){
                                                return [
                                                    'value' => $unit->value,
                                                    'title' => __('daugt::shop.duration_units.'.$unit->value)
                                                ];
                                            })->values()->toJson();
                                        @endphp
                                        <x-daugt::form.select :options="$options" name="duration" wire:model="hasAccess.{{$loop->index}}.durationUnit"
                                                             :error="$errors->first('hasAccess.'.$loop->index.'.durationUnit')"/>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-span-2">
                        <x-daugt::form.button style="light" class="w-full mb-1.5" type="button"
                                              wire:click="$dispatch('openModal', { component: 'daugt::table.select-table-items', arguments: { tableName: 'daugt::content.content-table', dispatch: 'updatePosts', multiSelect: true, filters: {'type': 'post'} } })">
                            {{__('daugt::shop.add_posts')}}
                        </x-daugt::form.button>
                    </div>
                    <div class="col-span-2">
                        <x-daugt::form.button style="light" class="w-full mb-1.5" type="button"
                                              wire:click="$dispatch('openModal', { component: 'daugt::table.select-table-items', arguments: { tableName: 'daugt::listing.listing-table', dispatch: 'updateCourses', multiSelect: true, filters: {'type': 'course'} } })">
                            {{__('daugt::shop.add_courses')}}
                        </x-daugt::form.button>
                    </div>
                @endif
            </div>
        </form>
    </div>
</div>