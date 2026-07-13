<?php
// InfinityFree Database Configuration
// IMPORTANT: Replace these values with your actual InfinityFree database details

define('DB_SERVER','sql###.infinityfree.com'); // Replace ### with your SQL server number
define('DB_USER','epiz_XXXXXXXX');             // Replace with your database username
define('DB_PASS','your_database_password');    // Replace with your database password
define('DB_NAME','epiz_XXXXXXXX_hms');         // Replace with your database name

$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}
?>