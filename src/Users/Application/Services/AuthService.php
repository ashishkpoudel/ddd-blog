<?php

namespace src\Users\Application\Services;

use Illuminate\Hashing\HashManager;
use src\Users\Domain\Repositories\UserRepositoryInterface;

class AuthService
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
