<?php

namespace src\Users\Domain\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;

class UserJwtSubject implements JWTSubject
{
    private string $identifier;
    private array $customClaims;

    public function __construct(string $identifier, array $customClaims = [])
    {
        $this->identifier = $identifier;
        $this->customClaims = $customClaims;
    }

    public function getJWTIdentifier()
    {
        return $this->identifier;
    }

    public function getJWTCustomClaims()
    {
        return $this->customClaims;
    }
}
