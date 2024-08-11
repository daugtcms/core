@if($withinTemplate)
    {!! $content !!}
@else
<x-daugt::layouts.base>
    {!! $content !!}
</x-daugt::layouts.base>
@endif