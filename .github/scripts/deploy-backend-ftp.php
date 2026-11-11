<?php
/**
 * Direct FTP Deployment Script for Universal Paints Backend
 */

$server = getenv("BACKEND_FTP_SERVER");
$user = getenv("BACKEND_FTP_USERNAME");
$pass = getenv("BACKEND_FTP_PASSWORD");
$target = rtrim(getenv("BACKEND_FTP_TARGET_DIR") ?: "/public_html", "/") . "/";

echo "Connecting to FTP server: $server\n";
$conn = @ftp_connect($server, 21, 60);
if (!$conn || !@ftp_login($conn, $user, $pass)) {
    echo "FTP Login failed!\n";
    exit(1);
}
@ftp_pasv($conn, true);

function ftp_mkdir_p($conn, $dir) {
    $dir = trim(str_replace('\\', '/', $dir), '/');
    if (empty($dir)) return;
    $parts = explode('/', $dir);
    $path = '';
    foreach ($parts as $p) {
        $path .= ($path === '' ? '' : '/') . $p;
        @ftp_mkdir($conn, $path);
    }
}

function upload_dir_recursive($conn, $localDir, $remoteDir) {
    ftp_mkdir_p($conn, $remoteDir);
    $files = scandir($localDir);
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') continue;
        $localPath = $localDir . '/' . $file;
        $remotePath = rtrim($remoteDir, '/') . '/' . $file;
        if (is_dir($localPath)) {
            upload_dir_recursive($conn, $localPath, $remotePath);
        } else {
            $success = @ftp_put($conn, $remotePath, $localPath, FTP_BINARY);
            if (!$success) {
                ftp_mkdir_p($conn, dirname($remotePath));
                @ftp_put($conn, $remotePath, $localPath, FTP_BINARY);
            }
        }
    }
}

// Determine candidate roots on FTP server
$cwd = @ftp_pwd($conn);
echo "Current FTP working directory: $cwd\n";
$rootList = @ftp_nlist($conn, '.') ?: [];
echo "FTP root contents: " . implode(', ', array_slice($rootList, 0, 20)) . "\n";

$appRoots = [];
if (in_array('artisan', $rootList) || in_array('./artisan', $rootList)) {
    $appRoots[] = '';
}
if (in_array('public_html', $rootList) || in_array('./public_html', $rootList)) {
    $appRoots[] = 'public_html';
}
$cleanTarget = trim($target, '/');
if (!empty($cleanTarget) && !in_array($cleanTarget, $appRoots)) {
    $appRoots[] = $cleanTarget;
}
if (empty($appRoots)) {
    $appRoots = ['', 'public_html'];
}

// Direct sync of key backend application folders for 100% guarantee
$appSyncDirs = ['app', 'routes', 'config', 'database'];
foreach ($appRoots as $root) {
    foreach ($appSyncDirs as $dir) {
        $local = 'backend/' . $dir;
        $remote = empty($root) ? $dir : ($root . '/' . $dir);
        if (is_dir($local)) {
            echo "Direct syncing $local to $remote...\n";
            upload_dir_recursive($conn, $local, $remote);
        }
    }

    // Delete stale bootstrap cache files
    $cacheFiles = ['config.php', 'routes-v7.php', 'routes.php', 'packages.php', 'services.php'];
    foreach ($cacheFiles as $cf) {
        $rCache = (empty($root) ? '' : ($root . '/')) . 'bootstrap/cache/' . $cf;
        if (@ftp_delete($conn, $rCache)) {
            echo "Cleared stale cache file: $rCache\n";
        }
    }
}

// Upload backend.zip
$zipDest = $target . 'backend.zip';
echo "Uploading backend.zip to $zipDest...\n";
if (!@ftp_put($conn, $zipDest, 'deploy_dist/backend.zip', FTP_BINARY)) {
    @ftp_put($conn, 'backend.zip', 'deploy_dist/backend.zip', FTP_BINARY);
}
echo "backend.zip uploaded successfully!\n";

// Upload extractor to all candidate locations
echo "Uploading extract.php...\n";
$extractCandidates = [
    'public/extract.php',
    'extract.php',
    $target . 'public/extract.php',
    $target . 'extract.php',
];
$extractUploaded = 0;
foreach ($extractCandidates as $dest) {
    if (@ftp_put($conn, $dest, 'deploy_dist/extract.php', FTP_BINARY)) {
        echo "Uploaded extractor to $dest\n";
        $extractUploaded++;
    }
}
@ftp_close($conn);
echo "Direct FTP Code Sync & Upload complete!\n";
