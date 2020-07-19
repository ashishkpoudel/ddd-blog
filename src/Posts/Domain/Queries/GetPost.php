<?php

namespace Weblog\Posts\Domain\Queries;

use Weblog\Core\Bus\Query\QueryInterface;
use Weblog\Posts\Domain\ValueObjects\PostId;

final class GetPost implements QueryInterface
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
