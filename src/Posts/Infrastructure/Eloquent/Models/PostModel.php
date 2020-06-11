<?php

namespace src\Posts\Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class PostModel extends Model
{
    const TABLE = 'posts';

    public $table = self::TABLE;

    protected $casts = [
        'id' => 'string'
    ];
}
