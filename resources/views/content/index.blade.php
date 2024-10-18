<x-daugt::template-renderer :usage="$type . '_list'">
    @foreach($contents as $content)
        <x-daugt::template-renderer :usage="$type . '_card'" :attributes="['content' => $content, ...$content->attributes]">
        </x-daugt::template-renderer>
    @endforeach

    @push('after-contents')
        @if($contents->hasPages())
            {{$contents->links()}}
        @endif
    @endpush
</x-daugt::template-renderer>