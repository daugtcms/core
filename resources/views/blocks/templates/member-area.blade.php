<div class="bg-neutral-100 min-h-full">
<style>
    #background-image {
        -webkit-mask-image: linear-gradient(to bottom, #000000 33%, #00000000);
    }
</style>
<div class="absolute inset-0 h-full w-full">
    <img id="background-image" class="h-full w-full object-cover brightness-75" src="{{get_single_media($background) ?: 'https://images.unsplash.com/photo-1567532900872-f4e906cbf06a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1280&q=80'}}">
</div>
    <div class="z-10 relative h-full">
        <img class="max-h-32 max-w-[180px] py-6 mx-auto" src="{{get_single_media($logo) ?: 'https://images.unsplash.com/photo-1567532900872-f4e906cbf06a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1280&q=80'}}">
{!! $slot !!}
    </div>
</div>