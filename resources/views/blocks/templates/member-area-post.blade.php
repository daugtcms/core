<x-sitebrew::template-renderer :usage="\Sitebrew\Enums\Blocks\TemplateUsage::MEMBER_AREA->value" :within-template="true">
<div class="pb-7">
    <div class="container bg-white rounded-lg">
    @if(!empty($featuredImage[0]))
    <div class="pt-4 max-h-96 flex">
        <img src="{{MediaHelper::getMediaById($featuredImage[0]['id'], $featuredImage[0]['variant'])}}" alt="" class="rounded-lg object-cover">
    </div>
    @endif
    <div
    @class([
        'prose mx-auto',
        'pt-4' => !empty($featuredImage[0]),
        'pt-8' => empty($featuredImage[0])
    ])>
    @if($courseSection)
        @php
            $section = \Sitebrew\Models\Listing\ListingItem::with('listing')->find($courseSection);
            $course = $section->listing;
        @endphp
            <p class="text-neutral-500 mb-0 text-xl font-medium flex items-center -space-x-0.5"><span>{{$course->name}}</span> @svg('dot') <span>{{$section->name}}</span></p>
    @endif
    <h1 class="">{{$title}}</h1>
    </div>
    {!! $slot !!}
</div>
</div>
</x-sitebrew::template-renderer>