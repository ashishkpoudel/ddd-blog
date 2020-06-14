<?php

namespace src\Posts\Infrastructure\Eloquent\Repositories;

use Illuminate\Database\Eloquent\Builder;
use src\Posts\Domain\Entities\Tag;
use src\Posts\Domain\Repositories\TagRepositoryInterface;
use src\Posts\Infrastructure\Eloquent\Mappers\TagMapper;
use src\Posts\Infrastructure\Eloquent\Models\TagModel;

class EloquentTagRepository implements TagRepositoryInterface
{
    private TagModel $tagModel;

    public function __construct(TagModel $model)
    {
        $this->tagModel = $model;
    }

    public function query(): Builder
    {
        return $this->tagModel->newQuery();
    }

    public function save(Tag $tag): void
    {
        $model = $this->query()->find($tag->getId()->getValue());

        if ($model) {
            $model->update(
                TagMapper::toPersistence($tag)
            );
            return;
        }

        $this->query()->create(
            TagMapper::toPersistence($tag)
        );
    }

    public function saveMany(Tag ...$tags): void
    {
        foreach ($tags as $tag) {
            $this->save($tag);
        }
    }
}
