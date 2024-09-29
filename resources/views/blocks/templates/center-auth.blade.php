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
    <!--<div class="mx-auto text-center z-10 text-white flex items-center gap-x-2 mt-2.5 opacity-75 hover:opacity-100 transition-all text-sm">
        Powered by <a class="flex items-center justify-center bg-amber-600 grayscale hover:grayscale-0 font-medium transition-all rounded-md px-2 py-1 gap-x-1"><div class="w-4 h-4 flex items-center justify-center">@svg('daugt', 'h-auto w-auto inline-block')</div> Daugt</a>
    </div>-->
</div>
