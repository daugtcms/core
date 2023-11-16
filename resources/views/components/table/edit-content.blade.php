@props([
    'value',
])

<x-sitebrew::form.icon-button icon="pencil" wire:click="editElement({{$value}})">
</x-sitebrew::form.icon-button>