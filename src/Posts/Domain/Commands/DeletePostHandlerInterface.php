<?php

namespace src\Posts\Domain\Commands;

interface DeletePostHandlerInterface
{
    public function handle(DeletePost $command): void;
}
