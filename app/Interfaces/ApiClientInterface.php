<?php

declare(strict_types=1);

namespace App\Interfaces;

use Psr\Http\Message\ResponseInterface;

interface ApiClientInterface
{
    public function sendRequest(string $method, array $query = [], array $params = []): ?ResponseInterface;
}
