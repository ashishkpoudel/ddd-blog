<?php

namespace Weblog\Posts\Domain\Commands;

use Weblog\Core\Bus\Command\CommandInterface;
use Weblog\Posts\Domain\ValueObjects\PostId;

final class PublishPost implements CommandInterface
{
    public PostId $postId;

    public function __construct(PostId $postId)
    {
        $this->postId = $postId;
    }
}
