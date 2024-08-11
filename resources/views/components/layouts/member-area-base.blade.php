<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="w-full h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Pages Title' }}</title>

    @vite(['resources/css/app.css'])

    {{ Vite::useHotFile('vendor/daugt/daugt.hot')
        ->useBuildDirectory("vendor/daugt")
        ->withEntryPoints(['resources/js/member-area.js', 'resources/css/stripped.css', 'resources/css/member-area.css']) }}

    @googlefonts

</head>
<body class="w-full h-full">
{{$slot}}

@livewire('modal-pro')

@livewireScriptConfig
</body>
</html>