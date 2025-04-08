<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\AuthController;

// ✅ Authentication routes remain public
Route::post('/v1/login', [AuthController::class, 'login'])->name('login');
Route::post('/v1/logout', [AuthController::class, 'logout'])->name('logout');

// ✅ Movie routes are protected with JWT authentication
Route::middleware('auth:api')->group(function () {
    Route::get('/v1/user', function (Request $request) {
        return response()->json($request->user());
    });

    Route::get('/v1/movies', [MovieController::class, 'index']); // ✅ Fetch all movies
    Route::post('/v1/movies', [MovieController::class, 'store']); // ✅ Create a new movie
});
