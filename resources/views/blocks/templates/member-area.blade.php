<div class="bg-neutral-100 min-h-full">
<style>
    #background-image {
        -webkit-mask-image: linear-gradient(to bottom, #000000 33%, #00000000);
    }
</style>
<div class="absolute inset-0 h-1/2 w-full">
    <img id="background-image" class="h-full w-full object-cover brightness-75" src="{{get_single_media($background) ?: 'https://images.unsplash.com/photo-1567532900872-f4e906cbf06a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1280&q=80'}}">
</div>
    <div class="z-10 relative h-full">
        <div class="flex justify-between items-center container h-32" x-data>
            <a href="{{route('daugt.member-area.index')}}">
                <img class="max-h-24 max-w-[180px] py-6 mx-auto drop-shadow-lg" src="{{get_single_media($logo) ?: 'https://images.unsplash.com/photo-1567532900872-f4e906cbf06a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1280&q=80'}}">
            </a>
            <div class="w-16"><x-daugt::user-button></x-daugt::user-button></div>
        </div>
        <div class="">
        {!! $slot !!}
        </div>

    </div>
</div>