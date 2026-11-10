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
echo "Bootstrap Cache Writable: " . (is_writable(dirname(__DIR__) . '/bootstrap/cache') ? 'YES' : 'NO') . "\n\n";

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
    echo " - DB Connection: " . config('database.default') . "\n";
    echo " - DB Host: " . config('database.connections.mysql.host') . "\n";
    echo " - DB Name: " . config('database.connections.mysql.database') . "\n";
    echo " - DB User: " . config('database.connections.mysql.username') . "\n";

    echo "Attempting DB Connection PDO... ";
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
