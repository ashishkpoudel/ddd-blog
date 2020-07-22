<?php

namespace Weblog\Posts\Infrastructure\Eloquent\Mappers;

use Weblog\Posts\Domain\QueryResults\Post;
use Weblog\Posts\Domain\ValueObjects\PostId;
use Weblog\Users\Domain\ValueObjects\UserId;

final class PostMapper
{
    public static function toDomain(array $data = []): Post
    {
        return app(Post::class, [
            'id' => PostId::fromString($data['id']),
            'title' => $data['title'],
            'slug' => $data['slug'],
            'body' => $data['body'],
            'userId' => UserId::fromString($data['userId']),
            'publishedAt' => new \DateTimeImmutable($data['publishedAt']),
            'tags' => isset($data['tags']) ? array_map(fn($tag) => TagMapper::toDomain($tag), $data['tags']) : [],
        ]);
    }
}
