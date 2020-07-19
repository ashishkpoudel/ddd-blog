<?php

namespace Weblog\Posts\Domain\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Weblog\Posts\Domain\Models\PostInterface;
use Weblog\Posts\Domain\ValueObjects\PostId;

interface PostRepository
{
    public function query(): Builder;

    public function findById(PostId $postId): ?PostInterface;

    public function findByIdOrFail(PostId $postId): PostInterface;

    public function save(PostInterface $post): void;
}
