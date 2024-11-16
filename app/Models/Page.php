<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'title',
        'alias',
        'text',
        'active',
        'seo_title',
        'seo_description',
    ];

}
