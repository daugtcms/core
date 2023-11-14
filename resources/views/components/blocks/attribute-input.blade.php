@props(['key' => '', 'attribute'])
<div class="w-full px-3 py-2">
    <h2 class="font-medium">{{$attribute['title']}}</h2>
    @isset($attribute['description'])
        <h3 class="text-sm text-neutral-500">{{$attribute['description']}}</h3>
    @endisset
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
        @case('navigation')
            @php
                \Sitebrew\Models\Navigation\Navigation::all()->each(function(\Sitebrew\Models\Navigation\Navigation $navigation) use (&$navigations){
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
            <div x-data="{selectedMedia: []}" x-modelable="selectedMedia" {{$attributes}} x-on:picker-updated="$event.detail[1] == '{{ $attributes->whereStartsWith('wire:key')->first() }}' ? selectedMedia = $event.detail[0] : false"
                 x-init="selectedMedia = $wire.{{$attributes->whereStartsWith('wire:model')->first()}}; $dispatch('mediaSelected', {key: '{{ $attributes->whereStartsWith('wire:key')->first() }}', media: selectedMedia})">
                <livewire:sitebrew::media.media-picker :key="$attributes->only('wire:key')->first()" :id="$attributes->only('wire:key')->first()"></livewire:sitebrew::media.media-picker>
            </div>
            @break
    @endswitch
</div>