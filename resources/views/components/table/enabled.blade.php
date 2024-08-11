@props([
    'value',
])
<x-daugt::form.toggle :checked="$value->enabled" x-on:change="$wire.toggleEnabled({{$value->id}})">
</x-daugt::form.toggle>