<?php

namespace Weblog\Posts;

use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Weblog\Posts\Domain\Commands\CreatePost;
use Weblog\Posts\Domain\Commands\DeletePost;
use Weblog\Posts\Application\CommandHandlers\CreatePostHandler;
use Weblog\Posts\Application\CommandHandlers\DeletePostHandler;
use Weblog\Posts\Application\CommandHandlers\UpdatePostHandler;
use Weblog\Posts\Domain\Commands\UpdatePost;
use Weblog\Posts\Domain\Queries\GetPaginatedPost;
use Weblog\Posts\Domain\Queries\GetPost;
use Weblog\Posts\Application\QueryHandlers\GetPaginatedPostHandler;
use Weblog\Posts\Application\QueryHandlers\GetPostHandler;
use Weblog\Posts\Domain\Repositories\PostRepositoryInterface;
use Weblog\Posts\Domain\Repositories\TagRepositoryInterface;
use Weblog\Posts\Infrastructure\Eloquent\Repositories\EloquentPostRepository;
use Weblog\Posts\Infrastructure\Eloquent\Repositories\EloquentTagRepository;

class PostServiceProvider extends ServiceProvider
{
    private array $commands = [
        CreatePost::class => CreatePostHandler::class,
        UpdatePost::class => UpdatePostHandler::class,
        DeletePost::class => DeletePostHandler::class
    ];

    private array $queries = [
        GetPaginatedPost::class => GetPaginatedPostHandler::class,
        GetPost::class => GetPostHandler::class
    ];

    public function boot()
    {
        Bus::map($this->commands);
        Bus::map($this->queries);

        Route::prefix('api')->group(base_path('src/Posts/Infrastructure/Http/routes.php'));
    }

    public function register()
    {
        $this->app->bind(PostRepositoryInterface::class, EloquentPostRepository::class);
        $this->app->bind(TagRepositoryInterface::class, EloquentTagRepository::class);
    }
}
