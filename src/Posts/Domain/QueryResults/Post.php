<?php

namespace Weblog\Posts\Domain\QueryResults;

use Weblog\Posts\Domain\Models\Tag;
use Weblog\Posts\Domain\ValueObjects\PostId;
use Weblog\Users\Domain\ValueObjects\UserId;

final class Post
{
    private PostId $id;
    private string $title;
    private string $slug;
    private string $body;
    private UserId $userId;
    private ?\DateTimeImmutable $publishedAt;

    /** @var $tags Tag[] */
    private array $tags = [];

    public function __construct(
        PostId $id,
        string $title,
        string $slug,
        string $body,
        UserId $userId,
        ?\DateTimeImmutable $publishedAt,
        array $tags = []
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->slug = $slug;
        $this->body = $body;
        $this->userId = $userId;
        $this->publishedAt = $publishedAt;
        $this->tags = $tags;
    }

    public function getId(): PostId
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getUserId(): UserId
    {
        return $this->userId;
    }

    public function getPublishedAt(): ?\DateTimeImmutable
    {
        return $this->publishedAt;
    }

    /**
     * @return Tag[]
     */
    public function getTags(): array
    {
        return $this->tags;
    }
}
