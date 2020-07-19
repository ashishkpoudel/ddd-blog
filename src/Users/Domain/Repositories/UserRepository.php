<?php

namespace Weblog\Users\Domain\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Weblog\Users\Domain\Models\User;
use Weblog\Users\Domain\Models\UserInterface;
use Weblog\Users\Domain\ValueObjects\UserId;

interface UserRepository
{
    public function query(): Builder;

    public function findById(UserId $userId): ?UserInterface;

    public function findOrFailById(UserId $userId): UserInterface;

    public function findByEmailAddress(string $emailAddress): ?UserInterface;

    public function save(User $user): void;
}
