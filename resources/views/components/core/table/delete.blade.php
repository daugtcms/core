@props([
    'value',
])

<form method="POST" action="{{url()->current()}}/{{$value}}">
    @csrf
    @method('DELETE')
    <x-sitebrew::core.icon-button type="submit" icon="trash-2" style="danger"
                                   onclick="confirm('{{__('sitebrew::navigation.delete_navigation_confirmation')}}') || event.preventDefault()"
    >
    </x-sitebrew::core.icon-button>
</form>