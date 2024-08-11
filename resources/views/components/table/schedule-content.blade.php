@props([
    'value'
])
<div class="flex items-center gap-x-2 hover:bg-neutral-200/75 rounded-md px-2 py-1" wire:click="$dispatch('openModal', {component: 'daugt::content.schedule-content', arguments: {content: {{$value->id}}}})">
    @svg('clock', 'w-5 h-5')
    @if($value->published_at)
    {{\Carbon\Carbon::make($value->published_at)->format('d.m.Y H:i:s') }}
    @else
    -
    @endif
</div>