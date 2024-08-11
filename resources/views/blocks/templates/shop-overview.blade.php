<x-daugt::template-renderer :usage="'page'" :within-template="true" :attributes="['transparentNavigation' => true]">
    <div class="relative w-full h-96 sm:h-[36rem]">
        <img class="absolute h-full w-full object-cover"
             src="{{get_single_media($backgroundImage) ?: 'https://images.unsplash.com/photo-1567532900872-f4e906cbf06a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1280&q=80'}}"
             alt="header-image">
        <div class="absolute h-full w-full bg-gradient-to-tl from-primary-800/70 to-primary-300/60"></div>
        <div class="container mx-auto px-4 h-full">
            <div class="relative sm:overflow-hidden h-full flex flex-col sm:flex-row items-center justify-center sm:pt-0">
                <div class="relative flex items-center justify-center flex-col">
                    <h1 class="text-4xl text-left font-extrabold drop-shadow tracking-tight sm:text-5xl lg:text-7xl">
                        <span class="block text-secondary-400 drop-shadow-xl text-center">{{$title ?: 'Lorem ipsum'}}</span>
                    </h1>
                    <p class="mt-6 max-w-lg text-xl md:text-2xl text-secondary-50 text-center">
                        {{$description ?: 'Et labore velit Lorem reprehenderit reprehenderit reprehenderit.'}}
                    </p>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 w-full bg-white/50 backdrop-blur h-20 flex items-center justify-start px-4 gap-x-4 overflow-x-auto">
            @php
                $shop_categories = \Daugt\Models\Listing\Listing::where('usage', \Daugt\Enums\Listing\ListingUsage::SHOP_CATEGORIES)->with('items')->first();
            @endphp

            @php
                $active = empty(request()->get('category'));
            @endphp
            <a href="{{route('shop.index')}}"
               class="inline-flex items-center justify-center flex-col h-auto whitespace-nowrap text-center px-2 py-1 rounded-md hover:bg-primary-100/50 transition-colors duration-200 {{$active ? 'bg-primary-100/75' : ''}}">
                <span class="text-lg font-medium {{$active ? 'text-primary-800' : 'text-primary-800'}}">{{__('daugt::shop.all_products')}}</span>
            </a>
            @foreach($shop_categories->items as $item)
                @php
                    $active = request()->get('category') === $item->slug;
                @endphp
                <a href="{{route('shop.index', ['category' => $item->slug])}}"
                   class="inline-flex items-center justify-center flex-col h-auto whitespace-nowrap text-center px-2 py-1 rounded-md hover:bg-primary-100/50 transition-colors duration-200 {{$active ? 'bg-primary-100/75' : ''}}">
                    @if($item->icon)
                        @svg($item->icon, 'w-8 h-8 mb-1')
                    @endif
                    <span class="text-lg font-medium {{$active ? 'text-primary-800' : 'text-primary-800'}}">{{$item->name}}</span>
                </a>

            @endforeach
        </div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 container gap-4 mt-4">
        {!! $slot !!}
    </div>
</x-daugt::template-renderer>