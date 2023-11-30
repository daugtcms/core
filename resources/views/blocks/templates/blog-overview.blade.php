<x-sitebrew::template-renderer :usage="'page'" :within-template="true" :attributes="['transparentNavigation' => false]">
    <div class="container mt-8 pb-5">
    <div class="flex flex-col items-center justify-center">
        <h2
        @class([
        'text-2xl font-semibold text-primary-600',
        ])>{{$title ?: 'Lorem ipsum dolor sit amet.'}}</h2>
    <h3 class="text-neutral-700 pt-1">{{$subtitle}}</h3>
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
        <div class="grid grid-cols-3 gap-6 mt-4">
        {!! $slot !!}
        </div>
    </div>

</x-sitebrew::template-renderer>