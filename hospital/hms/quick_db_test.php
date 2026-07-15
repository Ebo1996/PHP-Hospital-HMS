<?php
set_time_limit(10); // Maximum 10 seconds
ini_set('default_socket_timeout', 5); // Socket timeout 5 seconds

echo "<h2>Quick Database Test</h2>";
echo "<p>Testing with 5-second timeout...</p>";

// Test with localhost only (InfinityFree requirement)
$server = 'localhost';
$user = 'if0_42403003';
$pass = '1p1gILvWyC1Yyd';
$db = 'if0_42403003_hms';

echo "<strong>Server:</strong> $server<br>";
echo "<strong>Username:</strong> $user<br>";
echo "<strong>Database:</strong> $db<br><br>";

echo "Attempting connection...<br>";
flush();

$start = microtime(true);
$con = @mysqli_connect($server, $user, $pass, $db);
$duration = round(microtime(true) - $start, 2);

if ($con) {
    echo "✅ <strong style='color:green'>SUCCESS!</strong> Connected in {$duration} seconds!<br>";
    echo "MySQL Version: " . mysqli_get_server_info($con) . "<br>";
    
    // Test query
    $result = mysqli_query($con, "SHOW TABLES");
    if ($result) {
        $count = mysqli_num_rows($result);
        echo "Tables in database: $count<br>";
    }
    
    mysqli_close($con);
} else {
    echo "❌ <strong style='color:red'>FAILED</strong> after {$duration} seconds<br>";
    echo "Error: " . mysqli_connect_error() . "<br>";
    echo "Error Code: " . mysqli_connect_errno() . "<br>";
}

echo "<hr>";
echo "<p><strong>Note:</strong> If this times out, your MySQL database may not be activated yet. InfinityFree states it can take up to 72 hours for new databases.</p>";
?>
