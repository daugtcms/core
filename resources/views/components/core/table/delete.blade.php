@props([
    'value',
])

<form method="POST" action="{{url()->current()}}/{{$value}}">
    @csrf
    @method('DELETE')
    <x-site-core::core.icon-button type="submit" icon="trash-2" style="danger"
                                   onclick="confirm('{{__('site-core::navigation.delete_navigation_confirmation')}}') || event.preventDefault()"
    >
    </x-site-core::core.icon-button>
</form>