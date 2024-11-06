@props(['key' => '', 'attribute'])
@php
    use Daugt\Enums\Blocks\AttributeType;
@endphp
<div class="w-full">
    <h2 class="font-medium">{{$attribute->name}}</h2>
    @isset($attribute->description)
        <h3 class="text-sm text-neutral-500 break-words">{{$attribute->description}}</h3>
    @endisset
    @if(isset($attribute->readonly) && $attribute->readonly)
        <p class="text-sm mt-1.5 text-neutral-500 italic text-center">{{__('daugt::blocks.readonly_info')}}</p>
    @else
        @switch($attribute->type->value)
            @case(AttributeType::TEXT->value)
                <x-daugt::form.input class="w-full mt-1" type="text"
                                        placeholder="{{Str::ucfirst($attribute->type->value)}}" {{ $attributes }}>
                </x-daugt::form.input>
                @break
            @case(AttributeType::NUMBER->value)
                <x-daugt::form.input class="w-full mt-1" type="number"
                                        placeholder="{{Str::ucfirst($attribute->type->value)}}" {{ $attributes }}>
                </x-daugt::form.input>
                @break
            @case(AttributeType::BOOLEAN->value)
                <div class="pt-1 -mb-2">
                    <x-daugt::form.checkbox {{$attributes}}>{{$attribute->name}}</x-daugt::form.checkbox>
                </div>
                @break
            @case(AttributeType::RICH_TEXT->value)
                <x-daugt::form.rich-text {{$attributes}}></x-daugt::form.rich-text>
                @break
            @case(AttributeType::MEDIA->value)
                <x-daugt::form.media {{$attributes}}></x-daugt::form.media>
                @break
            @case(AttributeType::CUSTOM_SELECT->value)
                @php
                    $options = collect($attribute->options['items'])->map(function($value, $key) use (&$options){
                        return [
                            'value' => $key,
                            'title' => $value
                        ];
                    })->values()->toJson();
                @endphp
                <x-daugt::form.select :options="$options" {{ $attributes }}></x-daugt::form.select>
                @break
            @case(AttributeType::LISTING->value)
                @php
                    \Daugt\Models\Listing\Listing::where('type', $attribute->options['type'])->each(function(\Daugt\Models\Listing\Listing $listing) use (&$listings){
                        $listings[] = [
                            'value' => $listing->id,
                            'title' => $listing->name
                        ];
                    });
                    $listings = collect($listings)->toJson()
                @endphp
                <x-daugt::form.select :options="$listings" {{ $attributes }}></x-daugt::form.select>
                @break
            @case(AttributeType::LISTING_ITEM->value)
                @php
                    \Daugt\Models\Listing\Listing::where('type', $attribute->options['listingType'])->with('items')->get()->each(function(\Daugt\Models\Listing\Listing $listing) use (&$items){
                        $listing->items->each(function(\Daugt\Models\Listing\ListingItem $item) use (&$items, $listing){
                            $items[] = [
                                'value' => $item->id,
                                'title' => $listing->name . ' - ' . $item->name
                            ];
                        });
                    });
                    $items = collect($items)->toJson()
                @endphp
                <x-daugt::form.multi-select :multi="$attribute->options['multi']" :options="$items" {{ $attributes }}></x-daugt::form.multi-select>
                @break
            @case(AttributeType::ICON->value)
                <x-daugt::form.icon-picker
                        {{ $attributes }}></x-daugt::form.icon-picker>
                @break
            @case(AttributeType::LINK->value)
                <x-daugt::form.link-input
                        {{  $attributes }}></x-daugt::form.link-input>
                @break
            @case(AttributeType::CONTENT_LIST->value)
                <x-daugt::form.content-list-input
                        {{  $attributes }}></x-daugt::form.content-list-input>
                @break
        @endswitch
    @endif
</div>
