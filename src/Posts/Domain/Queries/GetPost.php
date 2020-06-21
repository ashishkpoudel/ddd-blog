<?php

namespace Weblog\Posts\Domain\Queries;

use Weblog\Core\Bus\Query\QueryInterface;
use Weblog\Posts\Domain\ValueObjects\PostId;

final class GetPost implements QueryInterface
{
    public PostId $postId;

    public function __construct(PostId $postId)
    {
        $this->postId = $postId;
    }
}
