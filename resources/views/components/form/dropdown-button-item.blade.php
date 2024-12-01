@props([
    'action' => null,
])

<li {{ $attributes->except(['action', 'type']) }}>
    <button
            x-on:click="$refs.panel.close(); {{ $action }}"
            {{$attributes->merge([
                'class' => 'w-full px-3 py-2 text-left whitespace-nowrap hover:bg-neutral-50 focus:bg-neutral-100 focus:outline-none',
                'type' => 'button',
            ])}}>
        {{ $slot }}
    </button>
</li>