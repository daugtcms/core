@props(['style', 'label', 'iconButton' => false, 'icon' => 'lucide:info', 'grid' => false, 'gridCols' => 4])
<div x-data="{}" {{$attributes}}>
@if($iconButton)
        <x-daugt::form.icon-button
                :style="$style"
                @click="$refs.panel.toggle"
                :icon="$icon"></x-daugt::form.icon-button>
@else
    <x-daugt::form.button
            :style="$style"
            @click="$refs.panel.toggle">{{$label}}</x-daugt::form.button>
@endif
{{--$attributes->merge([
    '@click' => '$refs.panel.toggle'
])--}}
<div x-ref="panel" x-float.placement.bottom.shift.flip.offset class="absolute z-50">
    <ul @class([
            'overflow-hidden bg-white border-2 border-neutral-100 rounded-md max-h-64 overflow-y-auto z-50',
            "grid grid-cols-$gridCols" => $grid
            ])>
        {{$slot}}
    </ul>
</div>
</div>
