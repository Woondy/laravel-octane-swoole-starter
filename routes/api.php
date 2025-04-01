<?php

use App\Http\Controllers\Api\V1\AccountController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    // Account routes
    Route::prefix('accounts')->group(function () {
        Route::post('/create', [AccountController::class, 'store']);
        Route::get('/user/{user_id}', [AccountController::class, 'show']);
        Route::get('/user/{user_id}/balance', [AccountController::class, 'getBalance']);
    });
});