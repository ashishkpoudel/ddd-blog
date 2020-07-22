<?php

namespace Weblog\Posts\Domain\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Weblog\Posts\Domain\Models\Post;
use Weblog\Posts\Domain\QueryResults\Post as PostResult;
use Weblog\Posts\Domain\ValueObjects\PostId;

interface PostRepository
{
    public function query(): Builder;

    public function findById(PostId $postId): ?PostResult;

    public function findByIdOrFail(PostId $postId): PostResult;

    public function save(Post $post): void;
}
