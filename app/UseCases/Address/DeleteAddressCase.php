<?php

declare(strict_types=1);

namespace App\UseCases\Address;

use App\Exceptions\DeleteModelException;
use App\Models\Address;

class DeleteAddressCase
{
    /**
     * @param Address $geoData
     *
     * @throws DeleteModelException
     */
    public function handle(Address $geoData): void
    {
        $delete = $geoData->delete();

        if ($delete === false) {
            throw new DeleteModelException('Ошибка удаления!');
        }
    }
}
