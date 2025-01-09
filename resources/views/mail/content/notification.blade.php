<x-mail::message>
# {{__('daugt::content.notification.email.greeting', ['name' => $user->name])}}

@if($updated)
{{__('daugt::content.notification.email.updated_post')}}
@else
{{__('daugt::content.notification.email.new_post')}}
@endif

<x-mail::panel>
# {{$content->title}}
@isset($image)
<img src="{{ $image }}"
     style="border-radius: 4px; max-height: 320px">
@endisset
</x-mail::panel>

<x-mail::button :url="$url">
    {{__('daugt::content.notification.email.view_post')}}
</x-mail::button>
</x-mail::message>