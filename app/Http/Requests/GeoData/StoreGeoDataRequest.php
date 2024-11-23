<?php

declare(strict_types=1);

namespace App\Http\Requests\GeoData;

use Illuminate\Foundation\Http\FormRequest;

class StoreGeoDataRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'address' => ['required', 'string', 'max:255', 'min:1'],
        ];
    }

    public function attributes(): array
    {
        return [
            'address' => 'Адрес',
        ];
    }

    public function messages(): array
    {
        return [
            'address.required' => 'Введите адрес!',
        ];
    }
}
