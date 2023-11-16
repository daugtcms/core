@props([
    'value',
])

<x-sitebrew::form.icon-button icon="pencil" wire:click="edit({{$value}})">
</x-sitebrew::form.icon-button>