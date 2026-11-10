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
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\CategoryController;

Route::post('/login', [AuthController::class, 'login']);

Route::get('/debug-users', function () {
    return response()->json([
        'users_count' => \App\Models\User::count(),
        'admin_exists' => \App\Models\User::where('email', 'admin@universalpaints.lk')->exists(),
    ]);
});

Route::get('/run-migrate', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
        return response()->json([
            'status' => 'success',
            'message' => 'Migrations executed successfully!',
            'output' => \Illuminate\Support\Facades\Artisan::output(),
        ]);
    } catch (\Throwable $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage(),
        ], 500);
    }
});

Route::get('/run-seed', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'AdminSeeder', '--force' => true]);
        return response()->json([
            'status' => 'success',
            'message' => 'AdminSeeder ran successfully!',
            'output' => \Illuminate\Support\Facades\Artisan::output(),
            'users_count' => \App\Models\User::count(),
            'admin_exists' => \App\Models\User::where('email', 'admin@universalpaints.lk')->exists(),
        ]);
    } catch (\Throwable $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage(),
        ], 500);
    }
});

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

    // Protected user management routes (Admin)
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::put('/users/{user}', [UserController::class, 'update']);
    Route::delete('/users/{user}', [UserController::class, 'destroy']);

    // Protected category routes (Admin)
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::post('/categories/{id}', [CategoryController::class, 'update']);
    Route::put('/categories/{id}', [CategoryController::class, 'update']);
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

    // Direct Cloudflare R2 file upload/delete (Admin)
    Route::post('/upload', [\App\Http\Controllers\API\UploadController::class, 'upload']);
    Route::delete('/upload', [\App\Http\Controllers\API\UploadController::class, 'destroy']);

    // Protected Sales Representatives routes (Admin)
    Route::post('/sales-reps', [\App\Http\Controllers\API\SalesRepresentativeController::class, 'store']);
    Route::post('/sales-reps/{id}', [\App\Http\Controllers\API\SalesRepresentativeController::class, 'update']);
    Route::put('/sales-reps/{id}', [\App\Http\Controllers\API\SalesRepresentativeController::class, 'update']);
    Route::delete('/sales-reps/{id}', [\App\Http\Controllers\API\SalesRepresentativeController::class, 'destroy']);
});

// Public Sales Representatives routes (Read)
Route::get('/sales-reps', [\App\Http\Controllers\API\SalesRepresentativeController::class, 'index']);
Route::get('/sales-reps/{id}', [\App\Http\Controllers\API\SalesRepresentativeController::class, 'show']);

// Public category routes (Read)
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{id}', [CategoryController::class, 'show']);

// Public product routes (Read)
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);

// Public order route
Route::post('/orders', [OrderController::class, 'store']);

// Public blog routes (Read)
Route::get('/blogs', [\App\Http\Controllers\API\BlogController::class, 'index']);
Route::get('/blogs/{slug}', [\App\Http\Controllers\API\BlogController::class, 'show']);

