<?php

namespace App\Providers;

use App\Clients\ApiClients\Client;
use App\Clients\YandexGeocoderClient;
use Illuminate\Support\ServiceProvider;

class YandexGeocoderServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(YandexGeocoderClient::class, static function (): YandexGeocoderClient {
            $config = config('services.yandexGeocoder');
            $config['client'] = new Client($config['url']);
            unset($config['url']);

            return new YandexGeocoderClient(...$config);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void {}
}
