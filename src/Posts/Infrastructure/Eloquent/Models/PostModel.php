<?php

namespace Weblog\Posts\Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

final class PostModel extends Model
{
    const TABLE = 'posts';

    public $table = self::TABLE;

    protected $casts = [
        'id' => 'string'
    ];

    protected $guarded = [];

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(
            TagModel::class,
            'post_tag',
            'postId',
            'tagId'
        );
    }
}
