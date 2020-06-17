<?php

namespace src\Users\Infrastructure\Eloquent\Mappers;

use src\Users\Domain\Models\User;
use src\Users\Domain\Models\UserInterface;
use src\Users\Domain\ValueObjects\UserId;

class UserMapper
{
    public static function toDomain(array $data = []): UserInterface
    {
        return app(User::class, [
            'id' => UserId::fromString($data['id']),
            'name' => $data['name'],
            'emailAddress' => $data['emailAddress'],
            'emailVerifiedAt' => new \DateTime($data['emailVerifiedAt']),
            'confirmedAt' => new \DateTime($data['confirmedAt']),
            'password' => $data['password'],
        ]);
    }

    public static function toPersistence(User $user): array
    {
        return [
            'id' => $user->getId()->getValue(),
            'name' => $user->getName(),
            'emailAddress' => $user->getEmailAddress(),
            'emailVerifiedAt' => $user->getEmailVerifiedAt(),
            'confirmedAt' => $user->getConfirmedAt(),
            'password' => $user->getPassword()
        ];
    }
}
