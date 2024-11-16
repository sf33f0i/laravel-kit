<?php

declare(strict_types=1);

namespace App\Http\Filters\User;

use App\Http\Filters\QueryFilter;

class UserFilter extends QueryFilter
{
    public function name(string $name): void
    {
        $this->builder
            ->where('name', 'ilike', '%' . $name . '%')
            ->orderBy('id', 'DESC');
    }

    public function email(string $email): void
    {
        $this->builder
            ->where('email', 'ilike', '%' . $email . '%')
            ->orderBy('id', 'DESC');
    }
}
