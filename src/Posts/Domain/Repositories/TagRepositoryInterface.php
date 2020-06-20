<?php

namespace src\Posts\Domain\Repositories;

use Illuminate\Database\Eloquent\Builder;
use src\Posts\Domain\Models\Tag;

interface TagRepositoryInterface
{
    public function query(): Builder;

    public function save(Tag $tag): void;

    public function saveMany(array $tags): void;
}
