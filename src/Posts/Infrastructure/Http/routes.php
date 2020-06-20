<?php

use Illuminate\Support\Facades\Route;

Route::middleware('jwt.auth')->group(function () {
    Route::get('posts', src\Posts\Infrastructure\Http\Controllers\GetPostsController::class);
    Route::post('posts', src\Posts\Infrastructure\Http\Controllers\CreatePostController::class);
    Route::patch('posts/{post}', src\Posts\Infrastructure\Http\Controllers\DeletePostController::class);
    Route::delete('posts/{post}', src\Posts\Infrastructure\Http\Controllers\DeletePostController::class);
});
