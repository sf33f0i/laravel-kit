<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeoData extends Model
{
    use HasFactory;

    protected $table = 'geodata';

    protected $fillable = [
        'address',
        'position',
    ];
}
