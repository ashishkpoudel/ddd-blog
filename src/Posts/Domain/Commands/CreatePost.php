<?php

namespace Weblog\Posts\Domain\Commands;

use Weblog\Posts\Domain\ValueObjects\PostId;
use Weblog\Posts\Domain\ValueObjects\TagId;
use Weblog\Users\Domain\ValueObjects\UserId;
use Weblog\Core\Bus\Command\CommandInterface;

final class CreatePost implements CommandInterface
{
    private string $postId;
    private string $userId;
    private string $title;
    private string $body;
    private array $tagIds = [];

    public function __construct(
        string $postId,
        string $userId,
        string $title,
        string $body,
        $tagIds = []
    ) {
        $this->postId = $postId;
        $this->userId = $userId;
        $this->title = $title;
        $this->body = $body;
        $this->tagIds = $tagIds;
    }

    public function getPostId(): PostId
    {
        return PostId::fromString($this->postId);
    }

    public function getUserId(): UserId
    {
        return UserId::fromString($this->userId);
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getBody(): string
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
