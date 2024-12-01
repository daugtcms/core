<x-daugt::template-renderer :usage="'member_area'" :within-template="true">
<div class="pb-7">
    <div class="container bg-white rounded-lg">
    @isset($image['url'])
    <div class="pt-4 max-h-96 flex">
        <img src="{{$image['url']}}" alt="" class="rounded-lg object-cover">
    </div>
    @endisset
    <div
    @class([
        'prose max-w-full mx-auto',
        'pt-4' => !empty($image['url']),
        'pt-8' => empty($image['url'])
    ])>
    <h1 class="font-accent">{{$content['title']}}</h1>
    <div class="max-w-3xl mx-auto -mt-2.5 mb-2">
        <x-daugt::user.reactions :reactions="$content->reactions"
                                 style="secondary"
                                 :comments="$content->comments"
                                 :reactions-enabled="\Daugt\Helpers\MemberArea\AccessHelper::canReactPost($content)"
                                 :comments-enabled="\Daugt\Helpers\MemberArea\AccessHelper::canCommentPost($content)"
        ></x-daugt::user.reactions>
    </div>
    </div>
    {!! $slot !!}
</div>
</div>
</x-daugt::template-renderer>