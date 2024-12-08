<?php

declare(strict_types=1);

namespace App\UseCases\Address;

use App\Clients\YandexGeocoderClient;
use App\Exceptions\NotFoundAddressException;
use App\Interfaces\YandexGeocoderClientInterface;
use App\Models\Address;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;

readonly class StoreAddressCase
{
    /**
     * @param YandexGeocoderClient $client
     */
    public function __construct(
        private YandexGeocoderClientInterface $client,
    ) {}

    /**
     * @param string $address
     *
     * @throws NotFoundAddressException
     * @throws GuzzleException
     * @throws JsonException
     */
    public function handle(string $address): void
    {
        $addressPosition = $this->client->getAddressPosition($address);
        if ($addressPosition === null) {
            throw new NotFoundAddressException();
        }

        Address::query()->create([
            'address' => $addressPosition['address'],
            'position' => "POINT($addressPosition[position])",
        ]);
    }
}
