<?php
echo "<h2>Database Connection Test</h2>";

// Test 1: With full hostname
echo "<h3>Test 1: Using sql213.infinityfree.com</h3>";
$server1 = 'sql213.infinityfree.com';
$user = 'if0_42403003';
$pass = '1p1gILvWyC1Yyd';
$db = 'if0_42403003_hms';

echo "Server: $server1<br>";
echo "Username: $user<br>";
echo "Database: $db<br>";

$con1 = @mysqli_connect($server1, $user, $pass, $db);

if ($con1) {
    echo "✅ <strong style='color:green'>SUCCESS!</strong> Connected with full hostname!<br>";
    echo "MySQL Version: " . mysqli_get_server_info($con1) . "<br><br>";
    mysqli_close($con1);
} else {
    echo "❌ <strong style='color:red'>FAILED!</strong><br>";
    echo "Error: " . mysqli_connect_error() . "<br>";
    echo "Error Code: " . mysqli_connect_errno() . "<br><br>";
}

// Test 2: With localhost
echo "<h3>Test 2: Using localhost</h3>";
$server2 = 'localhost';

echo "Server: $server2<br>";
echo "Username: $user<br>";
echo "Database: $db<br>";

$con2 = @mysqli_connect($server2, $user, $pass, $db);

if ($con2) {
    echo "✅ <strong style='color:green'>SUCCESS!</strong> Connected with localhost!<br>";
    echo "MySQL Version: " . mysqli_get_server_info($con2) . "<br>";
    mysqli_close($con2);
} else {
    echo "❌ <strong style='color:red'>FAILED!</strong><br>";
    echo "Error: " . mysqli_connect_error() . "<br>";
    echo "Error Code: " . mysqli_connect_errno();
}
?>
