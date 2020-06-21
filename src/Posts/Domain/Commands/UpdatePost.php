<?php

namespace Weblog\Posts\Domain\Commands;

use Weblog\Core\Bus\Command\CommandInterface;
use Weblog\Posts\Domain\Models\Tag;
use Weblog\Posts\Domain\ValueObjects\PostId;

final class UpdatePost implements CommandInterface
{
    public PostId $postId;
    public ?string $title;
    public ?string $body;
    public array $tagIds;

    public function __construct(PostId $postId, ?string $title, ?string $body, Tag ...$tags)
    {
        $this->postId = $postId;
        $this->title = $title;
        $this->body = $body;
        $this->tagIds = $tags;
    }
}
