<?php

declare(strict_types=1);

namespace App\Http\Requests\Page;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CreatePageRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        if ($this->alias === null) {
            $this->merge([
                'alias' => Str::slug($this->title),
            ]);
        }
    }
    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'alias' => ['required', 'string', 'unique:pages,alias'],
            'text' => ['required', 'string'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string'],
        ];
    }
}
