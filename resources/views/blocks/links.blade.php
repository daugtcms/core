<div class="rounded-md container relative">
    @isset($backgroundImage)
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{($backgroundImage['url'])}}')"></div>
        <div class="absolute inset-0 bg-primary-500/35 pointer-events-none"></div>
    @endisset
    <div class="max-w-2xl mx-auto text-center py-16 px-4 sm:py-20 sm:px-6 lg:px-8">
        @isset($text)
        <h2
            @class([
            'text-3xl font-extrabold sm:text-4xl mb-4 font-accent drop-shadow-lg z-10',
            'text-white' => isset($backgroundImage),
            'text-primary-600' => !isset($backgroundImage),
            ])>
            <span class="block">{{$text}}</span>
        </h2>
        @endisset

        <div class="flex justify-center gap-x-4 flex-wrap z-10">

            @if($link1)
                <x-daugt::form.button style="primary" :href="$link1['url']">{{$link1['text']}}</x-daugt::form.button>
            @endif
            @if($link2)
                <x-daugt::form.button style="dark" :href="$link2['url']">{{$link2['text']}}</x-daugt::form.button>
            @endif
            @if($link3)
                <x-daugt::form.button style="light" :href="$link3['url']">{{$link3['text']}}</x-daugt::form.button>
            @endif
        </div>
    </div>
</div>
