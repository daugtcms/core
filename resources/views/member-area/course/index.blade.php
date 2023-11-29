<x-sitebrew::layouts.member-area-layout>
    <div class="container">
        <a href="{{route('member-area.index')}}" class="text-neutral-100 bg-neutral-100/10 hover:bg-neutral-100/25 inline-flex rounded-md items-center font-medium gap-x-1 px-2 py-1 sm:mt-4 mb-4">
            @svg('arrow-left', 'w-4 h-4')
            Zurück
        </a>
        <h1 class="text-white/80 text-3xl sm:text-5xl font-semibold mb-4">{{$course->name}}</h1>

        <div class="w-full bg-white/75 backdrop-blur-md rounded-xl flex p-3 gap-x-2 mb-5 overflow-x-auto">
            <a
                    @class([
     'px-1.5 py-0.5 text-base sm:text-lg hover:text-primary-600 rounded-md hover:bg-primary-50',
                          'bg-primary-100 text-primary-600' => !isset($section)
                     ])
                    href="{{route('member-area.course.show', ['course' => $course->slug, 'section' => 'all'])}}">Alle</a>
            @foreach($course->items as $item)
                    <a
                       @class([
        'px-1.5 py-0.5 text-base sm:text-lg hover:text-primary-600 rounded-md hover:bg-primary-50',
                             'bg-primary-100 text-primary-600' => isset($section) && $section->slug === $item->slug
                        ])
                       href="{{route('member-area.course.show', ['course' => $course->slug, 'section' => $item->slug])}}">{{$item->name}}</a>
            @endforeach
        </div>
    </div>


    <livewire:sitebrew::member-area.course-posts :course="$course" :section="$section ? $section->slug : ''"></livewire:sitebrew::member-area.course-posts>
</x-sitebrew::layouts.member-area-layout>