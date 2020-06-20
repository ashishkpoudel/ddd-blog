<?php

namespace src\Posts\Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class TagModel extends Model
{
    const TABLE = 'tags';

    protected $table = self::TABLE;

    protected $casts = [
        'id' => 'string',
    ];

    protected $guarded = [];
}
