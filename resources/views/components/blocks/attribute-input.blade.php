@props(['key' => '', 'attribute'])
@php
    use Sitebrew\Enums\Blocks\AttributeType;
@endphp
<div class="w-full">
    <h2 class="font-medium">{{$attribute->name}}</h2>
    @isset($attribute->description)
        <h3 class="text-sm text-neutral-500 break-words">{{$attribute->description}}</h3>
    @endisset
    @if(isset($attribute->readonly) && $attribute->readonly)
        <p class="text-sm mt-1.5 text-neutral-500 italic text-center">{{__('sitebrew::blocks.readonly_info')}}</p>
    @else
        @switch($attribute->type->value)
            @case(AttributeType::TEXT->value)
                <x-sitebrew::form.input class="w-full mt-1" type="text"
                                        placeholder="{{Str::ucfirst($attribute->type->value)}}" {{ $attributes }}>
                </x-sitebrew::form.input>
                @break
            @case(AttributeType::NUMBER->value)
                <x-sitebrew::form.input class="w-full mt-1" type="number" required
                                        placeholder="{{Str::ucfirst($attribute->type->value)}}" {{ $attributes }}>
                </x-sitebrew::form.input>
                @break
            @case(AttributeType::BOOLEAN->value)
                <div class="pt-1 -mb-2">
                    <x-sitebrew::form.checkbox {{$attributes}}>{{$attribute->name}}</x-sitebrew::form.checkbox>
                </div>
                @break
            @case(AttributeType::RICH_TEXT->value)
                <x-sitebrew::form.rich-text {{$attributes}}></x-sitebrew::form.rich-text>
                @break
            @case(AttributeType::MEDIA->value)
                <x-sitebrew::form.media {{$attributes}}></x-sitebrew::form.media>
                @break
            @case(AttributeType::CUSTOM_SELECT->value)
                @php
                    $options = collect($attribute->options)->map(function($value, $key) use (&$options){
                        return [
                            'value' => $key,
                            'title' => $value
                        ];
                    })->values()->toJson();
                @endphp
                <x-sitebrew::form.select :options="$options" {{ $attributes }}></x-sitebrew::form.select>
                @break
            @case(AttributeType::LISTING->value)
                @php
                    \Sitebrew\Models\Listing\Listing::where('type', $attribute->options['type'])->each(function(\Sitebrew\Models\Listing\Listing $listing) use (&$listings){
                        $listings[] = [
                            'value' => $listing->id,
                            'title' => $listing->name
                        ];
                    });
                    $listings = collect($listings)->toJson()
                @endphp
                <x-sitebrew::form.select :options="$listings" {{ $attributes }}></x-sitebrew::form.select>
                @break
            @case(AttributeType::LISTING_ITEM->value)
                @php
                    \Sitebrew\Models\Listing\Listing::where('type', $attribute->options['type'])->with('items')->get()->each(function(\Sitebrew\Models\Listing\Listing $listing) use (&$items){
                        $listing->items->each(function(\Sitebrew\Models\Listing\ListingItem $item) use (&$items, $listing){
                            $items[] = [
                                'value' => $item->id,
                                'title' => $listing->name . ' - ' . $item->name
                            ];
                        });
                    });
                    $items = collect($items)->toJson()
                @endphp
                <x-sitebrew::form.select :options="$items" {{ $attributes }}></x-sitebrew::form.select>
                @break
            @case(AttributeType::ICON->value)
                <x-sitebrew::form.icon-picker
                        {{ $attributes }}></x-sitebrew::form.icon-picker>
        @endswitch
    @endif
</div>
