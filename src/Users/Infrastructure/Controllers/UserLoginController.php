<?php

namespace src\Users\Infrastructure\Controllers;

use src\Core\Http\Controllers\BaseController;
use src\Core\Http\Response\OkResponse;
use src\Core\Http\Response\UnauthorizedResponse;
use src\Users\Infrastructure\Requests\LoginRequest;
use src\Users\Domain\Queries\GetUserAuthTokenByEmail;
use src\Users\Application\Services\AuthService;

class UserLoginController extends BaseController
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function __invoke(LoginRequest $request)
    {
        if ($this->authService->tryLogin($request->input('emailAddress'), $request->input('password'))) {
            $authTokenData =  $this->queryBus()->query(
                new GetUserAuthTokenByEmail(
                    $request->input('emailAddress')
                )
            );

            return new OkResponse(
                $authTokenData
            );
        }

        return new UnauthorizedResponse(
            'Unauthorized login attempt'
        );
    }
}
