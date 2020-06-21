<?php

namespace Weblog\Users\Infrastructure\Controllers;

use Weblog\Core\Http\Controllers\BaseController;
use Weblog\Core\Http\Response\OkResponse;
use Weblog\Core\Http\Response\UnauthorizedResponse;
use Weblog\Users\Infrastructure\Requests\LoginRequest;
use Weblog\Users\Domain\Queries\GetUserAuthTokenByEmail;
use Weblog\Users\Application\Services\AuthService;

final class UserLoginController extends BaseController
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
