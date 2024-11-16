<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:30'],
            'email' => ['required', 'email', 'min:6', 'max:30'],
            'password' => ['required', 'string', 'min:5', 'max:15'],
            'role' => ['required', 'exists:roles,id'],
        ];
    }
}
