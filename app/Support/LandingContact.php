<?php

declare(strict_types=1);

namespace App\Support;

use App\Models\LandingSettings;

final class LandingContact
{
    private const MESSENGER_TEXTS = [
        'default' => 'Здравствуйте! Подскажите по алмазной резке/бурению — нужен расчёт.',
        'hero' => 'Здравствуйте! Хочу заказать алмазную резку. Подскажите цену и сроки выезда.',
        'pricing' => 'Здравствуйте! Уточните, пожалуйста, точную стоимость по моему объекту.',
        'calculator' => 'Здравствуйте! Рассчитал ориентировочную стоимость на сайте — хочу уточнить детали и сроки выезда.',
        'emergency' => 'Здравствуйте! Срочная ситуация — нужен выезд бригады как можно быстрее.',
        'services' => 'Здравствуйте! Интересует услуга — нужна консультация и расчёт.',
        'footer' => 'Здравствуйте! Оставляю заявку на консультацию по алмазной резке.',
    ];

    public static function phoneTel(): string
    {
        return self::settings()->phone_main_tel;
    }

    public static function phoneDisplay(): string
    {
        return self::settings()->phone_main_display;
    }

    public static function phoneOfficeTel(): string
    {
        return self::settings()->phone_office_tel;
    }

    public static function phoneOfficeDisplay(): string
    {
        return self::settings()->phone_office_display;
    }

    public static function phoneMobileTel(): string
    {
        return self::settings()->phone_mobile_tel;
    }

    public static function phoneMobileDisplay(): string
    {
        return self::settings()->phone_mobile_display;
    }

    public static function email(): string
    {
        return self::settings()->email;
    }

    public static function address(): string
    {
        return self::settings()->address;
    }

    public static function addressMapUrl(): string
    {
        $settings = self::settings();

        if (is_string($settings->address_map_url) && $settings->address_map_url !== '') {
            return $settings->address_map_url;
        }

        return 'https://yandex.ru/maps/?text='.rawurlencode($settings->address);
    }

    public static function leadMailTo(): string
    {
        $fromSettings = self::settings()->lead_mail_to;

        if ($fromSettings !== '') {
            return $fromSettings;
        }

        $fromConfig = config('landing.lead_mail_to');

        return is_string($fromConfig) ? $fromConfig : '';
    }

    public static function company(): string
    {
        return self::settings()->company_name;
    }

    public static function city(): string
    {
        return self::settings()->city;
    }

    public static function yandexProfileUrl(): string
    {
        return self::settings()->yandex_profile_url;
    }

    public static function yandexRating(): string
    {
        return self::settings()->yandex_rating;
    }

    public static function workHoursLabel(): string
    {
        return self::settings()->work_hours_label;
    }

    public static function showWhatsApp(): bool
    {
        return self::settings()->show_whatsapp;
    }

    public static function showTelegram(): bool
    {
        return self::settings()->show_telegram;
    }

    public static function showMax(): bool
    {
        return self::settings()->show_max;
    }

    public static function visibleMessengerCount(): int
    {
        return (self::showWhatsApp() ? 1 : 0)
            + (self::showTelegram() ? 1 : 0)
            + (self::showMax() ? 1 : 0);
    }

    public static function visibleCtaCount(): int
    {
        return 1 + self::visibleMessengerCount();
    }

    public static function stickyCtaGridClass(): string
    {
        return match (2 + self::visibleMessengerCount()) {
            2 => 'grid-cols-2',
            3 => 'grid-cols-3',
            4 => 'grid-cols-4',
            5 => 'grid-cols-5',
            default => 'grid-cols-5',
        };
    }

    public static function ctaGridClass(): string
    {
        return match (self::visibleCtaCount()) {
            1 => 'grid-cols-1',
            2 => 'sm:grid-cols-2',
            3 => 'sm:grid-cols-3',
            default => 'grid-cols-1',
        };
    }

    public static function whatsappUrl(): string
    {
        return 'https://wa.me/'.self::normalizePhone(self::settings()->whatsapp_phone);
    }

    public static function telegramUrl(): string
    {
        $contact = trim(self::settings()->telegram_phone);

        if ($contact === '') {
            return 'https://t.me/';
        }

        if (str_starts_with($contact, '@')) {
            return 'https://t.me/'.ltrim($contact, '@');
        }

        if (str_starts_with($contact, 'http://') || str_starts_with($contact, 'https://')) {
            return $contact;
        }

        return 'https://t.me/'.self::normalizePhone($contact);
    }

    public static function maxUrl(): string
    {
        $contact = trim(self::settings()->max_phone);

        if ($contact === '') {
            return 'https://max.ru/u/';
        }

        if (str_starts_with($contact, 'http://') || str_starts_with($contact, 'https://')) {
            return $contact;
        }

        return 'https://max.ru/u/'.self::normalizePhone($contact);
    }

    public static function messengerUrl(string $baseUrl, string $source = 'default'): string
    {
        $text = self::MESSENGER_TEXTS[$source] ?? self::MESSENGER_TEXTS['default'];

        return $baseUrl.'?text='.rawurlencode($text);
    }

    public static function messengerUrlWithCalc(string $baseUrl, string $summary): string
    {
        return $baseUrl.'?text='.rawurlencode("Здравствуйте! Рассчитал на сайте:\n{$summary}\nПодскажите, когда сможете приехать?");
    }

    public static function isOpenNow(?int $hour = null): bool
    {
        $settings = self::settings();
        $currentHour = $hour ?? (int) now()->format('G');

        return $currentHour >= $settings->work_hours_start && $currentHour < $settings->work_hours_end;
    }

    private static function settings(): LandingSettings
    {
        return LandingSettings::instance();
    }

    private static function normalizePhone(string $phone): string
    {
        $normalized = preg_replace('/[^\d+]/', '', $phone);

        return is_string($normalized) && $normalized !== '' ? $normalized : $phone;
    }
}
