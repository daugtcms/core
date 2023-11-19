@props(['active'])

<button
        {{ $attributes->merge(['type' => 'button']) }}
        @class([
            'text-neutral-700 inline-flex items-center font-medium hover:bg-neutral-200 rounded-md px-2 py-1 whitespace-nowrap',
            'text-primary-800 bg-primary-200 hover:bg-primary-100' => $active,
        ])
>
    {{$slot}}
</button>