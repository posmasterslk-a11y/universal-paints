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

// Clear stale config cache if exists so fresh .env is loaded
$cachedConfig = $baseDir . '/bootstrap/cache/config.php';
if (file_exists($cachedConfig)) {
    @unlink($cachedConfig);
}

echo "SUCCESS: Extracted successfully to $baseDir";

// Self delete extractor script
@unlink(__FILE__);
