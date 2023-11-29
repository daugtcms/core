<div class="container flex flex-col gap-y-4" wire:poll.10s>
    @foreach($course_posts as $post)
        <x-sitebrew::member-area.post :post="$post" :course="$course" :section="$section">
        </x-sitebrew::member-area.post>
    @endforeach
</div>