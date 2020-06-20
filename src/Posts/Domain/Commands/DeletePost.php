<?php

namespace src\Posts\Domain\Commands;

use src\Core\Bus\Command\CommandInterface;
use src\Posts\Domain\ValueObjects\PostId;

final class DeletePost implements CommandInterface
{
    public PostId $postId;

    public function __construct(PostId $postId)
    {
        $this->postId = $postId;
    }
}
