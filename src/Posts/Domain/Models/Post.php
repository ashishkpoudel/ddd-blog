<?php

namespace src\Posts\Domain\Models;

use src\Posts\Domain\ValueObjects\PostId;
use src\Users\Domain\ValueObjects\UserId;

class Post
{
    private PostId $id;
    private string $title;
    private string $slug;
    private string $body;
    private UserId $userId;

    public function __construct(
        PostId $id,
        string $title,
        string $slug,
        string $body,
        UserId $userId
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->slug = $slug;
        $this->body = $body;
        $this->userId = $userId;
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
}
