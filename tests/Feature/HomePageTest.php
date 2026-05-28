<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

final class HomePageTest extends TestCase
{
    public function test_home_page_returns_ok(): void
    {
        $this->get(route('home'))
            ->assertOk();
    }

    public function test_home_page_contains_critical_sections_and_ctas(): void
    {
        $this->get(route('home'))
            ->assertSee('Алмазная резка и бурение бетона', false)
            ->assertSee('id="pricing"', false)
            ->assertSee('id="service-area"', false)
            ->assertSee('Позвонить', false)
            ->assertSee('WhatsApp', false)
            ->assertSee('Telegram', false);
    }
}
