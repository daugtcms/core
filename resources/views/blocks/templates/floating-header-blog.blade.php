<x-daugt::template-renderer :usage="'page'" :within-template="true" :attributes="['transparentNavigation' => true]">
<div class="relative w-full h-96 sm:h-[36rem]">
    <img class="absolute h-full w-full object-cover"
         src="{{get_single_media($backgroundImage) ?: 'https://images.unsplash.com/photo-1567532900872-f4e906cbf06a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1280&q=80'}}"
         alt="header-image">
    <div class="absolute h-full w-full bg-gradient-to-tl from-primary-800/70 to-primary-300/60"></div>
    <div class="container mx-auto px-4 h-full">
        <div class="relative sm:overflow-hidden h-full flex flex-col sm:flex-row items-center justify-center sm:pt-0">
            <div class="relative flex items-center justify-center flex-col">
                @php
                    $item = get_listing_item($category);
                @endphp
                @if($item->id)
                <span class="inline-flex items-center rounded-full bg-primary-100/60 px-2 py-1 text-sm mb-2 font-medium text-primary-800 backdrop-blur ring-1 ring-inset ring-primary-700/10">
                    @if($item)
                        @if($item->icon)
                            <div class="i-lucide:{{$item->icon}} w-4 h-4 mr-1"></div>
                        @endif
                        {{
                            $item->name
                        }}
                    @endif
                </span>
                @endif
                <h1 class="text-4xl text-center font-extrabold drop-shadow tracking-tight sm:text-5xl lg:text-7xl underline decoration-secondary-500/50">
                    <span class="block text-secondary-400 drop-shadow-xl">{{$title ?: 'Lorem ipsum'}}</span>
                </h1>
                <p class="mt-6 max-w-lg text-xl md:text-2xl text-secondary-50 text-center">
                </p>
            </div>
        </div>
    </div>
</div>
{!! $slot !!}
</x-daugt::template-renderer>