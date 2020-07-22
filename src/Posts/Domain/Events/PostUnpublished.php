<?php

namespace Weblog\Posts\Domain\Events;

use Weblog\Posts\Domain\ValueObjects\PostId;

final class PostUnpublished
{
    private string $postId;

    public function __construct(string $postId)
    {
        $this->postId = $postId;
    }

    public function getPostId(): PostId
    {
        return PostId::fromString($this->postId);
    }
}
