<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="w-full h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Pages Title' }}</title>

    @livewireStyles

    {{--<link rel="stylesheet" href="/vendor/sitebrew/build/assets/app.css">
    <script type="module" src="/vendor/sitebrew/build/assets/app.js"></script>--}}

    {{ Vite::useHotFile('vendor/sitebrew/sitebrew.hot')
        ->useBuildDirectory("vendor/sitebrew")
        ->withEntryPoints(['resources/css/app.css', 'resources/js/app.js']) }}
    @googlefonts

</head>
<body class="w-full h-full">
<div class="flex flex-col h-full">
    @php

        use Sitebrew\Enums\Admin\AdminPath;
        use Sitebrew\Helpers\Admin\AdminPathColor;
        // check if route path starts with admin/structure
        $pathComponents = explode("/", request()->path());
        if(count($pathComponents) > 1){
            $path = $pathComponents[1];
        } else {
            $path = $pathComponents[0];
        }

        $navigationItems = [];
        switch ($path){
            case AdminPath::ADMIN->value:
                $title = __('sitebrew::general.admin');
                break;
            case AdminPath::STRUCTURE->value:
                $title = __('sitebrew::general.structure');
                $navigationItems = [
                    [
                        'name' => __('sitebrew::general.listing'),
                        'url' => route('admin.structure.listing'),
                    ],
                    [
                        'name' => __('sitebrew::general.templates'),
                        'url' => route('admin.structure.templates'),
                    ]
                ];
                break;
            case AdminPath::CONTENT->value:
                $title = __('sitebrew::general.content');

                $navigationItems = collect();

                // add all content types to listing
                $navigationItems = (collect(config('sitebrew.content_types'))->map(function($contentType, $key){
                    return [
                        'name' => $contentType,
                        'url' => route('admin.content.index', ['type' => $key]),
                    ];
                }));

                $navigationItems->prepend([
                    'name' => __('sitebrew::general.all'),
                    'url' => route('admin.content.index'),
                ]);
                break;
            case AdminPath::SHOP->value:
                $title = __('sitebrew::general.shop');
                $navigationItems = [
                    [
                        'name' => __('sitebrew::general.orders'),
                        'url' => route('admin.shop.orders.index'),
                    ],
                    [
                        'name' => __('sitebrew::general.products'),
                        'url' => route('admin.shop.product.index'),
                    ],
                ];
                break;
        }

    @endphp
    <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
        <!-- Primary Navigation Menu -->
        <div class="px-4 mx-auto max-w-7xl">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="flex items-center shrink-0">
                        <div class="flex items-center h-full py-1.5" x-data>
                            <button class="flex items-center h-full gap-x-2.5 hover:bg-neutral-100 pl-1.5 pr-2.5 rounded-md cursor-pointer"
                                    @click="$refs.panel.toggle">
                                <div class="p-2 rounded-lg text-primary-50 h-10 w-10"
                                     style="background-color: {{AdminPathColor::getColor(AdminPath::from($path))}}">
                                    @svg('sitebrew', 'h-full flex-shrink-0 drop-shadow-md')
                                </div>

                                <p class="text-lg font-semibold text-neutral-700 pt-0.5">@if($path == AdminPath::ADMIN->value)
                                        Sitebrew
                                    @else
                                        {{ __('sitebrew::general.' . $path) }}
                                    @endif</p>
                            </button>

                            <div x-ref="panel" x-float.placement.bottom-start.offset.trap.hide x-cloak
                                 class="absolute bg-white rounded-md shadow-md overflow-hidden divide-y divide-neutral-200 border-neutral-200 border z-10">
                                @php
                                    $cases = AdminPath::cases();
                                    $cases = collect($cases)->filter(fn($case) => $case->value != $path)->toArray();
                                @endphp
                                @foreach($cases as $casePath)
                                    <a class="flex items-center h-full gap-x-2.5 hover:bg-neutral-100 pl-1.5 pr-2.5 py-1.5 cursor-pointer"
                                       href="{{$casePath == AdminPath::ADMIN ? route("admin.index") : route("admin.$casePath->value.index")}}">
                                        <div class="p-2 rounded-lg text-primary-50 h-10 w-10"
                                             style="color: {{AdminPathColor::getColor($casePath)}}; background-color: {{AdminPathColor::getColor($casePath)}}22">
                                            @svg(AdminPathColor::getIcon($casePath), 'h-full flex-shrink-0 drop-shadow-md')
                                        </div>

                                        <p class="text-base font-medium text-neutral-700 pt-0.5">@if($casePath == AdminPath::ADMIN)
                                                Home
                                            @else
                                                {{ __('sitebrew::general.' . $casePath->value) }}
                                            @endif</p>
                                    </a>
                                @endforeach

                            </div>
                        </div>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden space-x-6 sm:-my-px sm:ml-4 sm:flex">
                        {{--  :active="request()->routeIs('feed.community')" :href="route('feed.community', 'all')" --}}
                        @foreach($navigationItems as $item)
                            <a href="{{ $item['url'] }}"
                                    @class([
                                        'inline-flex items-center px-1 pt-1 border-b-2 border-primary-500 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-primary-700 transition duration-150 ease-in-out' => $item['url'] == request()->fullUrl(),
                                        'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out' => $item['url'] != request()->fullUrl(),
                                    ])>
                                {{ $item['name'] }}
                            </a>
                        @endforeach
                    </div>
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
                @if($path == Sitebrew\Enums\Admin\AdminPath::ADMIN->value)
                    <p class="my-auto text-neutral-500">v0.0.1</p>
                @endif

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

@livewire('modal-pro')

@livewireScriptConfig

</body>
