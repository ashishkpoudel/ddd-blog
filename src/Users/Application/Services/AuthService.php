<?php

namespace Weblog\Users\Application\Services;

use Illuminate\Hashing\HashManager;
use Weblog\Users\Domain\Repositories\UserRepositoryInterface;

final class AuthService
{
    private HashManager $hash;
    private UserRepositoryInterface $userRepository;

    public function __construct(HashManager $hash, UserRepositoryInterface $userRepository)
    {
        $this->hash = $hash;
        $this->userRepository = $userRepository;
    }

    public function tryLogin(string $emailAddress, string $password): bool
    {
        $user = $this->userRepository->findByEmailAddress($emailAddress);

        if ($user) {
            return $this->hash->check(
                $password,
                $user->getPassword()
            );
        }

        return false;
    }
}
