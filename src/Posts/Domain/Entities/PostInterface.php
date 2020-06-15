<?php

namespace src\Posts\Domain\Entities;

use src\Posts\Domain\ValueObjects\PostId;
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
}
