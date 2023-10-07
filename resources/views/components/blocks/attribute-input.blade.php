@props(['key' => '', 'attribute'])
<div class="w-full px-3 py-2">
    <h2 class="font-medium">{{$attribute['title']}}</h2>
    @isset($attribute['description'])
        <h3 class="text-sm text-neutral-500">{{$attribute['description']}}</h3>
    @endisset
    @switch($attribute['type']->value)
        @case('text')
        @case('image')
            <x-site-core::form.input class="w-full mt-1" type="text"
                                     placeholder="{{Str::ucfirst($attribute['type']->value)}}" {{ $attributes }}>
            </x-site-core::form.input>
            @break
        @case('navigation')
            @php
                \Felixbeer\SiteCore\Navigation\Models\Navigation::all()->each(function(\Felixbeer\SiteCore\Navigation\Models\Navigation $navigation) use (&$navigations){
                    $navigations[] = [
                        'value' => $navigation->id,
                        'title' => $navigation->name
                    ];
                });
                $navigations = collect($navigations)->toJson()
            @endphp
            <x-site-core::form.select :options="$navigations" {{ $attributes }}></x-site-core::form.select>
            @break
    @endswitch
</div>