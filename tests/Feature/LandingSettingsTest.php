<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\LandingSettings;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class LandingSettingsTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_shows_default_contact_and_messenger_links(): void
    {
        $this->get(route('home'))
            ->assertOk()
            ->assertSee('wa.me/+79029905005', false)
            ->assertSee('t.me/+79029905005', false)
            ->assertSee('slom24@mail.ru', false)
            ->assertSee('Дубровинского, 58', false)
            ->assertSee('8 (902) 990-50-05', false);
    }

    public function test_hiding_whatsapp_removes_wa_me_link_from_home_page(): void
    {
        $settings = LandingSettings::instance();
        $settings->update(['show_whatsapp' => false]);
        LandingSettings::flushCache();

        $this->get(route('home'))
            ->assertOk()
            ->assertDontSee('wa.me/', false)
            ->assertSee('t.me/', false);
    }

    public function test_changing_whatsapp_phone_updates_link_on_home_page(): void
    {
        $settings = LandingSettings::instance();
        $settings->update(['whatsapp_phone' => '+79991112233']);
        LandingSettings::flushCache();

        $this->get(route('home'))
            ->assertOk()
            ->assertSee('wa.me/+79991112233', false);
    }

    public function test_changing_email_and_address_updates_footer(): void
    {
        $settings = LandingSettings::instance();
        $settings->update([
            'email' => 'new@example.com',
            'address' => 'Новый адрес, 1',
        ]);
        LandingSettings::flushCache();

        $this->get(route('home'))
            ->assertOk()
            ->assertSee('new@example.com', false)
            ->assertSee('Новый адрес, 1', false);
    }

    public function test_hiding_all_messengers_keeps_phone_cta(): void
    {
        $settings = LandingSettings::instance();
        $settings->update([
            'show_whatsapp' => false,
            'show_telegram' => false,
            'show_max' => false,
        ]);
        LandingSettings::flushCache();

        $this->get(route('home'))
            ->assertOk()
            ->assertDontSee('wa.me/', false)
            ->assertDontSee('t.me/', false)
            ->assertSee('Позвонить', false);
    }
}
