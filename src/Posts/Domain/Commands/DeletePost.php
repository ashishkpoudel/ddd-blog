<?php

namespace Weblog\Posts\Domain\Commands;

use Weblog\Core\Bus\Command\CommandInterface;
use Weblog\Posts\Domain\ValueObjects\PostId;

final class DeletePost implements CommandInterface
{
    public PostId $postId;

    public function __construct(PostId $postId)
    {
        $this->postId = $postId;
    }
}
