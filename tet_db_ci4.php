<?php
// test_db_ci4.php - Test database connection from CI4
echo "<h1>🧪 CI4 Database Connection Test</h1>";

try {
    // Load CI4 Database
    require_once __DIR__ . '/vendor/autoload.php';
    $config = new \Config\Database();
    
    echo "<h3>Database Config:</h3>";
    echo "Host: " . $config->default['hostname'] . "<br>";
    echo "User: " . $config->default['username'] . "<br>"; 
    echo "Database: " . $config->default['database'] . "<br>";
    
    // Test connection
    $db = \Config\Database::connect();
    echo "<div style='color: green;'>✅ CI4 Database: CONNECTED</div><br>";
    
    // Test query
    echo "<h3>Data Test:</h3>";
    
    // Test categories
    $builder = $db->table('categories');
    $categories = $builder->get();
    echo "📊 Categories: " . $categories->getNumRows() . " records<br>";
    
    // Test products  
    $builder = $db->table('products');
    $products = $builder->get();
    echo "📦 Products: " . $products->getNumRows() . " records<br>";
    
    // Test users
    $builder = $db->table('users');
    $users = $builder->get();
    echo "👥 Users: " . $users->getNumRows() . " records<br>";
    
    // Show sample data
    if ($categories->getNumRows() > 0) {
        echo "<h4>Sample Categories:</h4>";
        foreach($categories->getResultArray() as $cat) {
            echo "- " . $cat['nama_kategori'] . "<br>";
        }
    }
    
    if ($products->getNumRows() > 0) {
        echo "<h4>Sample Products:</h4>";
        foreach($products->getResultArray() as $prod) {
            echo "- " . $prod['nama_produk'] . " (Rp " . number_format($prod['harga']) . ")<br>";
        }
    }
    
} catch (\Exception $e) {
    echo "<div style='color: red;'>❌ CI4 Database Error: " . $e->getMessage() . "</div>";
}

echo "<hr>";
echo "<a href='http://localhost:8081/'>Test Homepage</a>";
?>