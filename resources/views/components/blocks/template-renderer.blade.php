@if($withinTemplate)
    {!! $content !!}
@else
<x-sitebrew::layouts.base>
    {!! $content !!}
</x-sitebrew::layouts.base>
@endif