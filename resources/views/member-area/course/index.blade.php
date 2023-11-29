<x-sitebrew::layouts.member-area-layout>
    <div class="container bg-white rounded-md">
    </div>

    <livewire:sitebrew::member-area.course-posts :course="$course" :section="$section ? $section->slug : ''"></livewire:sitebrew::member-area.course-posts>
</x-sitebrew::layouts.member-area-layout>