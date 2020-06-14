<?php

namespace src\Posts\Domain\Entities;

use src\Posts\Domain\ValueObjects\PostId;
use src\Users\Domain\ValueObjects\UserId;

class Post
{
    private PostId $id;
    private string $title;
    private string $slug;
    private string $body;
    private UserId $userId;
    private ?\DateTime $publishedAt;

    public function __construct(
        PostId $id,
        string $title,
        string $slug,
        string $body,
        UserId $userId,
        ?\DateTime $publishedAt
    ) {
        $this->setId($id);
        $this->setTitle($title);
        $this->setSlug($slug);
        $this->setBody($body);
        $this->setUserId($userId);
        $this->setPublishedAt($publishedAt);
    }

    public function markAsPublished()
    {
        $this->publishedAt = new \DateTime();
    }

    public function markAsUnpublished()
    {
        $this->publishedAt = null;
    }

    public function getId(): PostId
    {
        return $this->id;
    }

    private function setId(PostId $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    private function setTitle(string $title): void
    {
        if (strlen($title) === 0) {
            throw new \InvalidArgumentException(
                'Post title cannot be empty'
            );
        }

        $this->title = $title;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    private function setSlug(string $slug): void
    {
        if (strlen($slug) === 0) {
            throw new \InvalidArgumentException(
                'Post slug cannot be empty'
            );
        }

        $this->slug = $slug;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    private function setBody(string $body): void
    {
        if (strlen($body) === 0) {
            throw new \InvalidArgumentException(
                'Post body cannot be empty'
            );
        }

        $this->body = $body;
    }

    public function getUserId(): UserId
    {
        return $this->userId;
    }

    private function setUserId(UserId $userId): void
    {
        $this->userId = $userId;
    }

    public function getPublishedAt(): ?\DateTime
    {
        return $this->publishedAt;
    }

    private function setPublishedAt(?\DateTime $publishedAt): void
    {
        $this->publishedAt = $publishedAt;
    }
}
