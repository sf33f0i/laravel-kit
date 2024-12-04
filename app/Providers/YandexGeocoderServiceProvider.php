<?php

namespace App\Providers;

use App\Clients\YandexGeocoderClient;
use App\Interfaces\YandexGeocoderClientInterface;
use GuzzleHttp\Client;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class YandexGeocoderServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(YandexGeocoderClientInterface::class, static function (Application $app): YandexGeocoderClient {
            $config = config('services.yandexGeocoder');
            $client = new Client();
            $logger = $app->make('log')->channel('yandex-geocoder');

            return new YandexGeocoderClient($config['apikey'], $config['format'], $config['url'], $client, $logger);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void {}
}
