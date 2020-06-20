<?php

namespace src\Users\Infrastructure\Eloquent\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

final class UserModel extends Authenticatable implements JWTSubject
{
    const TABLE = 'users';

    protected $table = self::TABLE;

    protected $casts = [
        'id' => 'string'
    ];

    protected $guarded = [];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
