<div class="container flex flex-col gap-y-4" wire:poll.10s>
    <label class="flex gap-x-2.5 justify-end">
        <span class="text-neutral-700">{{__('daugt::content.notification.toggle')}}</span><x-daugt::form.toggle wire:model.live="emailNotifications"></x-daugt::form.toggle>
    </label>

    @if(isset($section) && isset($section->data['allow_member_posts']) && $section->data['allow_member_posts'] ?? false)
        <x-daugt::member-area.course-comments :course="$course->slug" :section="$section->slug"></x-daugt::member-area.course-comments>
    @endif
    @foreach($feed as $feedItem)
            @if($feedItem instanceof \Daugt\Models\Content\Content)
                <div wire:key="content-{{$feedItem->id}}">
            <x-daugt::template-renderer :usage="'post_card'" :within-template="true" :attributes="['content' => $feedItem, ...$feedItem->attributes, 'allow_member_comments' => $allow_member_comments, 'allow_member_reactions' => $allow_member_reactions]"></x-daugt::template-renderer>
                </div>
                    @else
                <div class="bg-white rounded-lg shadow-md px-3" wire:key="comment-{{$feedItem->id}}">
                    <x-daugt::content.comment-card :comment="$feedItem"></x-daugt::content.comment-card>
                </div>
            @endif
    @endforeach

    {{$feed->links()}}
</div>