<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\StoresController;
use App\Http\Controllers\ProductsCategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\StoreReviewsController;
use App\Http\Controllers\UsersController;

Route::prefix('/auth')->name('auth.')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::prefix('/stores')->name('stores.')->controller(StoresController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/count', 'count')->name('count');
    Route::post('/', 'store')->name('store')->middleware('auth:sanctum');
    Route::get('/{store}', 'show')->name('show');
    Route::put('/{store}', 'update')->name('update')->middleware('auth:sanctum');
    Route::delete('/{store}', 'destroy')->name('destroy')->middleware('auth:sanctum');
});

Route::prefix('/products')->name('products.')->controller(ProductsController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/', 'store')->name('store')->middleware('auth:sanctum');
    Route::post('/{product}/images', 'createImage')->name('createImage')->middleware('auth:sanctum');
    Route::get('/{product}', 'show')->name('show');
    Route::put('/{product}', 'update')->name('update')->middleware('auth:sanctum');
    Route::delete('/{product}/images/{id}', 'deleteImage')->name('deleteImage')->middleware('auth:sanctum');
});

Route::prefix('/product-categories')->name('productCategories.')->controller(ProductsCategoriesController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/', 'store')->name('store')->middleware('auth:sanctum');
    Route::get('/{category}', 'show')->name('show');
    Route::put('/{category}', 'update')->name('update')->middleware('auth:sanctum');
    Route::delete('/{category}', 'destroy')->name('destroy')->middleware('auth:sanctum');
});

Route::prefix('/store-reviews')->name('storeReviews.')->group(function () {
    Route::post('/', [StoreReviewsController::class, 'store']);
    Route::get('/count', [StoreReviewsController::class, 'count']);
});

Route::prefix('/users')->name('users.')->controller(UsersController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/count', 'count')->name('count');
    Route::post('/', 'store')->name('store');
    Route::get('/{user}', 'show')->name('show');
    Route::put('/{user}', 'update')->name('update');
    Route::delete('/{user}', 'destroy')->name('destroy');
});
