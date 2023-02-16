<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Leeto\MoonShine\MoonShine;
use Leeto\MoonShine\Menu\MenuGroup;
use Leeto\MoonShine\Menu\MenuItem;
use Leeto\MoonShine\Resources\MoonShineUserResource;
use Leeto\MoonShine\Resources\MoonShineUserRoleResource;

class MoonShineServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        app(MoonShine::class)->registerResources([
            MenuGroup::make(__('moonshine::ui.resource.system'), [
                MenuItem::make(__('moonshine::ui.resource.admins_title'), new MoonShineUserResource())
                    ->icon('users'),
                MenuItem::make(__('moonshine::ui.resource.role_title'), new MoonShineUserRoleResource())
                    ->icon('bookmark'),
            ]),

            MenuItem::make('Documentation', 'https://laravel.com')
                ->badge(fn() => 'Check'),
        ]);
    }
}
