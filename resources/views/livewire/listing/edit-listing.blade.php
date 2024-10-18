<form class="p-3" wire:submit="save">
    <x-daugt::modal.header>{{__('daugt::listing.manage_listing')}}</x-daugt::modal.header>
    <div class="flex flex-col gap-y-2">
        <div>
            <x-daugt::form.label for="name">{{__('daugt::general.name')}}</x-daugt::form.label>
            <x-daugt::form.input id="name" wire:model.blur="name" :error="$errors->first('name')"/>
        </div>
        <div>
            @php
                $types = collect(\Daugt\Misc\ListingTypeRegistry::getListingTypes())->map(function (\Daugt\Data\Listing\ListingTypeData $type, $key){
                    return [
                        'value' => $key,
                        'title' => $type->name
                    ];
                })->values()->toJson();
            @endphp
            <x-daugt::form.label for="usage">{{__('daugt::general.usage')}}</x-daugt::form.label>
            <x-daugt::form.select id="usage" wire:model.live="type"
                                     :options="$types"
                                     :error="$errors->first('usage')"/>
        </div>
        <div>
            <x-daugt::form.label for="title">{{__('daugt::general.description')}}</x-daugt::form.label>
            <x-daugt::form.textarea id="title" wire:model.blur="description"
                                       :error="$errors->first('description')"/>
        </div>

        @if(isset($type) && isset(\Daugt\Misc\ListingTypeRegistry::getListingType($type)->listAttributes))
            <div class="flex flex-col gap-y-2">
                @foreach(\Daugt\Misc\ListingTypeRegistry::getListingType($type)->listAttributes as $key => $attribute)
                    <div>
                        <x-daugt::blocks.attribute-input
                                :attribute="$attribute"
                                :key="'data.' . $attribute->name"
                                wire:model.live="data.{{$key}}"
                        />
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    <x-daugt::modal.footer class="justify-end">
        <x-daugt::form.button style="primary">{{__('daugt::general.save')}}</x-daugt::form.button>
    </x-daugt::modal.footer>
</form>