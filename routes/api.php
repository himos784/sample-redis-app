<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::group(['prefix' => 'users'], function() {
    Route::get('/', [UserController::class, 'index']);

    Route::post('/', [UserController::class, 'store']);

    Route::group(['prefix' => '/{id}', 'middleware' => 'user-exist'], function() {
        Route::get('/', [UserController::class, 'show']);
        Route::put('/', [UserController::class, 'update']);
        Route::delete('/', [UserController::class, 'destroy']);
    });
});
