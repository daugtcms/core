@props([
    'value'
])
<div>
    @if($value)
    {{\Carbon\Carbon::make($value)->format('d.m.Y') }}
    @else
    -
    @endif
</div>