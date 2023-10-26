@props([
    'value',
])

<x-sitebrew::core.icon-button icon="pencil" href="{{url()->current()}}/{{$value}}">
</x-sitebrew::core.icon-button>