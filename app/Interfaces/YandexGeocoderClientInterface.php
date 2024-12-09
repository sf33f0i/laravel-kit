<?php

declare(strict_types=1);

namespace App\Interfaces;

interface YandexGeocoderClientInterface
{
    public function getGeoData(string $geocode, array $params = []): array;
}
