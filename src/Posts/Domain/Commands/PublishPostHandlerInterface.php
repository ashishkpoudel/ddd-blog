<?php

namespace src\Posts\Domain\Commands;

interface PublishPostHandlerInterface
{
    public function handle(PublishPost $publishPost): void;
}
