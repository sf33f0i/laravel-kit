<?php

declare(strict_types=1);

namespace App\UseCases\GeoData;

use App\Exceptions\DeleteModelException;
use App\Models\GeoData;

class DeleteGeoDataCase
{
    /**
     * @param GeoData $geoData
     *
     * @throws DeleteModelException
     */
    public function handle(GeoData $geoData): void
    {
        $delete = $geoData->delete();

        if ($delete === false) {
            throw new DeleteModelException('Ошибка удаления!');
        }
    }
}
