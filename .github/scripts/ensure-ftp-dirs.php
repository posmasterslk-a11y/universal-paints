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

// Recursively ensure all essential local backend directories exist on remote FTP server
$backendDir = realpath(__DIR__ . '/../../backend');
if (!$backendDir || !is_dir($backendDir)) {
    $backendDir = getcwd();
}

echo "Scanning local backend directories in: $backendDir ...\n";
$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($backendDir, RecursiveDirectoryIterator::SKIP_DOTS),
    RecursiveIteratorIterator::SELF_FIRST
);

$created = 0;
foreach ($iterator as $item) {
    if ($item->isDir()) {
        $relPath = str_replace('\\', '/', $item->getSubPathname());
        if (preg_match('#^(\.git|vendor|node_modules|storage/logs|tests)#', $relPath)) {
            continue;
        }

        // Split path to create parent directories sequentially
        $parts = explode('/', trim($relPath, '/'));
        $current = $targetDir;
        foreach ($parts as $part) {
            $current .= $part . '/';
            $remotePath = rtrim($current, '/');
            if (@ftp_mkdir($conn, $remotePath)) {
                $created++;
            }
        }
    }
}

echo "Remote directory pre-check completed. Created/verified directories.\n";
@ftp_close($conn);
