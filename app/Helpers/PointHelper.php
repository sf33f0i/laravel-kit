<?php

declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class PointHelper
{
    public static function geometryToPoint(?string $position)
    {
        if (empty($position)) {
            return null;
        }
        $position = DB::query()->selectRaw("(ST_AsText('$position')) as point")->first();

        return $position->point;
    }
}
