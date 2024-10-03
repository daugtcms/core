<div class="min-h-screen w-full relative flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-neutral-100">

    @if($background)
    <div class="absolute inset-0 bg-center bg-cover bg-no-repeat" style="background-image: url('{{ get_single_media($background) }}')">
        <div class="absolute inset-0 bg-black/30 backdrop-blur"></div>
    </div>
    @endif

    <div class="z-10">
        <img src="{{ get_single_media($logo) }}" class="max-w-xs max-h-20 drop-shadow-xl">
    </div>

    <div class="z-10 w-full sm:max-w-md mt-6 px-5 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
