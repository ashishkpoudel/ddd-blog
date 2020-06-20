<?php

namespace src\Posts;

use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use src\Posts\Domain\Commands\CreatePost;
use src\Posts\Domain\Commands\DeletePost;
use src\Posts\Application\Commands\CreatePostHandler;
use src\Posts\Application\Commands\DeletePostHandler;
use src\Posts\Application\Commands\UpdatePostHandler;
use src\Posts\Domain\Commands\UpdatePost;
use src\Posts\Domain\Queries\GetPaginatedPost;
use src\Posts\Domain\Queries\GetPost;
use src\Posts\Application\Queries\GetPaginatedPostHandler;
use src\Posts\Application\Queries\GetPostHandler;
use src\Posts\Domain\Repositories\PostRepositoryInterface;
use src\Posts\Domain\Repositories\TagRepositoryInterface;
use src\Posts\Infrastructure\Eloquent\Repositories\EloquentPostRepository;
use src\Posts\Infrastructure\Eloquent\Repositories\EloquentTagRepository;

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
