<?php

namespace App\Providers;

use App\Clients\YandexGeocoderClient;
use App\Interfaces\YandexGeocoderClientInterface;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use Psr\Log\NullLogger;

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
            $logger = new NullLogger();

            return new YandexGeocoderClient($config['apikey'], $config['format'], $config['url'], $client, $logger);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void {}
}
