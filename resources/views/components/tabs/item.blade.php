@props(['active', 'count' => 0])

<button
        {{ $attributes->merge(['type' => 'button']) }}
        @class([
            'text-neutral-700 inline-flex items-center font-medium hover:bg-neutral-200 rounded-md px-2 py-1 whitespace-nowrap relative',
            'text-primary-800 bg-primary-200 hover:bg-primary-100' => $active,
        ])
>
    {{$slot}}
    @if($count > 0)
        <span class="px-1 py-0.5 bg-primary-600 text-white text-xs rounded-md ml-1">{{$count}}</span>
    @endif
</button>