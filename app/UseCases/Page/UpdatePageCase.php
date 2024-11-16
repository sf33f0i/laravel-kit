<?php

declare(strict_types=1);

namespace App\UseCases\Page;

use App\Models\Page;

readonly class UpdatePageCase
{
    public function handle(array $data, Page $page): void
    {
        $page->update($data);
    }
}
