@if(!$transparentNavigation)
    <div class="h-20"></div>
@else
    <div class="fixed h-24 w-full top-0 bg-gradient-to-b from-black/40 to-transparent transition-opacity duration-500 z-10"
         x-data="{ showShadow: true }"
         :class="{
            'opacity-100': showShadow,
            'opacity-0': !showShadow,
        }"
         @scroll.window="showShadow = window.scrollY < 20"
    ></div>
@endif


<nav x-data="{ open: false, showBackground: {{$transparentNavigation ? 'false' : 'true'}} }"
     class="pt-3 fixed w-full top-0 z-50 px-3"
     @if($transparentNavigation)
         @scroll.window="showBackground = window.scrollY > 20"
        @endif>
    <!-- Primary Navigation Menu -->
    <div class="lg:container rounded-lg transition-color duration-300"
         :class="{
            'bg-primary-700 shadow-primary-700/20  shadow-lg': showBackground || open,
        }">
        <div class="flex justify-between h-full px-4 lg:px-0">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="flex items-center shrink-0 h-16 py-3">
                    <a href="/"
                       class="h-full">
                        <img src="{{ get_single_media($logo) ?: 'https://media.felix.beer/temp/hilde-logo.svg'}}"
                             alt="logo"
                             class="h-full mr-3">
                    </a>
                </div>

                <div class="border-l-2 border-white/50 h-10 mx-2 hidden lg:block"></div>

                <!-- Navigation Links -->
                <div class="hidden h-full lg:inline-flex">
                    @foreach($mainNavigation->items as $item)
                        <a href="{{isset($item->data['url']) ? $item->data['url'] : '#'}}"
                           target="{{isset($item->data['target']) ? $item->data['target'] : '_self'}}"
                           class="group text-white flex whitespace-nowrap items-center h-full box-border border-b-[3px] border-transparent hover:border-primary-300 text-lg font-medium px-1">
                            <div class="rounded-md group-hover:bg-white/10 -mb-1 px-2.5 py-1 whitespace-nowrap">
                                {{$item->name}}
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="inline-flex items-center gap-x-3">
            <x-daugt::shop.shopping-cart>
                <div class="p-2 rounded-md hover:bg-white/10 h-full">
                    <div class="i-lucide:shopping-cart text-white"></div>
                </div>
            </x-daugt::shop.shopping-cart>

            <div class="items-center hidden lg:flex">
                @guest
                <x-daugt::form.button style="secondary" href="{{route('daugt.login')}}">Login</x-daugt::form.button>
                @endguest
                @auth
                    <x-daugt::user-button></x-daugt::user-button>
                @endauth
            </div>
            <div class="flex items-center lg:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 text-primary-50 transition duration-150 ease-in-out rounded-md hover:text-white hover:bg-primary-600 focus:outline-none focus:bg-primary-600 focus:text-white">
                    <span x-show="open">
                        <div class="i-lucide:x"></div>
                    </span>
                    <span x-show="! open">
                        <div class="i-lucide:menu"></div>
                    </span>
                </button>
            </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden lg:hidden bg-white rounded-b-lg border-primary-700 border-2 overflow-hidden">
            <div class="gap-y-1 divide-y-2 divide-neutral-200" x-data>
                @foreach($mainNavigation->items as $item)
                    <a href="{{isset($item->data['url']) ? $item->data['url'] : '#'}}"
                       target="{{isset($item->data['target']) ? $item->data['target'] : '_self'}}"
                       class="group text-neutral-800 flex items-center py-2 px-3 h-full box-border border-b-[3px] border-transparent hover:bg-primary-100 text-lg font-medium">
                        <div class="rounded-md group-hover:bg-white/10">
                            {{$item->name}}
                        </div>
                    </a>
                @endforeach
                    @auth
                        <x-daugt::responsive-user-button></x-daugt::responsive-user-button>
                    @endauth
                    @guest
                        <a href="{{route('daugt.login')}}"
                           class="group text-primary-800 flex items-center bg-primary-50 py-2 px-3 h-full box-border border-b-[3px] border-transparent hover:bg-primary-100 text-lg font-medium">
                            <div class="rounded-md group-hover:bg-white/10">
                                {{__('daugt::auth.login')}}
                            </div>
                        </a>
                    @endguest
            </div>

            <!-- Responsive Settings Options -->
            {{--<div class="pt-1 pb-1 border-t border-gray-200">
                @auth
                    <div class="flex items-center px-4 py-3 w-full">
                        <x-button :style="'primary'"
                                  :href="route('feed.community', 'all')"
                                  class="rounded-l-md rounded-r-none px-2 border-white w-1/2">{{ __('Community') }}</x-button>
                        <x-button :style="'primary'"
                                  :href="route('feed.academy', [now()->year, 'all'])"
                                  class="rounded-r-md rounded-l-none px-2 border-white w-1/2">{{ __('Academy') }}</x-button>
                    </div>
                    <div class="px-4 pt-3 border-t">
                        <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <x-responsive-nav-link :href="route('user.show', Auth::user()->slug)">
                            Profil
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('user.order.index', Auth::user())">
                            Käufe & Abos
                        </x-responsive-nav-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-responsive-nav-link>
                        </form>
                    </div>
                @endauth

                @guest
                    <div class=" space-y-1">

                        <x-responsive-nav-link :href="route('login')" :active="true">
                            {{ __('Login') }}
                        </x-responsive-nav-link>
                    </div>
                @endguest
            </div>--}}
        </div>
    </div>
</nav>
{!! $slot !!}
<footer class="border-t-2 border-x-2 sm:rounded-t-xl border-neutral-100 bg-neutral-50 mt-4 container">
    <div class="mx-auto w-full max-w-7xl px-5 pt-8 pb-5">
        <div class="flex flex-col items-center">
            <div class="flex flex-wrap items-center justify-center gap-x-5 gap-y-3 border-b-2 border-neutral-200 pb-4">
                @if(!empty($footerNavigation))
                @php
                    $navigation = get_listing_items((int)$footerNavigation);
                @endphp
                @foreach($navigation as $item)
                    <a href="{{isset($item->data['url']) ? $item->data['url'] : '#'}}"
                       target="{{isset($item->data['target']) ? $item->data['target'] : '_self'}}"
                       class="text-base font-medium text-neutral-600 hover:text-primary-500">
                        {{$item->name}}
                    </a>
                @endforeach
                @endif
            </div>

            <div class="mb-6 flex items-center gap-x-5 pt-5">
                @if(!empty($socialMediaLinks))
                    @php
                        $socialMedia = get_listing_items((int)$socialMediaLinks);
                    @endphp
                    @foreach($socialMedia as $item)
                        <a href="{{isset($item->data['url']) ? $item->data['url'] : '#'}}"
                           target="{{isset($item->data['target']) ? $item->data['target'] : '_self'}}"
                           class="text-base text-neutral-600 hover:text-primary-500">
                            <div class="i-lucide:{{$item->icon}} w-6 h-6"></div>
                        </a>
                    @endforeach
                @endif
            </div>
            <p class="text-sm text-neutral-500">&copy; {{ date('Y') }} {{config('app.name')}}, all rights reserved.</p>
        </div>
    </div>
</footer>