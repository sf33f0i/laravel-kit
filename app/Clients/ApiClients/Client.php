<?php

declare(strict_types=1);

namespace App\Clients\ApiClients;

use App\Exceptions\ClientException;
use App\Exceptions\NetworkException;
use App\Interfaces\ApiClientInterface;
use App\Loggers\NullLogger;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Client as GuzzleClient;
use Psr\Log\LoggerInterface;

class Client implements ApiClientInterface
{
    /**
     * @param string $url
     * @param ClientInterface $client
     * @param LoggerInterface $logger
     */
    public function __construct(
        private readonly string $url,
        private readonly ClientInterface $client = new GuzzleClient(),
        private readonly LoggerInterface $logger = new NullLogger(),
    ) {}

    /**
     * @param string $method
     * @param array $query
     * @param array $params
     *
     * @return ResponseInterface
     * @throws NetworkException
     * @throws ClientException
     */
    public function sendRequest(string $method, array $query = [], array $params = []): ResponseInterface
    {
        try {
            return $this->client->request(
                $method,
                $this->getUrl(),
                [
                    'form_params' => $params,
                    'query' => $query,
                ],
            );
        } catch (ConnectException $exception) {
            $this->logger->error($exception);
            throw new NetworkException($exception->getRequest(), 'Нет соединения с ' . $this->getUrl(), $exception);
        } catch (GuzzleException $exception) {
            $this->logger->error($exception);
            throw new ClientException(
                'Что то пошло не так при отправке запроса: ' . $this->getUrl(),
                0,
                $exception
            );
        }
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }
}
