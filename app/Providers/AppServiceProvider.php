<?php

declare(strict_types=1);

namespace App\Providers;

use App\View\Components\WidgetAdminMenu;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void {}

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void {

        if (env('FORCE_HTTPS', false)) {
            URL::forceScheme('https');
        }

        Blade::component('admin-menu', WidgetAdminMenu::class);

    }
}
