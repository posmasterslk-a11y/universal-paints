<?php
try {
    $pdo = new PDO('sqlite:database/database.sqlite');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Drop orders and order_items tables
    $pdo->exec("DROP TABLE IF EXISTS order_items;");
    $pdo->exec("DROP TABLE IF EXISTS orders;");
    
    // Remove orders migration record
    $pdo->exec("DELETE FROM migrations WHERE migration LIKE '%create_orders_table%';");
    $pdo->exec("DELETE FROM migrations WHERE migration LIKE '%create_order_items_table%';");
    
    echo "Successfully cleaned up tables and migrations.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
