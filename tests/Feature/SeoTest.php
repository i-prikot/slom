<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class SeoTest extends TestCase
{
    use RefreshDatabase;

    public function test_sitemap_lists_indexable_routes(): void
    {
        $response = $this->get(route('sitemap'));

        $response->assertOk();
        $response->assertHeader('Content-Type', 'application/xml; charset=UTF-8');
        $response->assertSee(route('home'), false);
        $response->assertSee(route('privacy'), false);
        $response->assertSee(route('terms'), false);
        $response->assertSee('<urlset', false);
    }

    public function test_robots_disallows_admin_and_links_sitemap(): void
    {
        $response = $this->get(route('robots'));

        $response->assertOk();
        $response->assertHeader('Content-Type', 'text/plain; charset=UTF-8');
        $response->assertSee('Disallow: /admin', false);
        $response->assertSee('Disallow: /up', false);
        $response->assertSee('Sitemap: '.route('sitemap'), false);
    }

    public function test_home_has_json_ld_schemas(): void
    {
        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertSee('application/ld+json', false);
        $response->assertSee('LocalBusiness', false);
        $response->assertSee('FAQPage', false);
        $response->assertSee('WebSite', false);
        $response->assertSee('OfferCatalog', false);
    }

    public function test_home_has_canonical_and_og_tags(): void
    {
        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertSee('rel="canonical"', false);
        $response->assertSee('property="og:image"', false);
        $response->assertSee('property="og:url"', false);
        $response->assertSee(route('home'), false);
    }

    public function test_not_found_is_noindex(): void
    {
        $this->get('/404-page')
            ->assertNotFound()
            ->assertSee('name="robots" content="noindex"', false);
    }
}
