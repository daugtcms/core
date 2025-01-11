<div class="py-8 max-w-3xl mx-auto" id="comments">
    <h2 class="text-xl text-neutral-800 mb-2">{{trans_choice(__('daugt::content.comments', ['count' => $comments->count()]), $comments->count())}}</h2>
    <form method="POST" action="{{route('daugt.content.comments.create', ['type' => $type, 'slug' => $slug])}}">
        @csrf
        <x-daugt::content.comment-textbox></x-daugt::content.comment-textbox>
    </form>
    <div class="flex flex-col divide-y-2 divide-neutral-100 mt-1">
        @foreach($comments as $comment)
            <x-daugt::content.comment-card :comment="$comment"></x-daugt::content.comment-card>
        @endforeach
    </div>
</div>