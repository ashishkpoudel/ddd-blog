<?php

use Illuminate\Support\Facades\Route;

Route::post('login', \src\Users\Infrastructure\Controllers\UserLoginController::class);
