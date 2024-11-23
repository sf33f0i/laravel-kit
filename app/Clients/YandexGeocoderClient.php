<?php

declare(strict_types=1);

namespace App\Clients;

use App\Clients\ApiClients\Client;
use App\Exceptions\ClientException;
use App\Exceptions\NetworkException;
use App\Interfaces\ApiClientInterface;

class YandexGeocoderClient
{
    private readonly ApiClientInterface $client;

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
    ) {
        $this->client = new Client($this->url);
    }

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
        return json_decode(
            $this->client->sendRequest(
                'GET',
                ['apikey' => $this->apikey, 'format' => $this->format, 'geocode' => $geocode, ...$params],
            )->getBody()->getContents(),
            true,
        );
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
        if (count($results) > 0) {
            $geoObject = $results[0]['GeoObject'];
            $position['address'] = $geoObject['metaDataProperty']['GeocoderMetaData']['Address']['formatted'];
            $position['position'] = $geoObject['Point']['pos'];
        }

        return $position;
    }
}
