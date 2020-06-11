<?php

namespace src\Posts\Domain\Commands;

interface UpdatePostHandlerInterface
{
    public function handle(UpdatePost $command): void;
}
