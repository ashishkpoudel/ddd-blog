<?php

namespace src\Posts\Domain\Models;

use src\Posts\Domain\ValueObjects\PostId;
use src\Posts\Domain\ValueObjects\TagId;
use src\Users\Domain\ValueObjects\UserId;

interface PostInterface
{
    public function getId(): PostId;
    public function getTitle(): string;
    public function getSlug(): string;
    public function getBody(): string;
    public function getUserId(): UserId;
    public function getPublishedAt(): ?\DateTime;

    /** @return Tag[] */
    public function getTags(): array;

    public function markAsPublished(): void;
    public function markAsUnpublished(): void;
    public function addTag(TagInterface $tag): void;
    public function removeTag(TagId $tag): void;
}
