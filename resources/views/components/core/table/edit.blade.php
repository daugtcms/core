@props([
    'value',
])

<x-site-core::core.icon-button icon="pencil" href="{{url()->current()}}/{{$value}}">
</x-site-core::core.icon-button>