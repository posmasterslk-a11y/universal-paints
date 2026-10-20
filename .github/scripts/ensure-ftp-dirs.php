<?php

$server = getenv('BACKEND_FTP_SERVER');
$user = getenv('BACKEND_FTP_USERNAME');
$pass = getenv('BACKEND_FTP_PASSWORD');
$targetDirRaw = getenv('BACKEND_FTP_TARGET_DIR');

if (!$server || !$user || !$pass) {
    echo "FTP credentials not provided. Skipping pre-deployment check.\n";
    exit(0);
}

$targetDir = '';
if (!empty($targetDirRaw) && $targetDirRaw !== '/' && $targetDirRaw !== './') {
    $targetDir = rtrim($targetDirRaw, '/') . '/';
}

echo "Connecting to FTP server: $server ...\n";
$conn = @ftp_connect($server, 21, 30);
if (!$conn) {
    echo "Warning: Could not connect to FTP server $server via standard port. Proceeding to main action.\n";
    exit(0);
}

if (!@ftp_login($conn, $user, $pass)) {
    echo "Warning: FTP login failed for user $user. Proceeding to main action.\n";
    @ftp_close($conn);
    exit(0);
}

@ftp_pasv($conn, true);

// Remove stale/corrupted sync-state files if present to force FTP action to re-verify directories
$stateFiles = [
    $targetDir . '.ftp-deploy-sync-state.json',
    $targetDir . '.sync-state.json',
];

foreach ($stateFiles as $file) {
    if (@ftp_delete($conn, $file)) {
        echo "Removed stale state file: $file\n";
    }
}

// Essential directories to guarantee exist on the remote server
$essentialDirs = [
    'app',
    'app/Console',
    'app/Exceptions',
    'app/Http',
    'app/Http/Controllers',
    'app/Http/Controllers/API',
    'app/Http/Middleware',
    'app/Models',
    'app/Providers',
    'bootstrap',
    'bootstrap/cache',
    'config',
    'database',
    'database/factories',
    'database/migrations',
    'database/seeders',
    'public',
    'resources',
    'routes',
    'storage',
    'storage/app',
    'storage/app/public',
    'storage/framework',
    'storage/framework/cache',
    'storage/framework/cache/data',
    'storage/framework/sessions',
    'storage/framework/views',
    'storage/logs',
];

// Dynamically discover any subdirectories under backend/app
$backendDir = realpath(__DIR__ . '/../../backend');
if ($backendDir && is_dir($backendDir . '/app')) {
    $appDir = realpath($backendDir . '/app');
    $appDirNorm = str_replace('\\', '/', $appDir);
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($appDir, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    );
    foreach ($iterator as $item) {
        if ($item->isDir()) {
            $fullPath = str_replace('\\', '/', $item->getPathname());
            $rel = ltrim(substr($fullPath, strlen($appDirNorm)), '/');
            if (!empty($rel)) {
                $essentialDirs[] = 'app/' . $rel;
            }
        }
    }
}

$essentialDirs = array_unique($essentialDirs);

$created = 0;
foreach ($essentialDirs as $dir) {
    $parts = explode('/', trim($dir, '/'));
    $current = $targetDir;
    foreach ($parts as $part) {
        $current .= $part . '/';
        $remotePath = rtrim($current, '/');
        if (@ftp_mkdir($conn, $remotePath)) {
            $created++;
        }
    }
}

echo "Remote directory pre-check completed. Ensured " . count($essentialDirs) . " directories exist.\n";
@ftp_close($conn);
