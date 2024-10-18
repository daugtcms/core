<x-daugt::template-renderer :usage="'page'">
    <section class="py-6">
        <div class="container mx-auto px-4">
            {{--<nav class="flex">
                <ol role="list" class="flex items-center">
                    <li class="text-left">
                        <div class="-m-1">
                            <a href="#" class="rounded-md p-1 text-sm font-medium text-neutral-600 focus:text-neutral-900 focus:shadow hover:text-neutral-800"> Home </a>
                        </div>
                    </li>

                    <li class="text-left">
                        <div class="flex items-center">
                            <span class="mx-2 text-neutral-400">/</span>
                            <div class="-m-1">
                                <a href="#" class="rounded-md p-1 text-sm font-medium text-neutral-600 focus:text-neutral-900 focus:shadow hover:text-neutral-800"> Products </a>
                            </div>
                        </div>
                    </li>

                    <li class="text-left">
                        <div class="flex items-center">
                            <span class="mx-2 text-neutral-400">/</span>
                            <div class="-m-1">
                                <a href="#" class="rounded-md p-1 text-sm font-medium text-neutral-600 focus:text-neutral-900 focus:shadow hover:text-neutral-800" aria-current="page"> Coffee </a>
                            </div>
                        </div>
                    </li>
                </ol>
            </nav>--}}

            <div class="lg:col-gap-12 xl:col-gap-16 mt-8 grid grid-cols-1 gap-12 lg:mt-12 lg:grid-cols-5 lg:gap-16">
                <div class="lg:col-span-3 lg:row-end-1">
                    <div class="lg:flex lg:items-start">
                        <div class="lg:order-2 lg:ml-5">
                            <div class="max-w-xl overflow-hidden rounded-lg">
                                <img class="h-full w-full max-w-full object-cover"
                                     src="{{isset($product->media[0]) ? \Daugt\Helpers\Media\MediaHelper::getMedia($product->media[0], 'optimized') : ''}}"
                                     alt=""/>
                            </div>
                        </div>

                        <div class="mt-2 w-full lg:order-1 lg:w-32 lg:flex-shrink-0">
                            <div class="flex flex-row items-start lg:flex-col">
                                @foreach($product->media as $mediaItem)
                                    <button type="button"
                                            class="flex-0 aspect-square mb-3 h-20 overflow-hidden rounded-lg border-2 border-secondary-500 text-center">
                                        <img class="h-full w-full object-cover"
                                             src="{{\Daugt\Helpers\Media\MediaHelper::getMedia($mediaItem, 'thumbnail')}}"
                                             alt=""/>
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-2 lg:row-span-2 lg:row-end-2">
                    <h1 class="sm: text-2xl font-bold text-neutral-800 sm:text-3xl">{{$product->name}}</h1>

                    <div class="mt-5 flex flex-col items-center justify-between space-y-4 border-t border-b py-4 sm:flex-row sm:space-y-0">
                        <div class="flex items-end">
                            <h1 class="text-2xl font-bold text-neutral-800">€@number($product->price)</h1>
                            {{--<span class="text-base">/month</span>--}}
                        </div>

                        <x-daugt::form.button style="primary" class="px-4 py-2 gap-x-2"
                                                 target="{{$product->external_url ? '_blank' : ''}}"
                                                 :href="$product->external_url ?: route('daugt.cart.add',$product)">
                            @if(!$product->external_url)
                                <div class="i-lucide:shopping-basket"></div>
                                {{__('daugt::shop.add_to_cart')}}
                            @else
                                {{__('daugt::shop.navigate_to_external_shop')}}
                                <div class="i-lucide:arrow-right"></div>
                            @endif
                        </x-daugt::form.button>
                    </div>

                    <ul class="mt-8 space-y-3">
                        @if($product->external_url)
                            <li class="flex items-center text-left text-sm font-normal text-neutral-600">
                                <div class="i-lucide:store mr-2 block h-5 w-5 align-middle text-neutral-500"></div>
                                {{__('daugt::shop.selled_by')}}
                                &nbsp;<strong>{{str_ireplace('www.', '', parse_url($product->external_url, PHP_URL_HOST))}}</strong>
                            </li>
                        @endif

                        @if($product->shipping)
                            <li class="flex items-center text-left text-sm font-normal text-neutral-600">
                                <div class="i-lucide:truck mr-2 block h-5 w-5 align-middle text-neutral-500"></div>
                                {{__('daugt::shop.shipping_product')}}
                                &nbsp;<strong>{{str_ireplace('www.', '', parse_url($product->external_url, PHP_URL_HOST))}}</strong>
                            </li>
                            @php
                                $other_countries = collect(explode(',', config('daugt.shop.shipping.allowed_countries')));
                                $other_countries = $other_countries->filter(function ($country) {
                                    return $country !== config('daugt.shop.shipping.code');
                                })->implode(', ');
                            @endphp
                            <li class="flex items-center text-left text-sm font-normal text-neutral-600">
                                <div class="i-lucide:package mr-2 block h-5 w-5 align-middle text-neutral-500"></div>
                                {{__('daugt::shop.shipping_costs', ['country' => Locale::getDisplayRegion(config('daugt.shop.shipping.locale'), config('daugt.shop.shipping.locale')), 'other_countries' => $other_countries])}}
                            </li>
                        @endif

                        {{--@if($product->course_id)
                            <li class="flex items-center text-left text-sm font-normal text-neutral-600">
                                <div class="i-lucide:book-marked mr-2 block h-5 w-5 align-middle text-neutral-500"></div>
                                {{ __('daugt::shop.access_to_course') }}&nbsp;<b>{{$product->course->name}}</b>
                            </li>
                            @if($product->starts_at)
                                <li class="flex items-center text-left text-sm font-normal text-neutral-600">
                                    <div class="i-lucide:arrow-up-from-dot mr-2 block h-5 w-5 align-middle text-neutral-500"></div>
                                    {{__('daugt::shop.from', ['from' => $product->starts_at->format('d.m.Y')])}}
                                </li>
                            @endif
                            @if($product->ends_at)
                                <li class="flex items-center text-left text-sm font-normal text-neutral-600">
                                    <div class="i-lucide:arrow-down-to-dot mr-2 block h-5 w-5 align-middle text-neutral-500"></div>
                                    {{__('daugt::shop.to', ['to' => $product->ends_at->format('d.m.Y')])}}
                                </li>
                            @endif
                        @endif--}}

                    </ul>
                </div>

                <div class="lg:col-span-3">
                    <div class="border-b border-neutral-300">
                        <nav class="flex gap-4">
                            <a title=""
                               class="border-b-2 border-primary-500 py-2 text-base font-medium text-neutral-800">
                                {{__('daugt::general.description')}} </a>

                        </nav>
                    </div>

                    @if(!empty($product->description))
                        <div class="mt-6 flow-root">
                            <x-daugt::blocks-renderer :data="$product->description"></x-daugt::blocks-renderer>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</x-daugt::template-renderer>