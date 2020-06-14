<?php

namespace src\Posts\Domain\Events;

use src\Posts\Domain\ValueObjects\PostId;

class PostPublished
{
    public PostId $postId;

    public function __construct(PostId $postId)
    {
        $this->postId = $postId;
    }
}
