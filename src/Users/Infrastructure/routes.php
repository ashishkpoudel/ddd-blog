<?php

use Illuminate\Support\Facades\Route;

Route::post('login', \Weblog\Users\Infrastructure\Controllers\UserLoginController::class);
