<?php

namespace src\Posts\Domain\Commands;

interface CreatePostHandlerInterface
{
    public function handle(CreatePost $command): void;
}
