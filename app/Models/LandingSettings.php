<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

/**
 * @property int $id
 * @property string $phone_main_tel
 * @property string $phone_main_display
 * @property string $phone_office_tel
 * @property string $phone_office_display
 * @property string $phone_mobile_tel
 * @property string $phone_mobile_display
 * @property string $email
 * @property string $address
 * @property string|null $address_map_url
 * @property string $lead_mail_to
 * @property bool $show_whatsapp
 * @property bool $show_telegram
 * @property bool $show_max
 * @property string $whatsapp_phone
 * @property string $telegram_phone
 * @property string $max_phone
 * @property string $company_name
 * @property string $city
 * @property int $work_hours_start
 * @property int $work_hours_end
 * @property string $work_hours_label
 * @property string $yandex_profile_url
 * @property string $yandex_rating
 */
final class LandingSettings extends Model
{
    private const CACHE_KEY = 'landing_settings';

    protected $fillable = [
        'phone_main_tel',
        'phone_main_display',
        'phone_office_tel',
        'phone_office_display',
        'phone_mobile_tel',
        'phone_mobile_display',
        'email',
        'address',
        'address_map_url',
        'lead_mail_to',
        'show_whatsapp',
        'show_telegram',
        'show_max',
        'whatsapp_phone',
        'telegram_phone',
        'max_phone',
        'company_name',
        'city',
        'work_hours_start',
        'work_hours_end',
        'work_hours_label',
        'yandex_profile_url',
        'yandex_rating',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'show_whatsapp' => 'boolean',
            'show_telegram' => 'boolean',
            'show_max' => 'boolean',
            'work_hours_start' => 'integer',
            'work_hours_end' => 'integer',
        ];
    }

    public static function instance(): self
    {
        $id = Cache::rememberForever(self::CACHE_KEY, static function (): int {
            $existing = self::query()->first();

            if ($existing !== null) {
                return $existing->id;
            }

            return self::query()->create(self::defaults())->id;
        });

        return self::query()->findOrFail($id);
    }

    public static function flushCache(): void
    {
        Cache::forget(self::CACHE_KEY);
    }

    protected static function booted(): void
    {
        self::saved(static function (): void {
            self::flushCache();
        });
    }

    /**
     * @return array<string, mixed>
     */
    public static function defaults(): array
    {
        return [
            'phone_main_tel' => '+79029905005',
            'phone_main_display' => '8 (902) 990-50-05',
            'phone_office_tel' => '+73912420808',
            'phone_office_display' => '+7 (391) 242-08-08',
            'phone_mobile_tel' => '+79029905005',
            'phone_mobile_display' => '8 (902) 990-50-05',
            'email' => 'slom24@mail.ru',
            'address' => 'Красноярск, ул. Дубровинского, 58',
            'address_map_url' => 'https://yandex.ru/maps/?text=%D0%9A%D1%80%D0%B0%D1%81%D0%BD%D0%BE%D1%8F%D1%80%D1%81%D0%BA%2C%20%D0%94%D1%83%D0%B1%D1%80%D0%BE%D0%B2%D0%B8%D0%BD%D1%81%D0%BA%D0%BE%D0%B3%D0%BE%2C%2058',
            'lead_mail_to' => config('landing.lead_mail_to') ?: 'slom24@mail.ru',
            'show_whatsapp' => true,
            'show_telegram' => true,
            'show_max' => true,
            'whatsapp_phone' => '+79029905005',
            'telegram_phone' => '+79029905005',
            'max_phone' => '+79029905005',
            'company_name' => 'СЛОМ24',
            'city' => 'Красноярск',
            'work_hours_start' => 8,
            'work_hours_end' => 20,
            'work_hours_label' => 'Ежедневно 8:00 – 20:00',
            'yandex_profile_url' => 'https://yandex.ru/profile/228669360093',
            'yandex_rating' => '5.0',
        ];
    }
}
