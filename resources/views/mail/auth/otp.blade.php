<x-mail::message>
# {{__('daugt::auth.otp.email.greeting')}}

{{__('daugt::auth.otp.email.message')}}

<x-mail::panel>
<span style="font-size:150%; font-weight: 700">{{$otp}}</span>
</x-mail::panel>

{{__('daugt::auth.otp.email.explanation', ['minutes' => 15])}}

<x-mail::button :url="$url">
Anmelden
</x-mail::button>
</x-mail::message>
