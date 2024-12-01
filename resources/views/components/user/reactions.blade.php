@props(['style' => 'dark', 'route' => url()->current(), 'comments', 'reactions', 'commentsEnabled' => false, 'reactionsEnabled' => false])
<div {{$attributes->merge([
    'class' => 'inline-flex gap-x-2 not-prose'
])}}>
    @if($reactionsEnabled)
    @php
        // group reactions by emoji
        $groupedReactions = $reactions->groupBy('value');
    @endphp
    @foreach($groupedReactions as $key => $reaction)
        <x-daugt::form.icon-button class="pointer-events-none" :style="$style">{{$key . ' ' . $reaction->count()}}</x-daugt::form.icon-button>
    @endforeach
    <x-daugt::form.dropdown-button :grid="true" :grid-cols="5" :icon-button="true" :icon="'lucide:smile-plus'" :style="$style">
        @foreach(config('daugt.user.allowed_reactions') as $reaction)
            <form method="POST" action="{{$route}}/reactions/{{$reaction}}">
                @csrf
                <x-daugt::form.dropdown-button-item type="submit">{{$reaction}}</x-daugt::form.dropdown-button-item>
            </form>
        @endforeach
    </x-daugt::form.dropdown-button>
    @endif
    @if($commentsEnabled)
        <x-daugt::form.icon-button :icon="'lucide:message-square-text'" :style="$style" :href="$route . '#comments'">{{$comments->count()}}</x-daugt::form.icon-button>
    @endif
</div>