<x-sitebrew::template-renderer :usage="'page'" :within-template="true" :attributes="['transparentNavigation' => true]">
        <div class="relative w-full h-96 sm:h-[36rem]">
            <img class="absolute h-full w-full object-cover"
                 src="{{get_single_media($backgroundImage) ?: 'https://images.unsplash.com/photo-1567532900872-f4e906cbf06a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1280&q=80'}}"
                 alt="header-image">
            <div class="absolute h-full w-full bg-gradient-to-tl from-primary-800/70 to-primary-300/60"></div>
            <div class="container mx-auto px-4 h-full">
                <div class="relative sm:overflow-hidden h-full flex flex-col sm:flex-row items-center justify-center sm:pt-0">
                    <div class="relative flex items-center justify-center flex-col pl-4">
                        <h1 class="text-4xl text-left font-extrabold drop-shadow tracking-tight sm:text-5xl lg:text-7xl">
                            <span class="block text-secondary-400 drop-shadow-xl text-center">{{$title ?: 'Lorem ipsum'}}</span>
                        </h1>
                        <p class="mt-6 max-w-lg text-xl md:text-2xl text-secondary-50 text-center">
                            {{$subtitle ?: 'Et labore velit Lorem reprehenderit reprehenderit reprehenderit.'}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    <div class="container">
        <div class="flex flex-col items-center justify-center">
        <div class="w-full bg-neutral-100/75 backdrop-blur-md rounded-xl flex p-3 gap-x-2 mb-5 overflow-x-auto mt-6">
            <a
                    @class([
     'px-1.5 py-0.5 text-base sm:text-lg hover:text-primary-600 rounded-md hover:bg-primary-50',
                          'bg-primary-100 text-primary-600' => !request()->has('category')
                     ])
                    href="{{route('content.blog.index', ['category' => null])}}">Alle</a>
            @php
                $categories = \Sitebrew\Models\Listing\Listing::where('usage', \Sitebrew\Enums\Listing\ListingUsage::BLOG_CATEGORIES)->with('items')->first()->items;
            @endphp
            @foreach($categories as $item)
                <a
                        @class([
         'px-1.5 py-0.5 text-base sm:text-lg hover:text-primary-600 rounded-md hover:bg-primary-50',
                              'bg-primary-100 text-primary-600' => request()->query('category') == $item->slug
                         ])
                        href="{{route('content.blog.index', ['category' => $item->slug])}}">{{$item->name}}</a>
            @endforeach
        </div>
    </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">
        {!! $slot !!}
        </div>
    </div>

</x-sitebrew::template-renderer>