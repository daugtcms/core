@props([
    'value',
])

<x-daugt::form.icon-button icon="lucide:square-arrow-out-up-right" target="_blank" :href="$value->getUrl()">
</x-daugt::form.icon-button>