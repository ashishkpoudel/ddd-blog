<?php

namespace src\Posts\Domain\Queries;

use src\Posts\Domain\Entities\Post;

interface GetPostHandlerInterface
{
    public function handle(GetPost $query): Post;
}
