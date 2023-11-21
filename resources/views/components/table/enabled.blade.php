@props([
    'value',
])
<x-sitebrew::form.toggle :checked="$value->enabled" x-on:change="$wire.toggleEnabled({{$value->id}})">
</x-sitebrew::form.toggle>