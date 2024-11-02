<x-daugt::layouts.member-area-layout>
    @push('title'){{$course->name}}@endpush
    <div class="container">
        <div class="p-3 bg-white rounded-lg flex gap-x-2 mb-5 overflow-x-auto">
            <a
                    @class([
     'px-1.5 py-0.5 text-base sm:text-lg hover:text-primary-600 rounded-md hover:bg-primary-50',
                          'bg-primary-100 text-primary-600' => !isset($section)
                     ])
                    href="{{route('daugt.member-area.course.show', ['course' => $course->slug, 'section' => 'all'])}}">Alle</a>
            @foreach($course->items as $item)
                    <a
                       @class([
        'px-1.5 py-0.5 text-base sm:text-lg hover:text-primary-600 rounded-md hover:bg-primary-50 whitespace-nowrap',
                             'bg-primary-100 text-primary-600' => isset($section) && $section->slug === $item->slug
                        ])
                       href="{{route('daugt.member-area.course.show', ['course' => $course->slug, 'section' => $item->slug])}}">{{$item->name}}</a>
            @endforeach
        </div>
    </div>
    <livewire:daugt::member-area.course-posts :course="$course" :section="$section ? $section->slug : ''"></livewire:daugt::member-area.course-posts>
</x-daugt::layouts.member-area-layout>