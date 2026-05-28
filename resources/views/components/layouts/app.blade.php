<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="{{ $metaDescription ?? 'Алмазная резка и бурение бетона в Красноярске — СЛОМ24' }}">
        <meta name="robots" content="{{ $metaRobots ?? 'index,follow' }}">
        <meta property="og:title" content="{{ $metaTitle ?? ($title ?? 'СЛОМ24') }}">
        <meta property="og:description" content="{{ $metaDescription ?? 'Алмазная резка и бурение бетона в Красноярске' }}">
        <link rel="icon" href="/favicon.ico">
        <link href="/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">
        <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon">
        <link href="/favicon.ico" rel="icon" type="image/x-icon">
        <title>{{ $title ?? config('app.name', 'Slom24') }}</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Manrope:wght@600;700;800&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="antialiased">
        {{ $slot }}

        <x-toaster-hub class="z-[120]" />
        @livewireScripts
    </body>
</html>
