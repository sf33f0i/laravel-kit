<?php

declare(strict_types=1);

namespace App\Http\Requests\Address;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddressRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'address' => ['required', 'string', 'max:255', 'min:2'],
        ];
    }

    public function attributes(): array
    {
        return [
            'address' => '"Адрес"',
        ];
    }
}
