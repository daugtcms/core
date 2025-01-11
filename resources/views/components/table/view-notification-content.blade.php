@props([
    'value',
])

<x-daugt::form.icon-button icon="lucide:eye" wire:click="$dispatch('openModal', {component: 'daugt::content.view-notification-content', arguments: {content: {{json_encode($value)}}}})">
</x-daugt::form.icon-button>