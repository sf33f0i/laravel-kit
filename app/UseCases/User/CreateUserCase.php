<?php

declare(strict_types=1);

namespace App\UseCases\User;

use App\Models\User;
use Illuminate\Contracts\Hashing\Hasher;

readonly class CreateUserCase
{
    public function __construct(
        private User $user,
        private Hasher $hasher,
    ) {}

    public function handle(array $data): void
    {
        $data['password'] = $this->hasher->make($data['password']);
        /** @var User $user */
        $user = $this->user::query()->create($data);
        $user->assignRole((int)$data['role']);
    }
}
