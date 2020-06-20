<?php

namespace src\Posts\Domain\Commands;

use src\Posts\Domain\Models\Tag;
use src\Posts\Domain\ValueObjects\PostId;
use src\Users\Domain\ValueObjects\UserId;
use src\Core\Bus\Command\CommandInterface;

final class CreatePost implements CommandInterface
{
    public PostId $postId;
    public UserId $userId;
    public string $title;
    public string $body;
    public array $tagIds = [];

    public function __construct(PostId $postId, UserId $userId, string $title, string $body, Tag ...$tags)
    {
        $this->postId = $postId;
        $this->userId = $userId;
        $this->title = $title;
        $this->body = $body;
        $this->tagIds = $tags;
    }
}
