<?php

use Illuminate\Support\Facades\Route;

Route::middleware('jwt.auth')->group(function () {
    Route::get('posts', Weblog\Posts\Infrastructure\Http\Controllers\GetPostsController::class);
    Route::get('posts/{post}', Weblog\Posts\Infrastructure\Http\Controllers\GetPostController::class);
    Route::post('posts', Weblog\Posts\Infrastructure\Http\Controllers\CreatePostController::class);
    Route::patch('posts/{post}', Weblog\Posts\Infrastructure\Http\Controllers\DeletePostController::class);
    Route::delete('posts/{post}', Weblog\Posts\Infrastructure\Http\Controllers\DeletePostController::class);
});
