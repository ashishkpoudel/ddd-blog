<?php

namespace Weblog\Posts\Infrastructure\Eloquent\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Weblog\Posts\Domain\Models\Post;
use Weblog\Posts\Domain\QueryResults\Post as PostResult;
use Weblog\Posts\Domain\Repositories\PostRepository;
use Weblog\Posts\Domain\Repositories\TagRepository;
use Weblog\Posts\Domain\ValueObjects\PostId;
use Weblog\Posts\Infrastructure\Eloquent\Mappers\PostMapper;
use Weblog\Posts\Infrastructure\Eloquent\Models\PostModel;

final class EloquentPostRepository implements PostRepository
{
    private PostModel $model;
    private TagRepository $tagRepository;

    public function __construct(PostModel $model, TagRepository $tagRepository)
    {
        $this->model = $model;
        $this->tagRepository = $tagRepository;
    }

    public function query(): Builder
    {
        return $this->model->newQuery();
    }

    public function findById(PostId $postId): ?PostResult
    {
        $post = $this->query()
            ->with('tags')
            ->find($postId->getValue());

        if (!$post) {
            return null;
        }

        return PostMapper::toDomain($post->toArray());
    }

    public function findByIdOrFail(PostId $postId): PostResult
    {
        return PostMapper::toDomain(
            $this->query()
                ->with('tags')
                ->findOrFail($postId->getValue())->toArray()
        );
    }

    public function save(Post $post): void
    {
        $data = $post->mappedData();
        $postData = Arr::except($data, ['tagIds']);
        $tagIds = $data['tagIds'];

        /** @var PostModel $model */
        $model = $this->query()->find(PostId::fromString($postData['id']));

        if ($model) {
            $model->update($postData);
            $model->tags()->sync($tagIds);
            return;
        }

        $model = $this->query()->create($postData);
        $model->tags()->sync($tagIds);
    }
}
