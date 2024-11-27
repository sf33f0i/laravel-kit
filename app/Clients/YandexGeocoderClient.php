<?php

declare(strict_types=1);

namespace App\Clients;

use App\Clients\ApiClients\Client;
use App\Exceptions\ClientException;
use App\Exceptions\NetworkException;
use App\Interfaces\YandexGeocoderClientInterface;

class YandexGeocoderClient implements YandexGeocoderClientInterface
{
    /**
     * YandexGeocoder constructor.
     *
     * @param string $apikey
     * @param string $format
     * @param Client $client
     */
    public function __construct(
        private readonly string $apikey,
        private readonly string $format,
        private readonly Client $client,
    ) {}

    /**
     * @param string $geocode
     * @param array $params
     *
     * @return array
     * @throws ClientException
     * @throws NetworkException
     */
    public function getData(string $geocode, array $params = []): array
    {
        $response = $this->client->sendRequest(
            'GET',
            [
                'apikey' => $this->apikey,
                'format' => $this->format,
                'geocode' => $geocode,
                ...$params,
            ],
        )->getBody()->getContents();

        return json_decode($response, true);
    }

    /**
     * @param string $geocode
     *
     * @return array|null
     * @throws ClientException
     * @throws NetworkException
     */
    public function getAddressPosition(string $geocode): ?array
    {
        $position = null;
        $geoData = $this->getData($geocode, ['results' => 1]);
        $results = $geoData['response']['GeoObjectCollection']['featureMember'];
        if (!empty($results)) {
            $geoObject = $results[0]['GeoObject'];
            $position['address'] = $geoObject['metaDataProperty']['GeocoderMetaData']['Address']['formatted'];
            $position['position'] = $geoObject['Point']['pos'];
        }

        return $position;
    }
}
