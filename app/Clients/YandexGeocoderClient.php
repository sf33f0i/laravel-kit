<?php

declare(strict_types=1);

namespace App\Clients;

use GuzzleHttp\Client;
use App\Exceptions\ClientException;
use App\Exceptions\NetworkException;
use App\Interfaces\YandexGeocoderClientInterface;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

readonly class YandexGeocoderClient implements YandexGeocoderClientInterface
{
    /**
     * YandexGeocoder constructor.
     *
     * @param string $apikey
     * @param string $format
     * @param string $url
     * @param Client $client
     * @param LoggerInterface $logger
     */
    public function __construct(
        private string $apikey,
        private string $format,
        private string $url,
        private Client $client,
        private LoggerInterface $logger = new NullLogger(),
    ) {}

    /**
     * @param string $geocode
     * @param array $params
     * @param string $method
     *
     * @return array
     * @throws ClientException
     * @throws NetworkException
     */
    public function sendRequest(string $geocode, array $params = [], string $method = 'GET'): array
    {
        $options = [
            'form_params' => $params,
            'query' => [
                'apikey' => $this->apikey,
                'format' => $this->format,
                'geocode' => $geocode,
            ],
        ];
        try {
            $response = $this->client->request($method, $this->url, $options)->getBody()->getContents();

            return json_decode($response, true);
        } catch (ConnectException $exception) {
            $this->logger->error($exception);
            throw new NetworkException($exception->getRequest(), 'Нет соединения с ' . $this->url, $exception);
        } catch (GuzzleException $exception) {
            $this->logger->error($exception);
            throw new ClientException(
                'Что то пошло не так при отправке запроса: ' . $this->url,
                0,
                $exception,
            );
        }
    }

    /**
     * @param string $address
     *
     * @return array|null
     * @throws ClientException
     * @throws NetworkException
     */
    public function getAddressPosition(string $address): ?array
    {
        $position = null;
        $response = $this->sendRequest($address, ['results' => 1]);
        $results = $response['response']['GeoObjectCollection']['featureMember'];
        if ($results !== []) {
            $geoObject = $results[0]['GeoObject'];
            $position['address'] = $geoObject['metaDataProperty']['GeocoderMetaData']['Address']['formatted'];
            $position['position'] = $geoObject['Point']['pos'];
        }

        return $position;
    }
}
