<?php
// Auto-detect environment: localhost vs production
$isLocalhost = (isset($_SERVER['HTTP_HOST']) && ($_SERVER['HTTP_HOST'] == 'localhost' || strpos($_SERVER['HTTP_HOST'], '127.0.0.1') !== false));

if ($isLocalhost) {
    // XAMPP Localhost Configuration
    define('DB_SERVER','localhost');
    define('DB_USER','root');
    define('DB_PASS','');
    define('DB_NAME','hms');
} else {
    // InfinityFree Production Configuration - Use full hostname
    define('DB_SERVER','sql213.infinityfree.com');
    define('DB_USER','if0_42403003');
    define('DB_PASS','1p1gILvWyC1Yyd');
    define('DB_NAME','if0_42403003_hms');
    define('DB_PORT', 3306);
}

// Suppress warnings and handle connection gracefully
if (!$isLocalhost && defined('DB_PORT')) {
    $con = @mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME, DB_PORT);
} else {
    $con = @mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
}

// Check connection
if (!$con) {
    // Log error but don't display to users in production
    if ($isLocalhost) {
        die("Database connection failed: " . mysqli_connect_error());
    } else {
        // In production, log to error_log
        error_log("Database connection failed: " . mysqli_connect_error());
        die("We're experiencing technical difficulties. Please try again later.");
    }
}
?>