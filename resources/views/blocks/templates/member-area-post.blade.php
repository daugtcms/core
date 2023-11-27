<x-sitebrew::template-renderer :usage="\Sitebrew\Enums\Blocks\TemplateUsage::MEMBER_AREA->value" :within-template="true">
<div class="container bg-white rounded-lg">
    @if(!empty($featuredImage[0]))
    <div class="pt-4">
        <img src="{{MediaHelper::getMediaById($featuredImage[0]['id'], $featuredImage[0]['variant'])}}" alt="" class="rounded-lg">
    </div>
    @endif
    <div
    @class([
        'prose mx-auto',
        'pt-4' => !empty($featuredImage[0]),
        'pt-8' => empty($featuredImage[0])
    ])>
    <h1 class="">{{$title}}</h1>
    </div>
    {!! $slot !!}
</div>
</x-sitebrew::template-renderer>