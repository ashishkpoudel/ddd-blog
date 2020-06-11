<?php

namespace src\Posts\Infrastructure\Http\Controllers;

use src\Core\Http\Controllers\BaseController;
use src\Core\Http\Response\DeletedResponse;
use src\Posts\Domain\Commands\DeletePost;
use src\Posts\Domain\ValueObjects\PostId;

final class DeletePostController extends BaseController
{
    public function __invoke(string $postId)
    {
        $this->commandBus()->execute(new DeletePost(PostId::fromString($postId)));
        return new DeletedResponse();
    }
}
