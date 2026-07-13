<?php
// InfinityFree Database Configuration for Admin Portal
define('DB_SERVER','sql305.infinityfree.com'); // Your MySQL Hostname
define('DB_USER','if0_42392408');              // Your MySQL Username
define('DB_PASS','XWC2i6RYmJcic1b');           // Your MySQL Password
define('DB_NAME','if0_42392408_hms');         // Your Database Name

$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}
?>