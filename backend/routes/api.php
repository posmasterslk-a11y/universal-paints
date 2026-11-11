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

// Secure endpoint to optimize existing uncompressed images in DB to WebP
Route::get('/optimize-legacy-images', function (\Illuminate\Http\Request $request) {
    if ($request->query('key') !== 'universal_paints_deploy_secure_key_2026') {
        return response()->json(['error' => 'Forbidden'], 403);
    }

    $results = [
        'categories' => [],
        'products' => [],
    ];

    $optimizeUrl = function ($url, $folder) {
        if (!$url || !is_string($url) || !str_contains($url, '.png')) {
            return null;
        }

        try {
            $ctx = stream_context_create([
                'http' => ['timeout' => 20],
                'ssl' => ['verify_peer' => false, 'verify_peer_name' => false]
            ]);
            $contents = @file_get_contents($url, false, $ctx);
            if (!$contents) return null;

            $src = @imagecreatefromstring($contents);
            if (!$src) return null;

            $origW = imagesx($src);
            $origH = imagesy($src);
            if ($origW <= 0 || $origH <= 0) {
                imagedestroy($src);
                return null;
            }

            $maxW = 1600;
            $newW = $origW;
            $newH = $origH;
            if ($newW > $maxW || $newH > $maxW) {
                $ratio = min($maxW / $newW, $maxW / $newH);
                $newW = (int) round($newW * $ratio);
                $newH = (int) round($newH * $ratio);
            }

            $dst = imagecreatetruecolor($newW, $newH);
            imagealphablending($dst, false);
            imagesavealpha($dst, true);
            $transparent = imagecolorallocatealpha($dst, 255, 255, 255, 127);
            imagefilledrectangle($dst, 0, 0, $newW, $newH, $transparent);
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $newW, $newH, $origW, $origH);
            imagedestroy($src);

            ob_start();
            if (function_exists('imagewebp')) {
                imagewebp($dst, null, 80);
            } else {
                imagejpeg($dst, null, 85);
            }
            $webpData = ob_get_clean();
            imagedestroy($dst);

            if (!$webpData) return null;

            $filename = \Illuminate\Support\Str::random(40) . '.webp';
            $path = rtrim($folder, '/') . '/' . $filename;
            \Illuminate\Support\Facades\Storage::disk('r2')->put($path, $webpData, [
                'mimetype' => 'image/webp'
            ]);

            return \Illuminate\Support\Facades\Storage::disk('r2')->url($path);
        } catch (\Throwable $e) {
            return null;
        }
    };

    // 1. Categories
    $categories = \App\Models\Category::all();
    foreach ($categories as $cat) {
        if ($cat->image && str_contains($cat->image, '.png')) {
            $newUrl = $optimizeUrl($cat->image, 'categories');
            if ($newUrl) {
                $old = $cat->image;
                $cat->image = $newUrl;
                $cat->save();
                $results['categories'][] = [
                    'id' => $cat->id,
                    'name' => $cat->name,
                    'old' => $old,
                    'new' => $newUrl
                ];
            }
        }
    }

    // 2. Products
    $products = \App\Models\Product::all();
    foreach ($products as $prod) {
        if ($prod->main_image && str_contains($prod->main_image, '.png')) {
            $newUrl = $optimizeUrl($prod->main_image, 'products');
            if ($newUrl) {
                $old = $prod->main_image;
                $prod->main_image = $newUrl;
                $prod->save();
                $results['products'][] = [
                    'id' => $prod->id,
                    'name' => $prod->name,
                    'old' => $old,
                    'new' => $newUrl
                ];
            }
        }
    }

    return response()->json([
        'status' => 'SUCCESS',
        'message' => 'Legacy images optimized to lightweight WebP',
        'details' => $results
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

