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

// Secure deployment endpoint for admin panel frontend extraction
Route::get('/extract-admin', function (\Illuminate\Http\Request $request) {
    if ($request->query('key') !== 'universal_paints_deploy_secure_key_2026') {
        return response()->json(['error' => 'Forbidden'], 403);
    }

    $candidates = [
        base_path('admin.zip'),
        public_path('admin.zip'),
        dirname(base_path()) . '/admin.zip'
    ];

    $zipFile = null;
    foreach ($candidates as $cand) {
        if (file_exists($cand)) {
            $zipFile = $cand;
            break;
        }
    }

    if (!$zipFile) {
        return response()->json([
            'status' => 'error',
            'message' => 'admin.zip not found in candidates: ' . implode(', ', $candidates)
        ], 404);
    }

    if (!class_exists('ZipArchive')) {
        return response()->json(['error' => 'ZipArchive extension missing'], 500);
    }

    $targets = [
        base_path('admin'),
        public_path('admin')
    ];

    $extracted = [];
    foreach ($targets as $targetDir) {
        if (!is_dir($targetDir)) {
            @mkdir($targetDir, 0755, true);
        }
        $zip = new \ZipArchive;
        if ($zip->open($zipFile) === true) {
            $zip->extractTo($targetDir);
            $zip->close();
            $extracted[] = $targetDir;
        }
    }

    @unlink($zipFile);

    return response()->json([
        'status' => 'SUCCESS',
        'message' => 'Admin extracted successfully to ' . implode(' and ', $extracted)
    ]);
});

// Graceful fallback for clients calling with double /api prefix (e.g. /api/api/...)
Route::prefix('api')->group(function () {
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{id}', [CategoryController::class, 'show']);
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{product}', [ProductController::class, 'show']);
    Route::get('/sales-reps', [\App\Http\Controllers\API\SalesRepresentativeController::class, 'index']);
    Route::get('/sales-reps/{id}', [\App\Http\Controllers\API\SalesRepresentativeController::class, 'show']);
    Route::get('/blogs', [\App\Http\Controllers\API\BlogController::class, 'index']);
    Route::get('/blogs/{slug}', [\App\Http\Controllers\API\BlogController::class, 'show']);
});

