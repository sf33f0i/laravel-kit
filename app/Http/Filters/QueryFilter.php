<?php

declare(strict_types=1);

namespace App\Http\Filters;

use App\Http\Requests\User\FilterUserRequest;
use Illuminate\Database\Eloquent\Builder;

abstract class QueryFilter
{
    protected FilterUserRequest $request;
    protected Builder $builder;

    public function __construct(FilterUserRequest $request)
    {
        $this->request = $request;
    }

    public function apply(Builder $builder): void
    {
        $this->builder = $builder;

        foreach ($this->fields() as $field => $value) {
            if (method_exists($this, $field)) {
                call_user_func_array([$this, $field], (array)$value);
            }
        }
    }

    protected function fields(): array
    {
        return array_filter(
            array_map('trim', $this->request->all()),
        );
    }
}
