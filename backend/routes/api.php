<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\OrderController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // Protected product routes (Create, Update, Delete)
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{product}', [ProductController::class, 'update']);
    Route::delete('/products/{product}', [ProductController::class, 'destroy']);

    // Protected order routes (Admin)
    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('/orders/{order}', [OrderController::class, 'show']);
    Route::put('/orders/{order}/status', [OrderController::class, 'updateStatus']);

    // Protected blog routes (Admin)
    Route::post('/blogs', [\App\Http\Controllers\API\BlogController::class, 'store']);
    Route::put('/blogs/{blog}', [\App\Http\Controllers\API\BlogController::class, 'update']);
    Route::delete('/blogs/{blog}', [\App\Http\Controllers\API\BlogController::class, 'destroy']);
});

// Public product routes (Read)
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);

// Public order route
Route::post('/orders', [OrderController::class, 'store']);

// Public blog routes (Read)
Route::get('/blogs', [\App\Http\Controllers\API\BlogController::class, 'index']);
Route::get('/blogs/{slug}', [\App\Http\Controllers\API\BlogController::class, 'show']);

