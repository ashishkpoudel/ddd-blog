<?php

namespace src\Posts\Infrastructure\Eloquent\Mappers;

use src\Posts\Domain\Models\Post;
use src\Posts\Domain\ValueObjects\PostId;
use src\Users\Domain\ValueObjects\UserId;

class PostMapper
{
    public static function toDomain(array $data): Post
    {
        return app(Post::class, [
            'id' => PostId::fromString($data['id']),
            'title' => $data['title'],
            'slug' => $data['slug'],
            'body' => $data['body'],
            'userId' => UserId::fromString($data['userId']),
        ]);
    }

    public static function toPersistence(Post $post): array
    {
        return [
            'title' => $post->getTitle(),
            'slug' => $post->getSlug(),
            'body' => $post->getBody(),
            'userId' => $post->getUserId()->getValue(),
        ];
    }
}
