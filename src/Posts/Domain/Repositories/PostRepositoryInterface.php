<?php

namespace src\Posts\Domain\Repositories;

use Illuminate\Database\Eloquent\Builder;
use src\Posts\Domain\Models\PostInterface;
use src\Posts\Domain\ValueObjects\PostId;

interface PostRepositoryInterface
{
    public function query(): Builder;

    public function findById(PostId $postId): ?PostInterface;

    public function findByIdOrFail(PostId $postId): PostInterface;

    public function save(PostInterface $post): void;
}
