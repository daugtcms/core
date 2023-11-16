@props([
    'value',
])

<div class="flex flex-col">
<p class="text-sm">{{ $value->full_name }}</p>
<p class="text-xs opacity-75">{{ $value->email }}</p>
</div>