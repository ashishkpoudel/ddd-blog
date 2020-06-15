<?php

namespace src\Users\Domain\Repositories;

use Illuminate\Database\Eloquent\Builder;
use src\Users\Domain\Entities\User;
use src\Users\Domain\Entities\UserInterface;
use src\Users\Domain\ValueObjects\UserId;

interface UserRepositoryInterface
{
    public function query(): Builder;

    public function findById(UserId $userId): ?UserInterface;

    public function findOrFailById(UserId $userId): UserInterface;

    public function findByEmailAddress(string $emailAddress): ?UserInterface;

    public function save(User $user): void;
}
