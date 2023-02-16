<?php

namespace App\Providers;

use App\Models\User;
use App\MoonShine\Resources\UserResource;
use Illuminate\Support\ServiceProvider;
use Leeto\MoonShine\MoonShine;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::preventLazyLoading(!app()->isProduction());
        
        app(MoonShine::class)->registerResources([
            UserResource::class
        ]);
    }
}
