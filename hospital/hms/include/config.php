<?php
// Auto-detect environment: localhost vs production
$isLocalhost = ($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['SERVER_ADDR'] == '127.0.0.1');

if ($isLocalhost) {
    // XAMPP Localhost Configuration
    define('DB_SERVER','localhost');
    define('DB_USER','root');
    define('DB_PASS','');
    define('DB_NAME','hms');
} else {
    // InfinityFree Production Configuration
    define('DB_SERVER','sql213.infinityfree.com');
    define('DB_USER','if0_42403003');
    define('DB_PASS','1p1gILvWyC1Yyd');
    define('DB_NAME','if0_42403003_hms'); // Change XXX to your actual database name
}

$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}
?>