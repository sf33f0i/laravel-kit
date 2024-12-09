<?php

declare(strict_types=1);

namespace App\Clients;

use GuzzleHttp\Client;
use App\Interfaces\YandexGeocoderClientInterface;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ServerException;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use JsonException;

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
        private ClientInterface $client,
        private LoggerInterface $logger = new NullLogger(),
    ) {}

    /**
     * @param string $geocode
     * @param array $params
     * @param string $method
     *
     * @return array
     * @throws JsonException|GuzzleException
     */
    private function sendRequest(string $geocode, array $params = [], string $method = 'GET'): array
    {
        $options = [
            'form_params' => $params,
            'query' => [
                'apikey' => $this->apikey,
                'format' => $this->format,
                'geocode' => $geocode,
            ],
        ];
        $this->logger->info('Request: ' . json_encode($options, JSON_THROW_ON_ERROR));
        try {
            $response = $this->client->request($method, $this->url, $options)->getBody()->getContents();
            $this->logger->info('Response: ' . $response);
        } catch (ClientException|ServerException $exception) {
            $response = $exception->getResponse()->getBody()->getContents();
            $this->logger->error($exception->getMessage() . PHP_EOL . 'Response: ' . $response);
        }

        return (array)json_decode($response, true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    public function getGeoData(string $geocode, array $params = []): array
    {
        return $this->sendRequest($geocode, $params);
    }
}
