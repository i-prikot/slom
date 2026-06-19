<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\LandingSettings\Pages;

use App\Models\LandingSettings;
use App\MoonShine\Resources\LandingSettings\LandingSettingsResource;
use Illuminate\Http\Exceptions\HttpResponseException;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\Pages\Crud\IndexPage;
use MoonShine\UI\Fields\Text;

/**
 * @extends IndexPage<LandingSettingsResource>
 */
final class LandingSettingsIndexPage extends IndexPage
{
    public function getTitle(): string
    {
        return 'Настройки сайта';
    }

    protected function prepareBeforeRender(): void
    {
        throw new HttpResponseException(
            redirect($this->getResource()->getFormPageUrl(LandingSettings::instance()->getKey()))
        );
    }

    /**
     * @return list<FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            Text::make('Компания', 'company_name'),
        ];
    }
}
