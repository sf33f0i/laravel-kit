<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class FilterUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'nullable', 'string', 'min:1', 'max:15'],
            'email' => ['sometimes', 'nullable', 'string', 'min:1', 'max:15'],
        ];
    }
}
