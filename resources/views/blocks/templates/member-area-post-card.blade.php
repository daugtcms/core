<div class="bg-white rounded-xl h-64 bg-cover bg-center relative shadow-lg px-6 py-2 flex flex-col justify-center "
     @isset($image['url']) style="background-image: url('{{$image['url']}}')" @endisset>
    @isset($image['url'])
    <div class="absolute inset-0 bg-gradient-to-bl rounded-xl from-primary-300/25 to-primary-600/90"></div>
    @endisset
    <div class="relative z-10 pointer-events-none">
        <h2
        @class([
        'text-2xl sm:text-3xl font-semibold pointer-events-none font-accent',
        'text-neutral-700' => !isset($image['url']),
        'text-white' => isset($image['url'])
        ])>{{$content->title}}</h2>
        <div class="flex items-center mt-4 gap-x-2.5">
            <x-daugt::avatar class="h-12 w-12"></x-daugt::avatar>
            <div>
                <p
                    @class([
                        'text-lg sm:text-xl font-medium',
                        'text-neutral-600' => !isset($image['url']),
                        'text-primary-50' => isset($image['url'])
                    ])
                >{{$content->user->name}}</p>
                <p
                    @class([
                            '-mt-1.5 text-base sm:text-lg text-base',
                            'text-neutral-500' => !isset($image['url']),
                            'text-primary-100' => isset($image['url'])
                        ])
                >{{$content->published_at->diffForHumans()}}</p>
            </div>
        </div>
        <x-daugt::user.reactions class="z-20 pt-3 pointer-events-auto" :style="'dark'" :reactions="$content->reactions" :comments="$content->comments" :route="route('daugt.content.show', ['post', $content->slug])"
            :comments-enabled="$allow_member_comments ?? false" :reactions-enabled="$allow_member_reactions ?? false"
        ></x-daugt::user.reactions>
    </div>
    <a href="{{route('daugt.content.show', ['post', $content->slug]) }}"
       class="absolute top-0 left-0 z-0 w-full h-full">
    </a>
</div>