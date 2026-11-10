<?php
header('Content-Type: text/plain; charset=utf-8');

echo "=== Universal Paints Backend Diagnostics ===\n";
echo "PHP Version: " . PHP_VERSION . "\n";
echo "Current File: " . __FILE__ . "\n";
echo "Base Path: " . dirname(__DIR__) . "\n";
echo ".env Exists at Base: " . (file_exists(dirname(__DIR__) . '/.env') ? 'YES' : 'NO') . "\n";
echo "Storage Writable: " . (is_writable(dirname(__DIR__) . '/storage') ? 'YES' : 'NO') . "\n";
echo "Storage Logs Writable: " . (is_writable(dirname(__DIR__) . '/storage/logs') ? 'YES' : 'NO') . "\n";
echo "Storage Framework Views: " . (is_dir(dirname(__DIR__) . '/storage/framework/views') ? 'EXISTS' : 'MISSING') . "\n";
echo "Bootstrap Cache Writable: " . (is_writable(dirname(__DIR__) . '/bootstrap/cache') ? 'YES' : 'NO') . "\n";

// Auto-patch admin files if old dev URL is present:
$adminDir = dirname(__DIR__) . '/admin';
if (is_dir($adminDir)) {
    $fixedFiles = 0;
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($adminDir));
    foreach ($iterator as $f) {
        if ($f->isFile() && in_array(strtolower($f->getExtension()), ['html', 'js', 'json'])) {
            $content = @file_get_contents($f->getPathname());
            if ($content !== false && strpos($content, 'http://127.0.0.1:8080') !== false) {
                $newContent = str_replace('http://127.0.0.1:8080', 'https://api.universalpaints.lk', $content);
                @file_put_contents($f->getPathname(), $newContent);
                $fixedFiles++;
            }
        }
    }
    if ($fixedFiles > 0) {
        echo "Admin Auto-Patch: Replaced 127.0.0.1:8080 in $fixedFiles admin files successfully!\n";
    } else {
        echo "Admin Files Status: Clean (no 127.0.0.1:8080 found).\n";
    }
}

// Auto-extract admin.zip if uploaded:
$adminZip = dirname(__DIR__) . '/admin.zip';
if (file_exists($adminZip) && class_exists('ZipArchive')) {
    $za = new ZipArchive;
    if ($za->open($adminZip) === true) {
        $za->extractTo($adminDir);
        $za->close();
        @unlink($adminZip);
        echo "Admin Auto-Extract: Extracted admin.zip into $adminDir successfully!\n";
    }
}
echo "\n";

try {
    echo "Loading vendor/autoload.php... ";
    require_once dirname(__DIR__) . '/vendor/autoload.php';
    echo "OK\n";

    echo "Bootstrapping application... ";
    $app = require_once dirname(__DIR__) . '/bootstrap/app.php';
    echo "OK\n";

    echo "Resolving HTTP Kernel... ";
    $kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);
    $kernel->bootstrap();
    echo "OK\n";

    echo "Testing Database Configuration...\n";
    $dbHost = config('database.connections.mysql.host');
    $dbName = config('database.connections.mysql.database');
    $dbUser = config('database.connections.mysql.username');
    $dbPass = config('database.connections.mysql.password');

    echo " - DB Connection: " . config('database.default') . "\n";
    echo " - DB Host: " . $dbHost . "\n";
    echo " - DB Name: " . $dbName . "\n";
    echo " - DB User: " . $dbUser . "\n";

    echo "\n[Test 1] Connecting to MySQL server without database...\n";
    try {
        $pdo = new \PDO("mysql:host={$dbHost}", $dbUser, $dbPass, [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
        echo " -> Authentication successful on {$dbHost}!\n";
        
        $stmt = $pdo->query("SHOW DATABASES");
        $dbs = $stmt->fetchAll(\PDO::FETCH_COLUMN);
        echo " -> Databases visible to user '{$dbUser}':\n";
        foreach ($dbs as $db) {
            echo "    * {$db}\n";
        }

        $userStmt = $pdo->query("SELECT CURRENT_USER(), USER()");
        $currUser = $userStmt->fetch(\PDO::FETCH_NUM);
        echo " -> Authenticated as: CURRENT_USER={$currUser[0]}, USER={$currUser[1]}\n";
    } catch (\Throwable $authErr) {
        echo " -> Direct connection failed: " . $authErr->getMessage() . "\n";
    }

    echo "\n[Test 2] Attempting DB Connection with host=localhost...\n";
    try {
        $pdoLocal = new \PDO("mysql:host=localhost;dbname={$dbName}", $dbUser, $dbPass, [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
        echo " -> Connected successfully via host=localhost to {$dbName}!\n";
    } catch (\Throwable $localErr) {
        echo " -> Failed via host=localhost: " . $localErr->getMessage() . "\n";
    }

    echo "\n[Test 3] Attempting Laravel DB Connection PDO...\n";
    \Illuminate\Support\Facades\DB::connection()->getPdo();
    echo "CONNECTED SUCCESSFULLY!\n\n";

    echo "Total Products Count: " . \App\Models\Product::count() . "\n";
    echo "Total Categories Count: " . \App\Models\Category::count() . "\n";
    echo "Total Users Count: " . \App\Models\User::count() . "\n";
    echo "=== ALL CHECKS PASSED ===\n";
} catch (\Throwable $e) {
    echo "\nFAILED WITH ERROR:\n";
    echo "Message: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . " (Line " . $e->getLine() . ")\n";
    echo "\nTrace:\n" . $e->getTraceAsString() . "\n";
}
