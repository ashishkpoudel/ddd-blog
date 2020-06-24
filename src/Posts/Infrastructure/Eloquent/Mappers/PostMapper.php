<?php

namespace Weblog\Posts\Infrastructure\Eloquent\Mappers;

use Weblog\Posts\Domain\Models\Post;
use Weblog\Posts\Domain\Models\PostInterface;
use Weblog\Posts\Domain\ValueObjects\PostId;
use Weblog\Users\Domain\ValueObjects\UserId;

final class PostMapper
{
    public static function toDomain(array $data = []): PostInterface
    {
        return app(Post::class, [
            'id' => PostId::fromString($data['id']),
            'title' => $data['title'],
            'slug' => $data['slug'],
            'body' => $data['body'],
            'userId' => UserId::fromString($data['userId']),
            'publishedAt' => new \DateTimeImmutable($data['publishedAt']),
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
