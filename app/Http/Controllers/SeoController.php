<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\View;

final class SeoController extends Controller
{
    public function sitemap(): Response
    {
        $urls = [];

        foreach (config('seo.sitemap', []) as $entry) {
            $lastmod = now()->toAtomString();

            if (isset($entry['view']) && View::exists($entry['view'])) {
                $path = View::getFinder()->find($entry['view']);
                $mtime = filemtime($path);

                if ($mtime !== false) {
                    $lastmod = date(DATE_ATOM, $mtime);
                }
            }

            $urls[] = [
                'loc' => route($entry['route']),
                'lastmod' => $lastmod,
                'changefreq' => $entry['changefreq'],
                'priority' => $entry['priority'],
            ];
        }

        $xml = view('seo.sitemap', ['urls' => $urls])->render();

        return response($xml, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
    }

    public function robots(): Response
    {
        $sitemapUrl = route('sitemap');

        $content = implode("\n", [
            'User-agent: *',
            'Disallow: /admin',
            'Disallow: /up',
            '',
            "Sitemap: {$sitemapUrl}",
        ]);

        return response($content, 200, ['Content-Type' => 'text/plain; charset=UTF-8']);
    }
}
