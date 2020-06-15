<?php

namespace src\Users\Infrastructure\Eloquent\Repositories;

use Illuminate\Database\Eloquent\Builder;
use src\Users\Domain\Entities\User;
use src\Users\Domain\Entities\UserInterface;
use src\Users\Domain\Repositories\UserRepositoryInterface;
use src\Users\Domain\ValueObjects\UserId;
use src\Users\Infrastructure\Eloquent\Mappers\UserMapper;
use src\Users\Infrastructure\Eloquent\Models\UserModel;

class EloquentUserRepository implements UserRepositoryInterface
{
    private UserModel $userModel;

    public function __construct(UserModel $model)
    {
        $this->userModel = $model;
    }

    public function query(): Builder
    {
        return $this->userModel->newQuery();
    }

    public function findById(UserId $userId): ?UserInterface
    {
        $user = $this->query()->find($userId->getValue());

        if (!$user) {
            return null;
        }

        return UserMapper::toDomain($user->toArray());
    }

    public function findOrFailById(UserId $userId): UserInterface
    {
        return UserMapper::toDomain($this->query()->findOrFail($userId->getValue())->toArray());
    }

    public function findByEmailAddress(string $emailAddress): ?UserInterface
    {
        $user = $this->query()->where('emailAddress', '=', $emailAddress)->first();

        if (!$user) {
            return null;
        }

        return UserMapper::toDomain($user->toArray());
    }

    public function save(User $user): void
    {
        $model = $this->query()->find($user->getId()->getValue());

        if ($model) {
            $model->update(
                UserMapper::toPersistence($user)
            );
            return;
        }

        $this->query()->create(
            UserMapper::toPersistence($user)
        );
    }
}
