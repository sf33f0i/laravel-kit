<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait PointConverter
{
    public function geometryToPoint(?string $position): ?string
    {
        if (empty($position)) {
            return null;
        }
        $position = DB::query()->selectRaw("(ST_AsText('$position')) as point")->first();

        return $position->point;
    }
}
