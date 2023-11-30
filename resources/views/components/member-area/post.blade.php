@props(['post', 'course', 'section'])
@php
    if(isset($post->blocks['template']['attributes']['featuredImage'][0]['id'])) {
    $backgroundImage = MediaHelper::getMediaById($post->blocks['template']['attributes']['featuredImage'][0]['id'],'optimized');
    } else {
    $backgroundImage = null;
    }
@endphp
<div class="bg-black/50 rounded-xl overflow-hidden h-64 bg-cover bg-center relative shadow-lg px-6 py-2 flex flex-col justify-center " style="background-image: url('{{$backgroundImage}}')">
    <div class="absolute inset-0 bg-gradient-to-bl from-primary-300/25 to-primary-600/90"></div>
    <div class="relative z-10 pointer-events-none">
        @if(isset($post->blocks['template']['attributes']['courseSection']))
            @php
                $tempSection = \Sitebrew\Models\Listing\ListingItem::with('listing')->find($post->blocks['template']['attributes']['courseSection']);
                $tempCourse = $tempSection->listing;
            @endphp
            <h2 class="text-white/70 text-lg sm:text-xl font-semibold flex items-center -space-x-0.5"><span>{{$tempCourse->name}}</span> @svg('dot') <span>{{$tempSection->name}}</span></h2>
        @endif
        <h2 class="text-white text-2xl sm:text-3xl font-semibold">{{$post->title}}</h2>
        <div class="flex items-center mt-4 gap-x-2.5">
            <x-sitebrew::avatar class="h-12 w-12"></x-sitebrew::avatar>
            <div>
                <p class="text-primary-50 text-lg sm:text-xl font-medium">{{$post->user->name}}</p>
                <p class="text-primary-100 -mt-1.5 text-base sm:text-lg text-base">{{$post->published_at->diffForHumans()}}</p>
            </div>
        </div>
    </div>
    <a href="{{route('member-area.post.show', $post->slug) }}"
       class="absolute top-0 left-0 z-0 w-full h-full">
    </a>
</div>