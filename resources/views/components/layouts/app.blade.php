<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="w-full h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Pages Title' }}</title>

    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @googlefonts

</head>
<body class="w-full h-full">
<div class="flex flex-col h-full">
    <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
        <!-- Primary Navigation Menu -->
        <div class="px-4 mx-auto max-w-7xl">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="flex items-center shrink-0">
                        <a>
                            <div class="h-10">
                                <x-sitebrew::sitebrew-logo
                                        class="block w-full h-full drop-shadow-md"/>
                            </div>
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    {{--<div class="hidden space-x-6 sm:-my-px sm:ml-8 sm:flex">
                        <x-nav-link :active="request()->routeIs('feed.community')" :href="route('feed.community', 'all')">
                            {{ __('Community') }}
                        </x-nav-link>
                        @php
                            if(Request::is('feed/academy/*') || Request::is('feed/trainer/*')){
                                $year = request()->year;
                            } else {
                                $year = now()->year;
                            }
                        @endphp
                        <x-nav-link :active="request()->routeIs('feed.academy')"
                                    :href="route('feed.academy', [$year, 'all'])">
                            {{ __('Academy') }}
                        </x-nav-link>
                        <x-nav-link :active="request()->routeIs('feed.trainer')"
                                    :href="route('feed.trainer', [$year, 'all'])">
                            {{ __('Trainer') }}
                        </x-nav-link>
                        <x-nav-link :href="route('shop.index')">
                            {{ __('Shop') }}
                        </x-nav-link>
                        @admin
                        <x-nav-link :href="route('admin.order.index')"
                                    :active="str_contains(request()->route()->getName(),'admin')">
                            {{ __('Admin') }}
                        </x-nav-link>
                        @endadmin
                    </div>--}}
                </div>

                <!-- Settings Dropdown -->
                {{--<div class="hidden sm:flex sm:items-center sm:ml-6">
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
                </div>--}}

                <!-- Hamburger -->
                <div class="flex items-center -mr-2 sm:hidden">
                    <button @click="open = ! open"
                            class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
                        <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                                  stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"/>
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                                  stroke-linecap="round"
                                  stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{--<div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('feed.community', 'all')"
                                       :active="request()->routeIs('feed.community')">
                    {{ __('Community') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('feed.academy', [$year, 'all'])"
                                       :active="request()->routeIs('feed.academy')">
                    {{ __('Academy') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('feed.trainer', [$year, 'all'])"
                                       :active="request()->routeIs('feed.trainer')">
                    {{ __('Trainer') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('shop.index')">
                    {{ __('Shop') }}
                </x-responsive-nav-link>
                @admin
                <x-responsive-nav-link :href="route('admin.order.index')"
                                       :active="str_contains(request()->route()->getName(),'admin')">
                    {{ __('Admin') }}
                </x-responsive-nav-link>
                @endadmin
            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
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
            </div>
        </div>--}}
    </nav>
    <div class="flex-grow">
        {{ $slot }}
    </div>
</div>

{{-- modalwidth comment for tailwind purge, used widths: sm:max-w-sm sm:max-w-md sm:max-w-lg sm:max-w-xl sm:max-w-2xl sm:max-w-3xl sm:max-w-4xl sm:max-w-5xl sm:max-w-6xl sm:max-w-7xl --}}
@livewire('wire-elements-modal')

@livewireScriptConfig
</body>
