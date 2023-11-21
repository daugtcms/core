@props([
    'value',
])

<form method="POST" action="{{url()->current()}}/{{$value}}">
    @csrf
    @method('DELETE')
    <x-sitebrew::form.icon-button type="submit" icon="trash-2" style="danger"
                                   onclick="confirm('{{__('sitebrew::general.delete_confirmation')}}') || event.preventDefault()"
    >
    </x-sitebrew::form.icon-button>
</form>