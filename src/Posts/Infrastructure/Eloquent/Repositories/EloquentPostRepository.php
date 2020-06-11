<?php

namespace src\Posts\Infrastructure\Eloquent\Repositories;

use Illuminate\Database\Eloquent\Builder;
use src\Posts\Domain\Models\Post;
use src\Posts\Domain\Repositories\PostRepositoryInterface;
use src\Posts\Domain\ValueObjects\PostId;
use src\Posts\Infrastructure\Eloquent\Mappers\PostMapper;
use src\Posts\Infrastructure\Eloquent\Models\PostModel;

class EloquentPostRepository implements PostRepositoryInterface
{
    private PostModel $model;

    public function __construct(PostModel $model)
    {
        $this->model = $model;
    }

    public function query(): Builder
    {
        return $this->model->newQuery();
    }

    public function findById(PostId $postId): ?Post
    {
        $post = $this->query()->find($postId->getValue());

        if (!$post) {
            return null;
        }

        return PostMapper::toDomain($post->toArray());
    }

    public function findByIdOrFail(PostId $postId): Post
    {
        return PostMapper::toDomain(
            $this->query()->findOrFail($postId->getValue())->toArray()
        );
    }

    public function save(Post $post): void
    {
        $model = $this->query()->find($post->id->getValue());

        if ($model) {
            $model->update(
                PostMapper::toPersistence($post)
            );
        }

        $this->query()->create(
            PostMapper::toPersistence($post)
        );
    }
}
