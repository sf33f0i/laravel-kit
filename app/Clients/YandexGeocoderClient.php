<?php

declare(strict_types=1);

namespace App\Clients;

use Throwable;

class YandexGeocoderClient
{
    /**
     * YandexGeocoder constructor.
     *
     * @param string $url
     * @param string $apikey
     * @param string $format
     */
    public function __construct(
        public string $url,
        public string $apikey,
        public string $format,
    ) {}

    public function get(string $geocode): string
    {
        try {
            return file_get_contents($this->buildUrl($geocode));
        } catch (Throwable $exception) {
            return $exception->getMessage();
        }
    }

    public function buildUrl(string $geocode): string
    {
        return $this->url . http_build_query([
                'apikey' => $this->apikey,
                'format' => $this->format,
                'geocode' => $geocode,
            ]);
    }
}
