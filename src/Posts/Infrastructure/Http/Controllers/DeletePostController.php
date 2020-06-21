<?php

namespace Weblog\Posts\Infrastructure\Http\Controllers;

use Weblog\Core\Http\Controllers\BaseController;
use Weblog\Core\Http\Response\DeletedResponse;
use Weblog\Posts\Domain\Commands\DeletePost;
use Weblog\Posts\Domain\ValueObjects\PostId;

final class DeletePostController extends BaseController
{
    public function __invoke(string $postId)
    {
        $this->commandBus()->execute(new DeletePost(PostId::fromString($postId)));
        return new DeletedResponse();
    }
}
