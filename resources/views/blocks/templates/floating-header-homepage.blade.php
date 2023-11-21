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
    <div class=""
         :class="{
            'md:container rounded-lg transition-color duration-300': true,
            'bg-primary-700 shadow-primary-700/20  shadow-lg': showBackground,
        }">
        <div class="flex justify-between h-full container">
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

                <div class="border-l-2 border-white/50 h-10 mx-2 hidden md:block"></div>

                <!-- Navigation Links -->
                <div class="hidden h-full md:inline-flex">
                    @foreach(get_navigation_items((int)$mainNavigation) as $item)
                        <a href="{{isset($item->data['url']) ? $item->data['url'] : '#'}}"
                           target="{{isset($item->data['target']) ? $item->data['target'] : '_self'}}"
                           class="group text-white flex items-center h-full box-border border-b-[3px] border-transparent hover:border-primary-300 text-lg font-medium px-1">
                            <div class="rounded-md group-hover:bg-white/10 -mb-1 px-2.5 py-1">
                                {{$item->name}}
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="items-center hidden md:flex">

                <x-sitebrew::form.button style="secondary" href="{{route('login')}}">Login</x-sitebrew::form.button>
            </div>
            <!-- Settings Dropdown -->
            {{--<div class="flex items-center space-x-3">
                @auth
                    <div class="hidden md:flex md:items-center md:ml-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="flex items-center text-sm font-medium text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300">

                                    <div>{{ Auth::user()->name }}</div>

                                    <div class="ml-1">
                                        <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                             viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('user.show', Auth::user()->slug)">
                                    Profil
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('user.order.index', Auth::user())">
                                    Käufe & Abos
                                </x-dropdown-link>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>

                    <div class="hidden md:flex md:items-center md:ml-6">
                        <x-button :style="'primary'"
                                  :href="route('feed.community', 'all')"
                                  class="rounded-l-md rounded-r-none px-2 border-white">{{ __('Community') }}</x-button>
                        <x-button :style="'primary'"
                                  :href="route('feed.academy', [now()->year, 'all'])"
                                  class="rounded-r-md rounded-l-none px-2 border-white">{{ __('Academy') }}</x-button>
                    </div>
                @endauth
                @guest
                    <div class="hidden md:flex md:items-center md:ml-6">
                        <x-button :style="'primary'" :href="route('login')">{{ __('Login') }}</x-button>
                    </div>
                @endguest

                @if (str_contains(request()->route()->getName(),'shop'))
                    <x-shopping-cart></x-shopping-cart>
                @endif
                <!-- Hamburger -->

            </div>
        </div>--}}
            <div class="flex items-center md:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 text-primary-50 transition duration-150 ease-in-out rounded-md hover:text-white hover:bg-primary-600 focus:outline-none focus:bg-primary-600 focus:text-white">
                    <span x-show="open">
                        @svg('x')
                    </span>
                    <span x-show="! open">
                        @svg('menu')
                    </span>
                </button>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden bg-white rounded-b-lg border-primary-700 border-2 overflow-hidden">
            <div class="gap-y-1 divide-y-2 divide-neutral-200">
                @foreach(get_navigation_items((int)$mainNavigation) as $item)
                    <a href="{{isset($item->data['url']) ? $item->data['url'] : '#'}}"
                       target="{{isset($item->data['target']) ? $item->data['target'] : '_self'}}"
                       class="group text-neutral-800 flex items-center py-2 px-3 h-full box-border border-b-[3px] border-transparent hover:bg-primary-100 text-lg font-medium">
                        <div class="rounded-md group-hover:bg-white/10">
                            {{$item->name}}
                        </div>
                    </a>
                @endforeach
                <a href="{{route('login')}}"
                   class="group text-primary-800 flex items-center bg-primary-50 py-2 px-3 h-full box-border border-b-[3px] border-transparent hover:bg-primary-100 text-lg font-medium">
                    <div class="rounded-md group-hover:bg-white/10">
                        {{__('sitebrew::auth.login')}}
                    </div>
                </a>
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