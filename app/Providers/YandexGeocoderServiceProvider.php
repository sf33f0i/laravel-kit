<?php

namespace App\Providers;

use App\Clients\YandexGeocoderClient;
use App\Interfaces\YandexGeocoderClientInterface;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class YandexGeocoderServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(YandexGeocoderClientInterface::class, static function (): YandexGeocoderClient {
            $config = config('services.yandexGeocoder');
            $client = new Client();

            return new YandexGeocoderClient($config['apikey'], $config['format'], $config['url'], $client);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void {}
}
