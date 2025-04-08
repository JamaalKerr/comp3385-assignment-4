<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\AuthController;

Route::post('/api/v1/login', [AuthController::class, 'login'])->name('login');
Route::post('/api/v1/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth:api')->group(function () {
    Route::get('/api/v1/user', function (Request $request) {
        return response()->json($request->user());
    });

    Route::get('/api/v1/movies', [MovieController::class, 'index']); // Fetch all movies
    Route::post('/api/v1/movies', [MovieController::class, 'store']); // Create a new movie
});
