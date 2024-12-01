<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\PointConverter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    use PointConverter;

    protected $table = 'addresses';

    protected $fillable = [
        'address',
        'position',
    ];
}
