<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="w-full h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Pages Title' }}</title>

    @vite(['resources/css/app.css'])
    <script type="module" src="{{ ('/vendor/sitebrew/build/assets/stripped.js') }}"></script>
    @googlefonts

</head>
<body class="w-full h-full">
{{$slot}}
</body>
</html>