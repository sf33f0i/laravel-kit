<?php

declare(strict_types=1);

namespace App\Clients;

use App\Clients\ApiClients\Client;
use App\Exceptions\ClientException;
use App\Exceptions\NetworkException;
use App\Exceptions\RequestException;
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
     * @throws NetworkException
     * @throws RequestException
     * @throws ClientException
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
     * @throws RequestException
     * @throws NetworkException
     * @throws ClientException
     */
    public function getPos(string $geocode): string
    {
        $geoData = $this->getData($geocode, ['results' => 1]);

        return $geoData['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['Point']['pos'];
    }
}
