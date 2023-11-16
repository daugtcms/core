@props(['close' => '$dispatch("modal.close")'])

<div {{$attributes->merge(['class' => 'border-b border-neutral-200 flex items-center justify-between pb-1 mb-2'])}}>
    <h1 class="text-neutral-700 font-medium truncate text-lg">{{$slot}}</h1>
    <x-sitebrew::form.icon-button icon="x" class="flex-shrink-0"
                                   wire:click="{{ $close }}"></x-sitebrew::form.icon-button>
</div>
