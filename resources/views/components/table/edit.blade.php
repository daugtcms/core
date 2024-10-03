@props([
    'value',
])

<x-daugt::form.icon-button icon="lucide:pencil" wire:click="edit({{$value}})">
</x-daugt::form.icon-button>