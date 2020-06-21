<?php

namespace Weblog\Posts\Infrastructure\Eloquent\Mappers;

use Weblog\Posts\Domain\Models\Tag;
use Weblog\Posts\Domain\ValueObjects\TagId;

final class TagMapper
{
    public static function toDomain(array $data): Tag
    {
        return app(Tag::class, [
            'id' => TagId::fromString($data['id']),
            'name' => $data['name'],
        ]);
    }

    public static function toPersistence(Tag $tag): array
    {
        return [
            'id' => $tag->getId(),
            'name' => $tag->getName(),
        ];
    }
}
