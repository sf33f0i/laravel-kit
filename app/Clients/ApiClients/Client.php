<?php

declare(strict_types=1);

namespace App\Clients\ApiClients;

use App\Exceptions\ClientException;
use App\Exceptions\NetworkException;
use App\Exceptions\RequestException;
use App\Interfaces\ApiClientInterface;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Client as GuzzleClient;

class Client implements ApiClientInterface
{
    public function __construct(
        private readonly string $url,
        private readonly ClientInterface $client = new GuzzleClient(),
    ) {}

    /**
     * @throws NetworkException
     * @throws RequestException
     * @throws ClientException
     */
    public function sendRequest(string $method, array $query = [], array $params = []): ?ResponseInterface
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
            throw new NetworkException($exception->getRequest(), 'Нет соединения с ' . $this->getUrl(), $exception);
        } catch (GuzzleException $e) {
            throw new ClientException(
                'Что то пошло не так при отправке запроса: ' . $this->getUrl(),
                0,
                $e
            );
        }
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}
