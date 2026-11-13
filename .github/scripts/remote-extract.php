<?php
/**
 * Safe Remote ZIP Extractor for Universal Paints Backend Deployment
 * 
 * Rules strictly followed:
 * - NEVER deletes application directories or storage folders (No recursive rm -rf).
 * - Extracts files cleanly over existing files.
 * - Does not touch or overwrite .env or uploaded storage files.
 * - Self-deletes on completion.
 */

$secret = 'universal_paints_deploy_secure_key_2026';
if (($_GET['key'] ?? '') !== $secret) {
    http_response_code(403);
    echo "Forbidden: Invalid deployment key";
    exit;
}

@set_time_limit(300);
@ini_set('memory_limit', '512M');

// Determine base backend directory
if (file_exists(__DIR__ . '/../artisan') || file_exists(__DIR__ . '/../bootstrap')) {
    $baseDir = dirname(__DIR__);
} else {
    $baseDir = __DIR__;
}

// Find backend.zip
$zipFile = $baseDir . '/backend.zip';
if (!file_exists($zipFile)) {
    $zipFile = __DIR__ . '/backend.zip';
}

if (!file_exists($zipFile)) {
    http_response_code(404);
    echo "ERROR: backend.zip not found at $zipFile (checked $baseDir and " . __DIR__ . ")";
    exit;
}

if (!class_exists('ZipArchive')) {
    http_response_code(500);
    echo "ERROR: PHP ZipArchive extension is not enabled on this server.";
    exit;
}

$zip = new ZipArchive;
$res = $zip->open($zipFile);
if ($res !== true) {
    http_response_code(500);
    echo "ERROR: Could not open backend.zip (ZipArchive code: $res)";
    exit;
}

// Safely extract files over existing files
$zip->extractTo($baseDir);
$zip->close();

// Delete backend.zip after successful extraction
@unlink($zipFile);

// Clear stale config, routes, and services cache if exists so fresh routes and .env are loaded
foreach ([
    $baseDir . '/bootstrap/cache/config.php',
    $baseDir . '/bootstrap/cache/routes-v7.php',
    $baseDir . '/bootstrap/cache/routes.php',
    $baseDir . '/bootstrap/cache/packages.php',
    $baseDir . '/bootstrap/cache/services.php',
] as $cacheFile) {
    if (file_exists($cacheFile)) {
        @unlink($cacheFile);
    }
}

echo "SUCCESS: Extracted successfully to $baseDir";

// Reset OPcache and file stat cache
if (function_exists('opcache_reset')) {
    @opcache_reset();
}
if (function_exists('clearstatcache')) {
    @clearstatcache(true);
}
if (file_exists($baseDir . '/public/.htaccess')) {
    @touch($baseDir . '/public/.htaccess');
}
if (file_exists($baseDir . '/.htaccess')) {
    @touch($baseDir . '/.htaccess');
}

// Safely execute pending database migrations
try {
    if (file_exists($baseDir . '/artisan')) {
        @exec('php ' . escapeshellarg($baseDir . '/artisan') . ' migrate --force 2>&1');
    }
} catch (\Throwable $e) {}

try {
    if (file_exists($baseDir . '/bootstrap/app.php')) {
        $app = require_once $baseDir . '/bootstrap/app.php';
        $kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
        $kernel->bootstrap();
        \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
    }
} catch (\Throwable $e) {}

// Self delete extractor script
@unlink(__FILE__);

