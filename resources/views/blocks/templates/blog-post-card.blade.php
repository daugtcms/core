<a href="{{route('content.blog.show', $content->slug)}}"
        class="flex flex-col bg-neutral-100 transition rounded-xl overflow-hidden max-w-full flex-shrink-0 group">
    <div class="block aspect-[16/10] h-full w-full rounded-xl overflow-hidden">
        @php
        $backgroundImage = '';
        if(isset($content->blocks['template']['attributes']['backgroundImage'])) {
            $backgroundImage = $content->blocks['template']['attributes']['backgroundImage'];
        }
        @endphp
        <img
        src="{{get_single_media($backgroundImage)}}"
        alt=""
        class="h-full w-full object-cover group-hover:scale-110 duration-500 transition"
/>
</div>

<div class="flex flex-1 flex-col justify-between">
    <div class="h-0.5 rounded-full bg-neutral-300 group-hover:bg-primary-600 transition duration-500 group-hover:scale-105 mx-8 mt-5 -mb-3"></div>

    <div class="px-8 pt-5 pb-8">
            <h3 class="font-bold text-neutral-800 text-lg transition duration-500 group-hover:text-primary-700 line-clamp-3 leading-tight">
                {{$content->title}}
                    </h3>
            <time
                    datetime="2022-10-10"
                    class="flex items-center justify-between gap-4 text-xs font-bold uppercase text-neutral-400"
            >
                <span>{{$content->published_at->diffForHumans()}}</span>
            </time>
    </div>
</div>
</a>