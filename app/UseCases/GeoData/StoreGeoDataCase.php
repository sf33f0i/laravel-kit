<?php

declare(strict_types=1);

namespace App\UseCases\GeoData;

use App\Clients\YandexGeocoderClient;
use App\Exceptions\ClientException;
use App\Exceptions\NetworkException;
use App\Exceptions\SaveModelException;
use App\Models\GeoData;

class StoreGeoDataCase
{
    /**
     * @param array|null $params
     * @param YandexGeocoderClient $geocoder
     *
     * @throws ClientException
     * @throws NetworkException
     * @throws SaveModelException
     */
    public function handle(?array $params, YandexGeocoderClient $geocoder): void
    {
        $addressPosition = $geocoder->getAddressPosition($params['address']);
        if ($addressPosition === null) {
            throw new SaveModelException('Координаты данного адреса не найдены!');
        }
        [$longitude, $latitude] = explode(' ', $addressPosition['position']);

        GeoData::query()->create([
            'address' => $addressPosition['address'],
            'latitude' => $latitude,
            'longitude' => $longitude,
        ]);
    }
}
