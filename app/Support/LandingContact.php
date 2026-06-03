<?php

declare(strict_types=1);

namespace App\Support;

final class LandingContact
{
    public const PHONE_DISPLAY = '8 (902) 990-50-05';
    public const PHONE_TEL = '+79029905005';
    public const PHONE_SECONDARY_DISPLAY = '+7 (391) 242-08-08';
    public const PHONE_SECONDARY_TEL = '+73912420808';
    public const PHONE_MOBILE_DISPLAY = '8 (902) 990-50-05';
    public const PHONE_MOBILE_TEL = '+79029905005';
    public const EMAIL = 'slom24@mail.ru';
    public const ADDRESS = 'Красноярск, ул. Дубровинского, 58';
    public const ADDRESS_MAP_URL = 'https://yandex.ru/maps/?text=%D0%9A%D1%80%D0%B0%D1%81%D0%BD%D0%BE%D1%8F%D1%80%D1%81%D0%BA%2C%20%D0%94%D1%83%D0%B1%D1%80%D0%BE%D0%B2%D0%B8%D0%BD%D1%81%D0%BA%D0%BE%D0%B3%D0%BE%2C%2058';
    public const WHATSAPP_URL = 'https://wa.me/+79029905005';
    public const TELEGRAM_URL = 'https://t.me/+79029905005';
    public const MAX_URL = 'https://max.ru/u/+79029905005';
    public const COMPANY = 'СЛОМ24';
    public const CITY = 'Красноярск';
    public const YANDEX_PROFILE_URL = 'https://yandex.ru/profile/228669360093';
    public const YANDEX_RATING = '5.0';
    public const WORK_HOURS_START = 8;
    public const WORK_HOURS_END = 20;
    public const WORK_HOURS_LABEL = 'Ежедневно 8:00 – 20:00';

    private const MESSENGER_TEXTS = [
        'default' => 'Здравствуйте! Подскажите по алмазной резке/бурению — нужен расчёт.',
        'hero' => 'Здравствуйте! Хочу заказать алмазную резку. Подскажите цену и сроки выезда.',
        'pricing' => 'Здравствуйте! Уточните, пожалуйста, точную стоимость по моему объекту.',
        'calculator' => 'Здравствуйте! Рассчитал ориентировочную стоимость на сайте — хочу уточнить детали и сроки выезда.',
        'emergency' => 'Здравствуйте! Срочная ситуация — нужен выезд бригады как можно быстрее.',
        'services' => 'Здравствуйте! Интересует услуга — нужна консультация и расчёт.',
        'footer' => 'Здравствуйте! Оставляю заявку на консультацию по алмазной резке.',
    ];

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
        $currentHour = $hour ?? (int) now()->format('G');

        return $currentHour >= self::WORK_HOURS_START && $currentHour < self::WORK_HOURS_END;
    }
}
