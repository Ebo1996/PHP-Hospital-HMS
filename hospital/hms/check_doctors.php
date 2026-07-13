<?php
include('include/config.php');

echo "<h2>Database Check</h2>";

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "<p style='color:green;'>✅ Database connected successfully</p>";

// Check doctors table
echo "<h3>All Doctors in Database:</h3>";
$sql = "SELECT id, doctorName, specilization, docEmail FROM doctors ORDER BY specilization";
$result = mysqli_query($con, $sql);

if ($result) {
    echo "<table border='1' cellpadding='10' style='border-collapse:collapse;'>";
    echo "<tr style='background:#0077b6;color:white;'><th>ID</th><th>Name</th><th>Specialization</th><th>Email</th></tr>";
    
    $count = 0;
    while ($row = mysqli_fetch_array($result)) {
        $count++;
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['doctorName'] . "</td>";
        echo "<td><strong>" . $row['specilization'] . "</strong></td>";
        echo "<td>" . $row['docEmail'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<p><strong>Total doctors: $count</strong></p>";
    
    if ($count == 0) {
        echo "<p style='color:red;'>⚠️ No doctors found in database!</p>";
    }
} else {
    echo "<p style='color:red;'>Error: " . mysqli_error($con) . "</p>";
}

// Check specializations
echo "<h3>All Specializations:</h3>";
$sql2 = "SELECT id, specilization FROM doctorspecilization ORDER BY specilization";
$result2 = mysqli_query($con, $sql2);

if ($result2) {
    echo "<table border='1' cellpadding='10' style='border-collapse:collapse;'>";
    echo "<tr style='background:#2d6a4f;color:white;'><th>ID</th><th>Specialization</th></tr>";
    
    while ($row = mysqli_fetch_array($result2)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['specilization'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}

// Test the exact query used in get_doctor.php
echo "<h3>Test Query for ENT:</h3>";
$testSpec = 'ENT';
$sql3 = "SELECT doctorName, id FROM doctors WHERE specilization='$testSpec'";
echo "<p>Query: <code>$sql3</code></p>";

$result3 = mysqli_query($con, $sql3);
if ($result3) {
    $cnt = mysqli_num_rows($result3);
    echo "<p>Found <strong>$cnt</strong> doctor(s) with specialization 'ENT'</p>";
    
    if ($cnt > 0) {
        echo "<ul>";
        while ($row = mysqli_fetch_array($result3)) {
            echo "<li>ID: " . $row['id'] . " - Name: " . $row['doctorName'] . "</li>";
        }
        echo "</ul>";
    }
} else {
    echo "<p style='color:red;'>Query error: " . mysqli_error($con) . "</p>";
}

mysqli_close($con);
?>
