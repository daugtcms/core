<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="w-full h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ (!empty($title) ? $title . ' - ' : '') . config('app.name')  }}</title>

    {{ Vite::useHotFile('vendor/daugt/daugt.hot')
        ->useBuildDirectory("vendor/daugt")
        ->withEntryPoints(['resources/js/stripped.js', 'resources/css/stripped.css']) }}

    <script>
        window.addEventListener('DOMContentLoaded', () => {
            window.initializeUnoCSS(
                @json(config('daugt.style'))
            );
        });
    </script>

</head>
<body class="w-full h-full font-main" un-cloak>
{{$slot}}
</body>
</html>