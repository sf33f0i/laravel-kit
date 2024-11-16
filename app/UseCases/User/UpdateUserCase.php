<?php

declare(strict_types=1);

namespace App\UseCases\User;

use App\Models\User;
use Illuminate\Contracts\Hashing\Hasher;

readonly class UpdateUserCase
{
    public function __construct(
        private User $user,
        private Hasher $hasher,
    ) {}

    public function handle(int $id, array $data): void
    {
        /** @var User $user */
        $user = $this->user::query()->findOrFail($id);
        $data['password'] = $this->hasher->make($data['password']);
        $user->syncRoles([]);
        $user->assignRole((int)$data['role']);
        $user->update($data);
    }
}
