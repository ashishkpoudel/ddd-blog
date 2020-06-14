<?php

namespace src\Users\Application\Queries;

use src\Users\Domain\Entities\User;
use src\Users\Domain\Queries\GetUserAuthTokenByEmail;
use src\Users\Domain\Queries\GetUserAuthTokenByEmailHandlerInterface;
use Illuminate\Config\Repository as Config;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\JWT;

class GetUserAuthTokenByEmailHandler implements GetUserAuthTokenByEmailHandlerInterface
{
    private JWT $jwt;
    private Config $config;

    public function __construct(JWT $jwt, Config $config)
    {
        $this->jwt = $jwt;
        $this->config = $config;
    }


    public function handle(GetUserAuthTokenByEmail $query): array
    {
        /** @var $user JWTSubject */
        $user = User::query()->where('emailAddress', '=', $query->emailAddress)->first();

        return [
            'accessToken' => $this->jwt->fromUser($user),
            'tokenType' => 'Bearer',
            'expiresIn' => $this->config->get('jwt.ttl') * 60,
        ];
    }
}
