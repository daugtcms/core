@props([
    'value'
])
<div class="flex items-center gap-x-2 hover:bg-neutral-200/75 rounded-md px-2 py-1" wire:click="$dispatch('openModal', {component: 'daugt::content.schedule-content', arguments: {content: {{$value->id}}}})">
    <div class="i-lucide:clock"></div>
    @if($value->published_at)
    {{\Carbon\Carbon::make($value->published_at)->format('d.m.Y H:i:s') }}
    @else
    -
    @endif
</div>