@props([
    'value',
])

<form method="POST" action="{{url()->current()}}/{{$value}}">
    @csrf
    @method('DELETE')
    <x-daugt::form.icon-button type="submit" icon="lucide:trash-2" style="danger"
                                   onclick="confirm('{{__('daugt::general.delete_confirmation')}}') || event.preventDefault()"
    >
    </x-daugt::form.icon-button>
</form>