<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\LandingSettings\Pages;

use App\MoonShine\Resources\LandingSettings\LandingSettingsResource;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Tabs;
use MoonShine\UI\Components\Tabs\Tab;
use MoonShine\UI\Fields\Email;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Url;

/**
 * @extends FormPage<LandingSettingsResource, LandingSettings>
 */
final class LandingSettingsFormPage extends FormPage
{
    public function getTitle(): string
    {
        return 'Настройки сайта';
    }

    /**
     * @return array<string, string>
     */
    public function getBreadcrumbs(): array
    {
        return [
            '#' => $this->getTitle(),
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            Box::make([
                Tabs::make([
                    Tab::make('Контакты', [
                        ID::make(),

                        Text::make('Основной телефон (tel)', 'phone_main_tel')
                            ->required()
                            ->hint('Формат: +79029905005'),

                        Text::make('Основной телефон (отображение)', 'phone_main_display')
                            ->required(),

                        Text::make('Офис — tel', 'phone_office_tel')
                            ->required(),

                        Text::make('Офис — отображение', 'phone_office_display')
                            ->required(),

                        Text::make('Мобильный — tel', 'phone_mobile_tel')
                            ->required(),

                        Text::make('Мобильный — отображение', 'phone_mobile_display')
                            ->required(),

                        Email::make('Email', 'email')
                            ->required(),

                        Text::make('Адрес', 'address')
                            ->required(),

                        Url::make('Ссылка на карту', 'address_map_url')
                            ->hint('Оставьте пустым — ссылка сгенерируется из адреса'),

                        Email::make('Email для заявок', 'lead_mail_to')
                            ->required(),
                    ])->icon('phone'),

                    Tab::make('Мессенджеры', [
                        Switcher::make('Показывать WhatsApp', 'show_whatsapp'),

                        Text::make('WhatsApp — номер', 'whatsapp_phone')
                            ->required()
                            ->hint('Формат: +79029905005'),

                        Switcher::make('Показывать Telegram', 'show_telegram'),

                        Text::make('Telegram — номер или @username', 'telegram_phone')
                            ->required(),

                        Switcher::make('Показывать Max', 'show_max'),

                        Text::make('Max — номер или ссылка', 'max_phone')
                            ->required(),
                    ])->icon('chat-bubble-left-right'),

                    Tab::make('Компания', [
                        Text::make('Название компании', 'company_name')
                            ->required(),

                        Text::make('Город', 'city')
                            ->required(),

                        Number::make('Начало работы (час)', 'work_hours_start')
                            ->min(0)
                            ->max(23)
                            ->required(),

                        Number::make('Конец работы (час)', 'work_hours_end')
                            ->min(1)
                            ->max(24)
                            ->required(),

                        Text::make('Режим работы (текст)', 'work_hours_label')
                            ->required(),

                        Url::make('Профиль Яндекс.Карт', 'yandex_profile_url')
                            ->required(),

                        Text::make('Рейтинг Яндекс.Карт', 'yandex_rating')
                            ->required(),
                    ])->icon('building-office'),
                ]),
            ]),
        ];
    }

    /**
     * @return array<string, list<string>>
     */
    protected function rules(DataWrapperContract $item): array
    {
        return [
            'phone_main_tel' => ['required', 'string', 'max:32'],
            'phone_main_display' => ['required', 'string', 'max:64'],
            'phone_office_tel' => ['required', 'string', 'max:32'],
            'phone_office_display' => ['required', 'string', 'max:64'],
            'phone_mobile_tel' => ['required', 'string', 'max:32'],
            'phone_mobile_display' => ['required', 'string', 'max:64'],
            'email' => ['required', 'email', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'address_map_url' => ['nullable', 'url', 'max:2048'],
            'lead_mail_to' => ['required', 'email', 'max:255'],
            'show_whatsapp' => ['boolean'],
            'show_telegram' => ['boolean'],
            'show_max' => ['boolean'],
            'whatsapp_phone' => ['required', 'string', 'max:32'],
            'telegram_phone' => ['required', 'string', 'max:64'],
            'max_phone' => ['required', 'string', 'max:128'],
            'company_name' => ['required', 'string', 'max:128'],
            'city' => ['required', 'string', 'max:128'],
            'work_hours_start' => ['required', 'integer', 'min:0', 'max:23'],
            'work_hours_end' => ['required', 'integer', 'min:1', 'max:24'],
            'work_hours_label' => ['required', 'string', 'max:128'],
            'yandex_profile_url' => ['required', 'url', 'max:2048'],
            'yandex_rating' => ['required', 'string', 'max:8'],
        ];
    }
}
