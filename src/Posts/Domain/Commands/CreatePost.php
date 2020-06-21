<?php

namespace Weblog\Posts\Domain\Commands;

use Weblog\Posts\Domain\Models\Tag;
use Weblog\Posts\Domain\ValueObjects\PostId;
use Weblog\Users\Domain\ValueObjects\UserId;
use Weblog\Core\Bus\Command\CommandInterface;

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
