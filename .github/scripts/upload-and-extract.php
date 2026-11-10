<?php
/**
 * Fast & Resilient FTP ZIP Uploader and Trigger for Backend Deployment
 */

$server = getenv('BACKEND_FTP_SERVER');
$user = getenv('BACKEND_FTP_USERNAME');
$pass = getenv('BACKEND_FTP_PASSWORD');
$targetDirRaw = getenv('BACKEND_FTP_TARGET_DIR');
$secret = 'universal_paints_deploy_secure_key_2026';

if (!$server || !$user || !$pass) {
    echo "ERROR: FTP credentials not provided in environment variables.\n";
    exit(1);
}

$targetDir = '';
if (!empty($targetDirRaw) && $targetDirRaw !== '/' && $targetDirRaw !== './') {
    $targetDir = rtrim($targetDirRaw, '/') . '/';
}

echo "🔌 Connecting to FTP: $server (target dir: '$targetDir') ...\n";
$conn = ftp_connect($server, 21, 90);
if (!$conn) {
    echo "ERROR: Could not connect to FTP server $server on port 21.\n";
    exit(1);
}

if (!ftp_login($conn, $user, $pass)) {
    echo "ERROR: FTP login failed for user: $user\n";
    ftp_close($conn);
    exit(1);
}

ftp_pasv($conn, true);
echo "✅ Logged in to FTP successfully (Passive mode enabled).\n";

// Verify remote directory
$list = ftp_nlist($conn, $targetDir ?: '.');
if ($list === false) {
    echo "⚠️ Warning: Could not list files in target directory '$targetDir'. Attempting to create...\n";
    @ftp_mkdir($conn, rtrim($targetDir, '/'));
} else {
    echo "📁 Target directory contents count: " . count($list) . " items found.\n";
}

$localZip = realpath(__DIR__ . '/../../backend.zip');
if (!$localZip || !file_exists($localZip)) {
    echo "ERROR: Local backend.zip not found at $localZip\n";
    ftp_close($conn);
    exit(1);
}

$zipSizeMb = round(filesize($localZip) / (1024 * 1024), 2);
echo "📦 Uploading backend.zip ($zipSizeMb MB) ...\n";

$remoteZip = $targetDir . 'backend.zip';
$uploadSuccess = ftp_put($conn, $remoteZip, $localZip, FTP_BINARY);
if (!$uploadSuccess) {
    $err = error_get_last();
    echo "ERROR: Failed to upload backend.zip to $remoteZip. Details: " . ($err['message'] ?? 'Unknown error') . "\n";
    ftp_close($conn);
    exit(1);
}
echo "✅ backend.zip uploaded successfully ($zipSizeMb MB)!\n";

// Upload extractor script to both public/extract.php and root extract.php for maximum resilience
$localExtractor = realpath(__DIR__ . '/remote-extract.php');
$publicDir = $targetDir . 'public/';
@ftp_mkdir($conn, rtrim($publicDir, '/'));

$uploadedExtractor = false;
$targets = [
    $targetDir . 'public/extract.php',
    $targetDir . 'extract.php',
];

foreach ($targets as $remotePath) {
    if (ftp_put($conn, $remotePath, $localExtractor, FTP_BINARY)) {
        echo "✅ Uploaded extract.php to $remotePath\n";
        $uploadedExtractor = true;
    }
}

if (!$uploadedExtractor) {
    echo "ERROR: Failed to upload extract.php to any remote path!\n";
    ftp_close($conn);
    exit(1);
}

ftp_close($conn);

// Try triggering extraction via HTTP
$triggerUrls = [
    "https://api.universalpaints.lk/extract.php?key=" . $secret,
    "https://api.universalpaints.lk/public/extract.php?key=" . $secret,
];

$success = false;
foreach ($triggerUrls as $extractUrl) {
    echo "\n⚡ Triggering extraction via: $extractUrl ...\n";

    $ch = curl_init($extractUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 180);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36');

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlErr = curl_error($ch);
    curl_close($ch);

    echo "📥 HTTP Response ($httpCode): " . substr($response, 0, 500) . "\n";

    if ($httpCode === 200 && str_contains($response, 'SUCCESS')) {
        echo "\n🎉 SUCCESS! Backend extracted and deployed in seconds!\n";
        $success = true;
        break;
    }
}

if (!$success) {
    echo "\n❌ Remote extraction failed! Please review HTTP status code and response above.\n";
    exit(1);
}

exit(0);
