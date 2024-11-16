<?php

declare(strict_types=1);

namespace App\UseCases\Page;

use App\Models\Page;

readonly class CreatePageCase
{
    public function __construct(private Page $page)
    {
    }

    public function handle(array $data): void
    {
        $this->page::create($data);
    }
}
