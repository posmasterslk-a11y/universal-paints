<?php
/**
 * Fast FTP ZIP Uploader and Trigger for Backend Deployment
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

echo "🔌 Connecting to FTP: $server ...\n";
$conn = @ftp_connect($server, 21, 60);
if (!$conn) {
    echo "ERROR: Could not connect to FTP server $server on port 21.\n";
    exit(1);
}

if (!@ftp_login($conn, $user, $pass)) {
    echo "ERROR: FTP login failed for user: $user\n";
    @ftp_close($conn);
    exit(1);
}

@ftp_pasv($conn, true);
echo "✅ Logged in to FTP successfully (Passive mode enabled).\n";

$localZip = realpath(__DIR__ . '/../../backend.zip');
if (!$localZip || !file_exists($localZip)) {
    echo "ERROR: Local backend.zip not found at $localZip\n";
    @ftp_close($conn);
    exit(1);
}

$zipSizeMb = round(filesize($localZip) / (1024 * 1024), 2);
echo "📦 Uploading backend.zip ($zipSizeMb MB) ...\n";

$remoteZip = $targetDir . 'backend.zip';
if (!@ftp_put($conn, $remoteZip, $localZip, FTP_BINARY)) {
    echo "ERROR: Failed to upload backend.zip to $remoteZip via FTP.\n";
    @ftp_close($conn);
    exit(1);
}
echo "✅ backend.zip uploaded successfully!\n";

$localExtractor = realpath(__DIR__ . '/remote-extract.php');
$remoteExtractor = $targetDir . 'public/extract.php';
echo "🚀 Uploading extract.php to $remoteExtractor ...\n";

if (!@ftp_put($conn, $remoteExtractor, $localExtractor, FTP_BINARY)) {
    // If public directory doesn't exist under targetDir, try root
    $remoteExtractor = $targetDir . 'extract.php';
    if (!@ftp_put($conn, $remoteExtractor, $localExtractor, FTP_BINARY)) {
        echo "ERROR: Failed to upload extract.php to $remoteExtractor\n";
        @ftp_close($conn);
        exit(1);
    }
}
echo "✅ extract.php uploaded successfully!\n";
@ftp_close($conn);

// Trigger extraction via HTTP
$extractUrl = "https://api.universalpaints.lk/extract.php?key=" . $secret;
echo "⚡ Triggering remote extraction via HTTP: $extractUrl ...\n";

$ch = curl_init($extractUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 180);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlErr = curl_error($ch);
curl_close($ch);

echo "📥 HTTP Response ($httpCode): $response\n";

if ($httpCode === 200 && str_contains($response, 'SUCCESS')) {
    echo "\n🎉 SUCCESS! Backend files extracted and updated on the live server in seconds!\n";
    exit(0);
} else {
    echo "\n❌ Extraction failed! HTTP Code: $httpCode. Response: $response\n";
    if ($curlErr) echo "cURL Error: $curlErr\n";
    exit(1);
}
