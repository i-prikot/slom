@props([
    'title' => null,
    'metaTitle' => null,
    'metaDescription' => null,
    'metaRobots' => 'index,follow',
    'canonicalUrl' => null,
    'ogImage' => null,
    'ogType' => 'website',
    'structuredData' => null,
])

@php
    $resolvedTitle = $title ?? config('app.name', 'Slom24');
    $resolvedMetaTitle = $metaTitle ?? $resolvedTitle;
    $resolvedMetaDescription = $metaDescription ?? 'Алмазная резка и бурение бетона в Красноярске — СЛОМ24';
    $resolvedCanonicalUrl = $canonicalUrl ?? url()->current();
    $resolvedOgImage = $ogImage ?? url(Vite::asset(config('seo.default_og_image')));
    $twitterSite = config('seo.twitter_site');
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="{{ $resolvedMetaDescription }}">
        <meta name="robots" content="{{ $metaRobots }}">
        <link rel="canonical" href="{{ $resolvedCanonicalUrl }}">
        <meta property="og:title" content="{{ $resolvedMetaTitle }}">
        <meta property="og:description" content="{{ $resolvedMetaDescription }}">
        <meta property="og:url" content="{{ $resolvedCanonicalUrl }}">
        <meta property="og:type" content="{{ $ogType }}">
        <meta property="og:locale" content="{{ config('seo.locale') }}">
        <meta property="og:site_name" content="{{ config('seo.site_name') }}">
        <meta property="og:image" content="{{ $resolvedOgImage }}">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $resolvedMetaTitle }}">
        <meta name="twitter:description" content="{{ $resolvedMetaDescription }}">
        <meta name="twitter:image" content="{{ $resolvedOgImage }}">
        @if (is_string($twitterSite) && $twitterSite !== '')
            <meta name="twitter:site" content="{{ $twitterSite }}">
        @endif
        <link rel="icon" href="/favicon.ico">
        <link href="/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">
        <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon">
        <link href="/favicon.ico" rel="icon" type="image/x-icon">
        <title>{{ $resolvedTitle }}</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Manrope:wght@600;700;800&display=swap" rel="stylesheet">

        @if (is_array($structuredData) && $structuredData !== [])
            <x-seo.structured-data :graphs="$structuredData" />
        @endif

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="antialiased">
        {{ $slot }}

        <x-toaster-hub class="z-[120]" />
        @livewireScripts
    </body>
</html>
