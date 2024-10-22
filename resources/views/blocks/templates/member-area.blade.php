<div class="bg-neutral-100 min-h-full">
<style>
</style>
<div class="absolute inset-0 h-72 w-full">
    <img id="background-image" class="h-full w-full object-cover brightness-75" src="{{$background['url'] ?? 'https://media.felix.beer/temp/mountains.webp'}}">
    <div class="absolute inset-0 w-full h-full bg-gradient-to-tl from-primary-800/20 to-primary-500/60"></div>
</div>
    <div class="z-10 relative h-full">
        <div class="flex justify-between items-center container h-32" x-data>
            <a href="{{route('daugt.member-area.index')}}">
                <img class="max-h-24 max-w-[180px] py-6 mx-auto drop-shadow-lg" src="{{$logo["url"] ?? 'https://media.felix.beer/temp/logo.svg'}}">
            </a>
            <div class="w-16"><x-daugt::user-button></x-daugt::user-button></div>
        </div>
        <div class="">
            <div class="container">
                <h1 class="text-white text-3xl sm:text-5xl font-semibold mt-3 sm:mt-6 drop-shadow-xl mb-11">@stack('title')</h1>
            </div>
            {!! $slot !!}
        </div>

    </div>
</div>