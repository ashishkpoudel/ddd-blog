<?php

namespace Weblog\Posts\Domain\Models;

use Weblog\Posts\Domain\ValueObjects\PostId;
use Weblog\Posts\Domain\ValueObjects\TagId;
use Weblog\Users\Domain\ValueObjects\UserId;
use Weblog\Posts\Domain\QueryResults\Tag;

final class Post
{
    private PostId $id;
    private string $title;
    private string $slug;
    private string $body;
    private UserId $userId;
    private ?\DateTimeImmutable $publishedAt;

    /** @var Tag[] */
    private array $tags = [];

    public function __construct(
        PostId $id,
        string $title,
        string $slug,
        string $body,
        UserId $userId,
        ?\DateTimeImmutable $publishedAt
    ) {
        $this->setId($id);
        $this->setTitle($title);
        $this->setSlug($slug);
        $this->setBody($body);
        $this->setUserId($userId);
        $this->setPublishedAt($publishedAt);
    }

    public function markAsPublished(): void
    {
        $this->publishedAt = new \DateTimeImmutable();
    }

    public function markAsUnpublished(): void
    {
        $this->publishedAt = null;
    }

    public function addTag(Tag $tag): void
    {
        $this->tags[] = $tag;
    }

    public function removeTag(TagId $tagId): void
    {
        foreach ($this->tags as $index => $tag) {
            if ($tag->getId()->equals($tagId)) {
                unset($this->tags[$index]);
                break;
            }
        }
    }

    private function setId(PostId $id): void
    {
        $this->id = $id;
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

    private function setSlug(string $slug): void
    {
        if (strlen($slug) === 0) {
            throw new \InvalidArgumentException(
                'Post slug cannot be empty'
            );
        }

        $this->slug = $slug;
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

    private function setUserId(UserId $userId): void
    {
        $this->userId = $userId;
    }

    private function setPublishedAt(?\DateTimeImmutable $publishedAt): void
    {
        $this->publishedAt = $publishedAt;
    }

    public function mappedData(): array
    {
        return [
            'id' => $this->id->getValue(),
            'title' => $this->title,
            'slug' => $this->slug,
            'body' => $this->body,
            'userId' => $this->userId->getValue(),
            'publishedAt' => $this->publishedAt ? $this->publishedAt->format('Y-m-d') : null,
            'tagIds' => array_map(fn(Tag $tag) => $tag->getId(), $this->tags),
        ];
    }
}
