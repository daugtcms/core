@props([
    'value',
])

<x-sitebrew::form.icon-button icon="pencil" href="{{url()->current()}}/{{$value}}">
</x-sitebrew::form.icon-button>