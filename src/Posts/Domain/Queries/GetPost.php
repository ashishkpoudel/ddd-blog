<?php

namespace src\Posts\Domain\Queries;

use src\Core\Bus\Query\QueryInterface;
use src\Posts\Domain\ValueObjects\PostId;

final class GetPost implements QueryInterface
{
    public PostId $postId;

    public function __construct(PostId $postId)
    {
        $this->postId = $postId;
    }
}
