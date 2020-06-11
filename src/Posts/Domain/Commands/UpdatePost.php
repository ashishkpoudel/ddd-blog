<?php

namespace src\Posts\Domain\Commands;

use src\Core\Bus\Command\CommandInterface;
use src\Posts\Domain\ValueObjects\PostId;

class UpdatePost implements CommandInterface
{
    public PostId $postId;
    public ?string $title;
    public ?string $body;

    public function __construct(PostId $postId, ?string $title, ?string $body)
    {
        $this->postId = $postId;
        $this->title = $title;
        $this->body = $body;
    }
}
