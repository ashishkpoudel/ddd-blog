<?php

namespace Weblog\Users\Application\QueryHandlers;

use Illuminate\Config\Repository as Config;
use Tymon\JWTAuth\JWT;
use Weblog\Users\Domain\Repositories\UserRepository;
use Weblog\Users\Domain\Queries\GetUserAuthTokenByEmail;
use Weblog\Users\Domain\Models\UserJwtSubject;

final class GetUserAuthTokenByEmailHandler
{
    private JWT $jwt;
    private Config $config;
    private UserRepository $userRepository;

    public function __construct(JWT $jwt, Config $config, UserRepository $userRepository)
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
