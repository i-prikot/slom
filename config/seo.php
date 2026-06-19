<?php

declare(strict_types=1);

return [

    'site_name' => 'СЛОМ24',

    'locale' => 'ru_RU',

    'default_og_image' => 'resources/images/hero-cutting.jpg',

    'twitter_site' => env('SEO_TWITTER_SITE'),

    'sitemap' => [
        [
            'route' => 'home',
            'priority' => '1.0',
            'changefreq' => 'weekly',
        ],
        [
            'route' => 'privacy',
            'priority' => '0.3',
            'changefreq' => 'yearly',
            'view' => 'pages.privacy',
        ],
        [
            'route' => 'terms',
            'priority' => '0.3',
            'changefreq' => 'yearly',
            'view' => 'pages.terms',
        ],
    ],

];
