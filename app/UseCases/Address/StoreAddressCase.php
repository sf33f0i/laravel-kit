<?php

declare(strict_types=1);

namespace App\UseCases\Address;

use App\Clients\YandexGeocoderClient;
use App\Exceptions\NotFoundAddressException;
use App\Interfaces\YandexGeocoderClientInterface;
use App\Models\Address;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;

readonly class StoreAddressCase
{
    /**
     * @param YandexGeocoderClient $client
     */
    public function __construct(
        private YandexGeocoderClientInterface $client,
    ) {}

    /**
     * @param string $address
     *
     * @throws NotFoundAddressException
     * @throws GuzzleException
     * @throws JsonException
     */
    public function handle(string $address): void
    {
        $addressPosition = $this->getAddressPosition($address);
        if ($addressPosition === null) {
            throw new NotFoundAddressException();
        }

        Address::query()->create([
            'address' => $addressPosition['address'],
            'position' => "POINT($addressPosition[position])",
        ]);
    }

    /**
     * @param string $address
     *
     * @return array|null
     * @throws GuzzleException
     * @throws JsonException
     */
    private function getAddressPosition(string $address): ?array
    {
        $position = null;
        $response = $this->client->sendRequest($address, ['results' => 1]);

        if(!array_key_exists('response', $response)) {
            return null;
        }

        $results = $response['response']['GeoObjectCollection']['featureMember'];
        if ($results) {
            $geoObject = $results[0]['GeoObject'];
            $position['address'] = $geoObject['metaDataProperty']['GeocoderMetaData']['Address']['formatted'];
            $position['position'] = $geoObject['Point']['pos'];
        }

        return $position;
    }
}
