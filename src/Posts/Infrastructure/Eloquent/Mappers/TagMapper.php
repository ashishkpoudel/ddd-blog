<?php

namespace src\Posts\Infrastructure\Eloquent\Mappers;

use src\Posts\Domain\Entities\Tag;
use src\Posts\Domain\ValueObjects\TagId;

class TagMapper
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
