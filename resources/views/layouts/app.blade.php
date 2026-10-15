<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Odyssey') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="od-body">
    @include('layouts.navigation')

    @isset($header)
        <header class="od-pagehead">
            <div class="od-wrap">{{ $header }}</div>
        </header>
    @endisset

    <main>{{ $slot }}</main>
</body>
</html>