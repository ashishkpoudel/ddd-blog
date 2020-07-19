<?php

namespace Weblog\Posts\Domain\Commands;

use Weblog\Core\Bus\Command\CommandInterface;
use Weblog\Posts\Domain\ValueObjects\PostId;
use Weblog\Posts\Domain\ValueObjects\TagId;

final class UpdatePost implements CommandInterface
{
    private string $postId;
    private ?string $title;
    private ?string $body;
    private array $tagIds;

    public function __construct(
        string $postId,
        ?string $title,
        ?string $body,
        array $tagIds = []
    ) {
        $this->postId = $postId;
        $this->title = $title;
        $this->body = $body;
        $this->tagIds = $tagIds;
    }

    public function getPostId(): PostId
    {
        return PostId::fromString($this->postId);
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    /**
     * @return TagId[]
     */
    public function getTagIds(): array
    {
        return array_map(fn($tagId) => TagId::fromString($tagId), $this->tagIds);
    }
}
