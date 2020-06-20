<?php

namespace src\Users;

use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use src\Users\Domain\Queries\GetUserAuthTokenByEmail;
use src\Users\Application\QueryHandlers\GetUserAuthTokenByEmailHandler;
use src\Users\Domain\Repositories\UserRepositoryInterface;
use src\Users\Infrastructure\Eloquent\Repositories\EloquentUserRepository;

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
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
    }
}
