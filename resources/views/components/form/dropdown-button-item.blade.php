@props([
    'action' => null,
])

<li {{ $attributes->except('action') }}>
    <button type="button"
            x-on:click="{{ $action }}; $refs.panel.close();"
            class="w-full px-3 py-2 text-left whitespace-nowrap hover:bg-neutral-50 focus:bg-neutral-100 focus:outline-none">
        {{ $slot }}
    </button>
</li>