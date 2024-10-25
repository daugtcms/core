<div class="rounded-md bg-primary-500/50 container">
    <div class="max-w-2xl mx-auto text-center py-16 px-4 sm:py-20 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
            <span class="block">{{$text}}</span>
        </h2>

        <div class="flex justify-center gap-x-4 flex-wrap">

            @if($link1)
                <x-daugt::form.button style="primary" :href="$link1['url']">{{$link1['text']}}</x-daugt::form.button>
            @endif
            @if($link2)
                <x-daugt::form.button style="light" :href="$link2['url']">{{$link2['text']}}</x-daugt::form.button>
            @endif
            @if($link3)
                <x-daugt::form.button style="dark" :href="$link3['url']">{{$link3['text']}}</x-daugt::form.button>
            @endif
        </div>
    </div>
</div>
