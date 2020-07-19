<?php

namespace Weblog\Posts\Domain\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Weblog\Posts\Domain\Models\Tag;

interface TagRepository
{
    public function query(): Builder;

    public function save(Tag $tag): void;
}
