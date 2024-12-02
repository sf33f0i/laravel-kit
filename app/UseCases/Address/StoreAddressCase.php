<?php

declare(strict_types=1);

namespace App\UseCases\Address;

use App\Clients\YandexGeocoderClient;
use App\Exceptions\ClientException;
use App\Exceptions\NetworkException;
use App\Exceptions\NotFoundAddressException;
use App\Interfaces\YandexGeocoderClientInterface;
use App\Models\Address;

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
     * @throws ClientException
     * @throws NetworkException
     * @throws NotFoundAddressException
     */
    public function handle(string $address): void
    {
        $addressPosition = $this->client->getAddressPosition($address);
        if ($addressPosition === null) {
            throw new NotFoundAddressException('Координаты данного адреса не найдены!');
        }

        Address::query()->create([
            'address' => $addressPosition['address'],
            'position' => "POINT($addressPosition[position])",
        ]);
    }
}
