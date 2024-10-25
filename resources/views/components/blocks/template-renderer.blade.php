@if($withinTemplate)
    {!! $content !!}
@else
<x-daugt::layouts.base :title="$title">
    {!! $content !!}
</x-daugt::layouts.base>
@endif