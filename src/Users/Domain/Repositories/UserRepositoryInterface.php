<?php

namespace src\Users\Domain\Repositories;

use Illuminate\Database\Eloquent\Builder;
use src\Users\Domain\Models\User;
use src\Users\Domain\ValueObjects\UserId;

interface UserRepositoryInterface
{
    public function query(): Builder;

    public function findById(UserId $userId): ?User;

    public function findOrFailById(UserId $userId): User;

    public function save(User $user): void;
}
