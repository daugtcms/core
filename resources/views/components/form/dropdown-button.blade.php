@props(['style', 'label'])
<div x-data="{}">
<x-daugt::form.button
         :style="$style"
        @click="$refs.panel.toggle">{{$label}}</x-daugt::form.button>
{{--$attributes->merge([
    '@click' => '$refs.panel.toggle'
])--}}
<ul class="absolute overflow-hidden bg-white border-2 border-neutral-100 rounded-md" x-ref="panel" x-float.placement.bottom-start.flip.offset>
    {{$slot}}
</ul>
</div>
