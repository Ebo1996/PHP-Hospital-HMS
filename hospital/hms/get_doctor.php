<?php
include('include/config.php');

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 0); // Don't display errors in AJAX response
ini_set('log_errors', 1);

if(!empty($_POST["specilizationid"])) 
{
    $specilization = mysqli_real_escape_string($con, $_POST['specilizationid']);
    
    // Debug: Check what we're searching for
    error_log("Searching for doctors with specialization: " . $specilization);
    
    $sql = mysqli_query($con, "SELECT doctorName, id FROM doctors WHERE specilization='$specilization'");
    
    if(!$sql) {
        error_log("MySQL Error: " . mysqli_error($con));
        echo '<option value="">Error: ' . mysqli_error($con) . '</option>';
        exit;
    }
    
    $count = mysqli_num_rows($sql);
    error_log("Found $count doctors for specialization: $specilization");
    
    // Always output "Select Doctor" first
    echo '<option value="">Select Doctor</option>';
    
    if($count == 0) {
        echo '<option value="" disabled>No doctors available for this specialization</option>';
        // Debug: Let's see what's in the database
        $all = mysqli_query($con, "SELECT DISTINCT specilization FROM doctors");
        error_log("Available specializations in database:");
        while($r = mysqli_fetch_array($all)) {
            error_log(" - " . $r['specilization']);
        }
    } else {
        while($row = mysqli_fetch_array($sql)) {
            echo '<option value="' . htmlentities($row['id']) . '">' . htmlentities($row['doctorName']) . '</option>';
            error_log("Added doctor: " . $row['doctorName'] . " (ID: " . $row['id'] . ")");
        }
    }
}

if(!empty($_POST["doctor"])) 
{
    $doctorId = mysqli_real_escape_string($con, $_POST['doctor']);
    error_log("Getting fees for doctor ID: " . $doctorId);
    
    $sql = mysqli_query($con, "SELECT docFees FROM doctors WHERE id='$doctorId'");
    
    if($row = mysqli_fetch_array($sql)) {
        echo '<option value="' . htmlentities($row['docFees']) . '">₹ ' . htmlentities($row['docFees']) . '</option>';
        error_log("Fees: " . $row['docFees']);
    } else {
        echo '<option value="">Fee not available</option>';
        error_log("No fees found for doctor ID: " . $doctorId);
    }
}
?>