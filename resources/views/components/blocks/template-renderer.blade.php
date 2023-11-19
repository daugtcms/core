@if($withinTemplate)
<x-sitebrew::layouts.base>
    {!! $content !!}
</x-sitebrew::layouts.base>
@else
    {!! $content !!}
@endif