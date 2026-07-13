<?php
// Simulate the POST request that should happen
$_POST['specilizationid'] = 'ENT';

echo "<h2>Direct Test of get_doctor.php</h2>";
echo "<p>Simulating POST request with specilizationid = 'ENT'</p>";
echo "<hr>";
echo "<h3>Output from get_doctor.php:</h3>";
echo "<select style='padding:10px; font-size:16px; width:300px;'>";

// Include the get_doctor.php file
include('get_doctor.php');

echo "</select>";
?>
