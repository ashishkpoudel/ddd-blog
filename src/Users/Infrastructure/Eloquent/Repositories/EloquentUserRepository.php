<?php

namespace Weblog\Users\Infrastructure\Eloquent\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Weblog\Users\Domain\Models\User;
use Weblog\Users\Domain\Models\UserInterface;
use Weblog\Users\Domain\Repositories\UserRepositoryInterface;
use Weblog\Users\Domain\ValueObjects\UserId;
use Weblog\Users\Infrastructure\Eloquent\Mappers\UserMapper;
use Weblog\Users\Infrastructure\Eloquent\Models\UserModel;

final class EloquentUserRepository implements UserRepositoryInterface
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
