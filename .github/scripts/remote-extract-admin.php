<?php
/**
 * Safe Remote ZIP Extractor for Universal Paints Admin Frontend Deployment
 */

$secret = 'universal_paints_deploy_secure_key_2026';
if (($_GET['key'] ?? '') !== $secret) {
    http_response_code(403);
    echo "Forbidden: Invalid deployment key";
    exit;
}

@set_time_limit(300);
@ini_set('memory_limit', '512M');

if (file_exists(__DIR__ . '/../artisan') || file_exists(__DIR__ . '/../bootstrap')) {
    $baseDir = dirname(__DIR__);
} else {
    $baseDir = __DIR__;
}

$zipCandidates = [
    $baseDir . '/admin.zip',
    __DIR__ . '/admin.zip',
    $baseDir . '/public/admin.zip'
];

$zipFile = null;
foreach ($zipCandidates as $cand) {
    if (file_exists($cand)) {
        $zipFile = $cand;
        break;
    }
}

if (!$zipFile) {
    http_response_code(404);
    echo "ERROR: admin.zip not found (checked " . implode(', ', $zipCandidates) . ")";
    exit;
}

if (!class_exists('ZipArchive')) {
    http_response_code(500);
    echo "ERROR: PHP ZipArchive extension is not enabled.";
    exit;
}

$targetDir = $baseDir . '/admin';
if (!is_dir($targetDir)) {
    @mkdir($targetDir, 0755, true);
}

$zip = new ZipArchive;
$res = $zip->open($zipFile);
if ($res !== true) {
    http_response_code(500);
    echo "ERROR: Could not open admin.zip ($res)";
    exit;
}

$zip->extractTo($targetDir);
$zip->close();
@unlink($zipFile);

echo "SUCCESS: Admin extracted successfully to $targetDir";
@unlink(__FILE__);
