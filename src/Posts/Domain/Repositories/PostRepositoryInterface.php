<?php

namespace src\Posts\Domain\Repositories;

use Illuminate\Database\Eloquent\Builder;
use src\Posts\Domain\Entities\Post;
use src\Posts\Domain\ValueObjects\PostId;

interface PostRepositoryInterface
{
    public function query(): Builder;

    public function findById(PostId $postId): ?Post;

    public function findByIdOrFail(PostId $postId): Post;

    public function save(Post $post): void;
}
