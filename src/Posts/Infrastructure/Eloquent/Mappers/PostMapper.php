<?php

namespace src\Posts\Infrastructure\Eloquent\Mappers;

use src\Posts\Domain\Models\Post;
use src\Posts\Domain\Models\PostInterface;
use src\Posts\Domain\ValueObjects\PostId;
use src\Users\Domain\ValueObjects\UserId;

class PostMapper
{
    public static function toDomain(array $data = []): PostInterface
    {
        return app(Post::class, [
            'id' => PostId::fromString($data['id']),
            'title' => $data['title'],
            'slug' => $data['slug'],
            'body' => $data['body'],
            'userId' => UserId::fromString($data['userId']),
            'publishedAt' => new \DateTime($data['publishedAt']),
        ]);
    }

    public static function toPersistence(PostInterface $post): array
    {
        return [
            'id' => $post->getId()->getValue(),
            'title' => $post->getTitle(),
            'slug' => $post->getSlug(),
            'body' => $post->getBody(),
            'userId' => $post->getUserId()->getValue(),
        ];
    }
}
