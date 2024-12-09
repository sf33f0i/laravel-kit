<?php

declare(strict_types=1);

namespace App\Interfaces;

interface YandexGeocoderClientInterface
{
    public function sendRequest(string $geocode, array $params = [], string $method = 'GET'): array;
}
