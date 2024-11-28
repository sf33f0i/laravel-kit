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

class YandexGeocoderClient implements YandexGeocoderClientInterface
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
        private readonly string $apikey,
        private readonly string $format,
        private readonly string $url,
        private readonly Client $client,
        private readonly LoggerInterface $logger,
    ) {}

    /**
     * @param string $geocode
     * @param array $params
     *
     * @return array
     * @throws ClientException
     * @throws NetworkException
     */
    public function sendRequest(string $geocode, array $params = []): array
    {
        try {
            $response = $this->client->request(
                'GET',
                $this->url,
                [
                    'form_params' => $params,
                    'query' => [
                        'apikey' => $this->apikey,
                        'format' => $this->format,
                        'geocode' => $geocode,
                    ],
                ],
            )->getBody()->getContents();

            return json_decode($response, true);
        } catch (ConnectException $exception) {
            $this->logger->error($exception);
            throw new NetworkException($exception->getRequest(), 'Нет соединения с ' . $this->url, $exception);
        } catch (GuzzleException $exception) {
            $this->logger->error($exception);
            throw new ClientException(
                'Что то пошло не так при отправке запроса: ' . $this->url,
                0,
                $exception
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
        if (!empty($results)) {
            $geoObject = $results[0]['GeoObject'];
            $position['address'] = $geoObject['metaDataProperty']['GeocoderMetaData']['Address']['formatted'];
            $position['position'] = $geoObject['Point']['pos'];
        }

        return $position;
    }
}
