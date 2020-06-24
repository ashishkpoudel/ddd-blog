<?php

namespace Weblog\Users\Infrastructure\Eloquent\Mappers;

use Weblog\Users\Domain\Models\User;
use Weblog\Users\Domain\Models\UserInterface;
use Weblog\Users\Domain\ValueObjects\UserId;

final class UserMapper
{
    public static function toDomain(array $data = []): UserInterface
    {
        return app(User::class, [
            'id' => UserId::fromString($data['id']),
            'name' => $data['name'],
            'emailAddress' => $data['emailAddress'],
            'emailVerifiedAt' => new \DateTimeImmutable($data['emailVerifiedAt']),
            'confirmedAt' => new \DateTimeImmutable($data['confirmedAt']),
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
