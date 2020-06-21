<?php

namespace Weblog\Posts\Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

final class TagModel extends Model
{
    const TABLE = 'tags';

    protected $table = self::TABLE;

    protected $casts = [
        'id' => 'string',
    ];

    protected $guarded = [];
}
