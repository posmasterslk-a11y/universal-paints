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
    Route::get('/blogs/{id}', [\App\Http\Controllers\API\BlogController::class, 'show']);
    Route::post('/blogs', [\App\Http\Controllers\API\BlogController::class, 'store']);
    Route::post('/blogs/{id}', [\App\Http\Controllers\API\BlogController::class, 'update']);
    Route::put('/blogs/{id}', [\App\Http\Controllers\API\BlogController::class, 'update']);
    Route::delete('/blogs/{id}', [\App\Http\Controllers\API\BlogController::class, 'destroy']);

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
Route::get('/products/{identifier}', [ProductController::class, 'show']);

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

// Secure endpoint to run pending database migrations safely in-process via Artisan
Route::get('/run-migrations', function (\Illuminate\Http\Request $request) {
    if ($request->query('key') !== 'universal_paints_deploy_secure_key_2026') {
        return response()->json(['error' => 'Forbidden'], 403);
    }

    $logs = [];

    // 1. Ensure category column exists in blogs table immediately
    try {
        if (\Illuminate\Support\Facades\Schema::hasTable('blogs')) {
            if (!\Illuminate\Support\Facades\Schema::hasColumn('blogs', 'category')) {
                \Illuminate\Support\Facades\Schema::table('blogs', function ($table) {
                    $table->string('category', 100)->nullable()->after('title');
                });
                $logs[] = "Added 'category' column to 'blogs' table.";
            } else {
                $logs[] = "'category' column already exists in 'blogs' table.";
            }
        }
    } catch (\Throwable $e) {
        $logs[] = "Schema alter error: " . $e->getMessage();
    }

    // 2. Register baseline migrations in migrations table if physical tables already exist
    try {
        if (\Illuminate\Support\Facades\Schema::hasTable('migrations')) {
            $existing = \Illuminate\Support\Facades\DB::table('migrations')->pluck('migration')->toArray();
            $batch = (\Illuminate\Support\Facades\DB::table('migrations')->max('batch') ?? 0) + 1;

            $tableMigrationMap = [
                'users' => '2014_10_12_000000_create_users_table',
                'password_resets' => '2014_10_12_100000_create_password_resets_table',
                'failed_jobs' => '2019_08_19_000000_create_failed_jobs_table',
                'personal_access_tokens' => '2019_12_14_000001_create_personal_access_tokens_table',
                'products' => '2026_08_15_073122_create_products_table',
                'orders' => '2026_08_15_073130_create_orders_table',
                'order_items' => '2026_08_15_175605_create_order_items_table',
                'blogs' => '2026_09_21_105018_create_blogs_table',
                'categories' => '2026_10_20_000000_create_categories_table',
                'sales_representatives' => '2026_11_10_060000_create_sales_representatives_table',
            ];

            foreach ($tableMigrationMap as $table => $migrationName) {
                if (\Illuminate\Support\Facades\Schema::hasTable($table) && !in_array($migrationName, $existing)) {
                    \Illuminate\Support\Facades\DB::table('migrations')->insert([
                        'migration' => $migrationName,
                        'batch' => $batch
                    ]);
                    $logs[] = "Registered existing migration: $migrationName";
                }
            }
        }
    } catch (\Throwable $e) {
        $logs[] = "Migration table sync warning: " . $e->getMessage();
    }

    // 3. Run pending migrations safely
    try {
        \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
        $artisanOutput = \Illuminate\Support\Facades\Artisan::output();
        $logs[] = "Artisan migrate: " . trim($artisanOutput);
    } catch (\Throwable $e) {
        $logs[] = "Artisan migrate error: " . $e->getMessage();
    }

    return response()->json([
        'status' => 'SUCCESS',
        'logs' => $logs
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
    Route::get('/products/{identifier}', [ProductController::class, 'show']);
    Route::get('/sales-reps', [\App\Http\Controllers\API\SalesRepresentativeController::class, 'index']);
    Route::get('/sales-reps/{id}', [\App\Http\Controllers\API\SalesRepresentativeController::class, 'show']);
    Route::get('/blogs', [\App\Http\Controllers\API\BlogController::class, 'index']);
    Route::get('/blogs/{slug}', [\App\Http\Controllers\API\BlogController::class, 'show']);
});

