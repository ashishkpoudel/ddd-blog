<?php

namespace Weblog\Users;

use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Weblog\Users\Domain\Queries\GetUserAuthTokenByEmail;
use Weblog\Users\Application\QueryHandlers\GetUserAuthTokenByEmailHandler;
use Weblog\Users\Domain\Repositories\UserRepository;
use Weblog\Users\Infrastructure\Eloquent\Repositories\EloquentUserRepository;

final class UserServiceProvider extends ServiceProvider
{
    private array $queries = [
        GetUserAuthTokenByEmail::class => GetUserAuthTokenByEmailHandler::class
    ];

    public function boot()
    {
        Bus::map($this->queries);

        Route::prefix('api')->middleware('api')->group(base_path('src/Users/Infrastructure/routes.php'));
    }

    public function register()
    {
        $this->app->bind(UserRepository::class, EloquentUserRepository::class);
    }
}
