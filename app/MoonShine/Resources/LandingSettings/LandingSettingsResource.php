<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\LandingSettings;

use App\Models\LandingSettings;
use App\MoonShine\Resources\LandingSettings\Pages\LandingSettingsFormPage;
use App\MoonShine\Resources\LandingSettings\Pages\LandingSettingsIndexPage;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\MenuManager\Attributes\Order;
use MoonShine\Support\Attributes\Icon;
use MoonShine\Support\Enums\Action;
use MoonShine\Support\ListOf;

/**
 * @extends ModelResource<LandingSettings, LandingSettingsIndexPage, LandingSettingsFormPage, null>
 */
#[Icon('cog')]
#[Order(10)]
final class LandingSettingsResource extends ModelResource
{
    protected string $model = LandingSettings::class;

    protected string $column = 'company_name';

    public function getTitle(): string
    {
        return 'Настройки сайта';
    }

    public function getUrl(): string
    {
        return $this->getFormPageUrl(LandingSettings::instance()->getKey());
    }

    protected function pages(): array
    {
        return [
            LandingSettingsIndexPage::class,
            LandingSettingsFormPage::class,
        ];
    }

    public function getRedirectAfterDelete(): string
    {
        return $this->getFormPageUrl(LandingSettings::instance()->getKey());
    }

    protected function activeActions(): ListOf
    {
        return parent::activeActions()
            ->except(Action::CREATE, Action::VIEW, Action::DELETE, Action::MASS_DELETE);
    }

    protected function search(): array
    {
        return [];
    }
}
