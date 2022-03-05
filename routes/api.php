<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\StoresController;
use App\Http\Controllers\StoreReviewsController;
use App\Http\Controllers\UsersController;

Route::prefix('/auth')->name('auth.')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::prefix('/stores')->name('stores.')->group(function() {
    Route::get('/', [StoresController::class, 'index'])->name('index');
    Route::post('/', [StoresController::class, 'store'])->name('store')->middleware('auth:sanctum');
    Route::get('/{store}', [StoresController::class, 'show'])->name('show');
    Route::put('/{store}', [StoresController::class, 'update'])->name('update')->middleware('auth:sanctum');
    Route::delete('/{store}', [StoresController::class, 'destroy'])->name('destroy')->middleware('auth:sanctum');
});

Route::prefix('/store-reviews')->name('storeReviews.')->group(function() {
    Route::post('/', [StoreReviewsController::class, 'store']);
    Route::get('/count', [StoreReviewsController::class, 'count']);
});

Route::prefix('/users')->name('users.')->middleware('auth:sanctum')->group(function() {
    Route::get('/', [UsersController::class, 'index'])->name('index');
    Route::post('/', [UsersController::class, 'store'])->name('store');
    Route::get('/{user}', [UsersController::class, 'show'])->name('show');
    Route::put('/{user}', [UsersController::class, 'update'])->name('update');
    Route::delete('/{user}', [UsersController::class, 'destroy'])->name('destroy');
});