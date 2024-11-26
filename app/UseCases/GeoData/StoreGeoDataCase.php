<?php

declare(strict_types=1);

namespace App\UseCases\GeoData;

use App\Clients\YandexGeocoderClient;
use App\Exceptions\ClientException;
use App\Exceptions\NetworkException;
use App\Exceptions\NotFoundAddressException;
use App\Models\GeoData;

class StoreGeoDataCase
{
    /**
     * @param YandexGeocoderClient $client
     */
    public function __construct(
        private readonly YandexGeocoderClient $client,
    ) {}

    /**
     * @param array|null $params
     *
     * @throws ClientException
     * @throws NetworkException
     * @throws NotFoundAddressException
     */
    public function handle(array $params): void
    {
        $addressPosition = $this->client->getAddressPosition($params['address']);
        if ($addressPosition === null) {
            throw new NotFoundAddressException('Координаты данного адреса не найдены!');
        }

        GeoData::query()->create([
            'address' => $addressPosition['address'],
            'position' => "POINT($addressPosition[position])",
        ]);
    }
}
