<div class="bg-black/50 rounded-xl overflow-hidden h-64 bg-cover bg-center relative shadow-lg px-6 py-2 flex flex-col justify-center "
     style="background-image: url('{{$image['url']}}')">
    <div class="absolute inset-0 bg-gradient-to-bl from-primary-300/25 to-primary-600/90"></div>
    <div class="relative z-10 pointer-events-none">
        <h2 class="text-white text-2xl sm:text-3xl font-semibold">{{$content->title}}</h2>
        <div class="flex items-center mt-4 gap-x-2.5">
            <x-daugt::avatar class="h-12 w-12"></x-daugt::avatar>
            <div>
                <p class="text-primary-50 text-lg sm:text-xl font-medium">{{$content->user->name}}</p>
                <p class="text-primary-100 -mt-1.5 text-base sm:text-lg text-base">{{$content->published_at->diffForHumans()}}</p>
            </div>
        </div>
    </div>
    <a href="{{route('daugt.content.show', ['post', $content->slug]) }}"
       class="absolute top-0 left-0 z-0 w-full h-full">
    </a>
</div>