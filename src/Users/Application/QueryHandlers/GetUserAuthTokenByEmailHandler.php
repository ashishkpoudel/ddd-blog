<?php

namespace src\Users\Application\QueryHandlers;

use Illuminate\Config\Repository as Config;
use Tymon\JWTAuth\JWT;
use src\Users\Domain\Repositories\UserRepositoryInterface;
use src\Users\Domain\Queries\GetUserAuthTokenByEmail;
use src\Users\Domain\Models\UserJwtSubject;

final class GetUserAuthTokenByEmailHandler
{
    private JWT $jwt;
    private Config $config;
    private UserRepositoryInterface $userRepository;

    public function __construct(JWT $jwt, Config $config, UserRepositoryInterface $userRepository)
    {
        $this->jwt = $jwt;
        $this->config = $config;
        $this->userRepository = $userRepository;
    }

    public function handle(GetUserAuthTokenByEmail $query): array
    {
        $user = $this->userRepository->findByEmailAddress($query->emailAddress);

        return [
            'accessToken' => $this->jwt->fromSubject(new UserJwtSubject($user->getId()->getValue())),
            'tokenType' => 'Bearer',
            'expiresIn' => $this->config->get('jwt.ttl') * 60,
        ];
    }
}
