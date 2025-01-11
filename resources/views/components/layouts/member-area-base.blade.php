<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="w-full h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ (!empty($title) ? $title . ' - ' : '') . config('app.name') }}</title>

    <link rel="icon" href="{{config('daugt.favicons.default')}}" type="image/png">
    <link rel="apple-touch-icon" href="{{config('daugt.favicons.default')}}">

    {{ Vite::useHotFile('vendor/daugt/daugt.hot')
        ->useBuildDirectory("vendor/daugt")
        ->withEntryPoints(['resources/js/member-area.js', 'resources/css/stripped.css']) }}

    <script>
        window.addEventListener('DOMContentLoaded', () => {
            window.initializeUnoCSS(
                    @json(config('daugt.style'))
            );
        });
    </script>

</head>
<body class="w-full h-full font-main" un-cloak x-data="{previewUrl: ''}">
{{$slot}}
<div class="fixed top-0 left-0 z-20 flex items-center justify-center w-full h-full p-4 bg-black sm:p-8 bg-opacity-60 overscroll-none"
     x-show="previewUrl" x-cloak>
    <img :src="previewUrl" class="max-w-full max-h-full rounded-md" @click.away="previewUrl = ''">
</div>
@livewire('wire-elements-modal')
@livewireScriptConfig
</body>
</html>