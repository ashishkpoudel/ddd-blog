<?php

namespace Weblog\Posts\Domain\Commands;

use Weblog\Core\Bus\Command\CommandInterface;
use Weblog\Posts\Domain\ValueObjects\PostId;

final class DeletePost implements CommandInterface
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
