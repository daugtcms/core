@props(['key' => '', 'attribute'])
<div class="w-full px-3 py-2">
    <h2 class="font-medium">{{$attribute['title']}}</h2>
    @isset($attribute['description'])
        <h3 class="text-sm text-neutral-500">{{$attribute['description']}}</h3>
    @endisset
    @if(isset($attribute['readonly']) && $attribute['readonly'])
        <p class="text-sm mt-1.5 text-neutral-500 italic text-center">{{__('sitebrew::blocks.readonly_info')}}</p>
    @else
        @switch($attribute['type']->value)
            @case('text')
            @case('number')
                <x-sitebrew::form.input class="w-full mt-1" type="text"
                                        placeholder="{{Str::ucfirst($attribute['type']->value)}}" {{ $attributes }}>
                </x-sitebrew::form.input>
                @break
            @case('boolean')
                <div class="pt-1 -mb-2">
                    <x-sitebrew::form.checkbox {{$attributes}}>{{$attribute['title']}}</x-sitebrew::form.checkbox>
                </div>
                @break
            @case('rich-text')
                <x-sitebrew::form.rich-text {{$attributes}}></x-sitebrew::form.rich-text>
                @break
            @case('listing')
                @php
                    \Sitebrew\Models\Listing\Listing::where('usage', \Sitebrew\Enums\Listing\ListingUsage::NAVIGATION)->each(function(\Sitebrew\Models\Listing\Listing $navigation) use (&$navigations){
                        $navigations[] = [
                            'value' => $navigation->id,
                            'title' => $navigation->name
                        ];
                    });
                    $navigations = collect($navigations)->toJson()
                @endphp
                <x-sitebrew::form.select :options="$navigations" {{ $attributes }}></x-sitebrew::form.select>
                @break
            @case('image')
                <x-sitebrew::form.media {{$attributes}}></x-sitebrew::form.media>
                @break
        @endswitch
    @endif
</div>
