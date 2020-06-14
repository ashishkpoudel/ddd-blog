<?php

namespace src\Users\Infrastructure\Eloquent\Repositories;

use Illuminate\Database\Eloquent\Builder;
use src\Users\Domain\Models\User;
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

    public function findById(UserId $userId): ?User
    {
        $user = $this->query()->find($userId->getValue());

        if (!$user) {
            return null;
        }

        return UserMapper::toDomain($user);
    }

    public function findOrFailById(UserId $userId): User
    {
        return UserMapper::toDomain($this->query()->findOrFail($userId->getValue()));
    }

    public function save(User $user): void
    {
        $model = $this->query()->find($user->getId()->getValue());

        if ($model) {
            $model->update(
                UserMapper::toPersistence($user)
            );
        }

        $this->query()->create(
            UserMapper::toPersistence($user)
        );
    }
}
