<?php

declare(strict_types=1);

namespace App\MoonShine\Layouts;

use App\MoonShine\Resources\LandingSettings\LandingSettingsResource;
use App\MoonShine\Resources\MoonShineUser\MoonShineUserResource;
use App\MoonShine\Resources\MoonShineUserRole\MoonShineUserRoleResource;
use MoonShine\ColorManager\ColorManager;
use MoonShine\ColorManager\Palettes\PurplePalette;
use MoonShine\Contracts\ColorManager\ColorManagerContract;
use MoonShine\Contracts\ColorManager\PaletteContract;
use MoonShine\Contracts\MenuManager\MenuElementContract;
use MoonShine\Laravel\Layouts\AppLayout;
use MoonShine\MenuManager\MenuGroup;
use MoonShine\MenuManager\MenuItem;

final class MoonShineLayout extends AppLayout
{
    /**
     * @var null|class-string<PaletteContract>
     */
    protected ?string $palette = PurplePalette::class;

    protected function assets(): array
    {
        return [
            ...parent::assets(),
        ];
    }

    /**
     * @return list<MenuElementContract>
     */
    protected function menu(): array
    {
        return [
            MenuItem::make(LandingSettingsResource::class),
            MenuGroup::make(static fn () => __('moonshine::ui.resource.system'), [
                MenuItem::make(MoonShineUserResource::class),
                MenuItem::make(MoonShineUserRoleResource::class),
            ]),
        ];
    }

    /**
     * @param  ColorManager  $colorManager
     */
    protected function colors(ColorManagerContract $colorManager): void
    {
        parent::colors($colorManager);

        // $colorManager->primary('#00000');
    }
}
