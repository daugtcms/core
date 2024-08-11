@props([
    'blocks' => []
])
<div x-ref="floatingMenuBlocks" x-cloak>
    <x-daugt::form.dropdown-button :style="'light'" :label="'Add Block'">
        @foreach($blocks as $key => $block)
            <x-daugt::form.dropdown-button-item action="$wire.insertBlock('{{$key}}')">
            {{$block->name}}
            </x-daugt::form.dropdown-button-item>
        @endforeach
    </x-daugt::form.dropdown-button>
</div>

