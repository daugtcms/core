@props([
    'value',
])

<x-daugt::form.icon-button icon="pencil" wire:click="edit({{$value}})">
</x-daugt::form.icon-button>