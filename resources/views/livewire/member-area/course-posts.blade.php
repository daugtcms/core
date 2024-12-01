<div class="container flex flex-col gap-y-4" wire:poll.10s>
    @foreach($course_posts as $post)
        <x-daugt::template-renderer :usage="'post_card'" :attributes="['content' => $post, ...$post->attributes, 'allow_member_comments' => $allow_member_comments, 'allow_member_reactions' => $allow_member_reactions]"></x-daugt::template-renderer>
    @endforeach
</div>