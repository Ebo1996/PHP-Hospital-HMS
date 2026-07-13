<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
$pageTitle = 'View Medical History';
$pageIcon  = 'fa-heartbeat';
$vid = isset($_GET['viewid']) ? (int)$_GET['viewid'] : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Medical History — HMS+</title>
  <?php include('include/head.php'); ?>
</head>
<body>
<div id="app">
  <?php include('include/sidebar.php'); ?>
  <div class="app-content">
    <?php include('include/header.php'); ?>
    <div class="main-content">

      <div class="hms-breadcrumb">
        <i class="fa fa-home"></i><a href="dashboard.php">Dashboard</a>
        <span class="sep">/</span><a href="manage-medhistory.php">Medical History</a>
        <span class="sep">/</span><span class="current">View Details</span>
      </div>

      <?php
      $ret = mysqli_query($con,"SELECT * FROM tblpatient WHERE ID='$vid'");
      $patient = mysqli_fetch_array($ret);
      if(!$patient): ?>
      <div class="hms-alert hms-alert-error"><i class="fa fa-exclamation-circle"></i> Patient record not found.</div>
      <?php else: ?>

      <!-- Patient info card -->
      <div class="hms-card" style="margin-bottom:24px;">
        <div class="hms-card-header">
          <i class="fa fa-user"></i><h5>Patient Information</h5>
        </div>
        <div class="hms-card-body">
          <div class="row">
            <div class="col-md-2 text-center" style="margin-bottom:16px;">
              <div class="profile-avatar" style="margin:0 auto 10px;width:70px;height:70px;font-size:1.8rem;">
                <?php echo strtoupper(substr($patient['PatientName'],0,1)); ?>
              </div>
              <span class="badge-hms badge-active"><?php echo htmlspecialchars($patient['PatientGender']); ?></span>
            </div>
            <div class="col-md-10">
              <div class="row">
                <div class="col-md-3 col-6" style="margin-bottom:16px;">
                  <div style="font-size:0.72rem;text-transform:uppercase;letter-spacing:0.5px;color:var(--muted);margin-bottom:4px;">Full Name</div>
                  <div style="font-weight:600;font-size:0.92rem;"><?php echo htmlspecialchars($patient['PatientName']); ?></div>
                </div>
                <div class="col-md-3 col-6" style="margin-bottom:16px;">
                  <div style="font-size:0.72rem;text-transform:uppercase;letter-spacing:0.5px;color:var(--muted);margin-bottom:4px;">Email</div>
                  <div style="font-weight:500;font-size:0.88rem;word-break:break-all;"><?php echo htmlspecialchars($patient['PatientEmail']); ?></div>
                </div>
                <div class="col-md-3 col-6" style="margin-bottom:16px;">
                  <div style="font-size:0.72rem;text-transform:uppercase;letter-spacing:0.5px;color:var(--muted);margin-bottom:4px;">Mobile</div>
                  <div style="font-weight:500;font-size:0.88rem;"><?php echo htmlspecialchars($patient['PatientContno']); ?></div>
                </div>
                <div class="col-md-3 col-6" style="margin-bottom:16px;">
                  <div style="font-size:0.72rem;text-transform:uppercase;letter-spacing:0.5px;color:var(--muted);margin-bottom:4px;">Age</div>
                  <div style="font-weight:500;font-size:0.88rem;"><?php echo htmlspecialchars($patient['PatientAge']); ?></div>
                </div>
                <div class="col-md-3 col-6">
                  <div style="font-size:0.72rem;text-transform:uppercase;letter-spacing:0.5px;color:var(--muted);margin-bottom:4px;">Address</div>
                  <div style="font-weight:500;font-size:0.88rem;"><?php echo htmlspecialchars($patient['PatientAdd']); ?></div>
                </div>
                <div class="col-md-3 col-6">
                  <div style="font-size:0.72rem;text-transform:uppercase;letter-spacing:0.5px;color:var(--muted);margin-bottom:4px;">Existing Conditions</div>
                  <div style="font-weight:500;font-size:0.88rem;"><?php echo $patient['PatientMedhis'] ?: '—'; ?></div>
                </div>
                <div class="col-md-3 col-6">
                  <div style="font-size:0.72rem;text-transform:uppercase;letter-spacing:0.5px;color:var(--muted);margin-bottom:4px;">Registered On</div>
                  <div style="font-weight:500;font-size:0.88rem;"><?php echo htmlspecialchars($patient['CreationDate']); ?></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Vitals history -->
      <div class="hms-card">
        <div class="hms-card-header">
          <i class="fa fa-heartbeat"></i><h5>Vitals &amp; Medical History</h5>
        </div>
        <div class="hms-card-body" style="padding:0;">
          <div class="hms-table-wrap">
            <table class="hms-table">
              <thead>
                <tr>
                  <th>#</th>
                  <th><i class="fa fa-tint" style="color:#e63946;margin-right:4px;"></i>Blood Pressure</th>
                  <th><i class="fa fa-tint" style="color:#0077b6;margin-right:4px;"></i>Blood Sugar</th>
                  <th><i class="fa fa-balance-scale" style="color:#2d6a4f;margin-right:4px;"></i>Weight</th>
                  <th><i class="fa fa-thermometer-half" style="color:#ee9b00;margin-right:4px;"></i>Temperature</th>
                  <th><i class="fa fa-file-text" style="color:var(--teal);margin-right:4px;"></i>Prescription</th>
                  <th>Visit Date</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $hist = mysqli_query($con,"SELECT * FROM tblmedicalhistory WHERE PatientID='$vid' ORDER BY CreationDate DESC");
                $cnt = 1;
                while($row = mysqli_fetch_array($hist)):
                ?>
                <tr>
                  <td><?php echo $cnt; ?></td>
                  <td><span style="font-weight:600;color:#e63946;"><?php echo htmlspecialchars($row['BloodPressure']); ?></span></td>
                  <td><?php echo htmlspecialchars($row['BloodSugar']); ?></td>
                  <td><?php echo htmlspecialchars($row['Weight']); ?></td>
                  <td><?php echo htmlspecialchars($row['Temperature']); ?></td>
                  <td style="max-width:200px;white-space:normal;"><?php echo htmlspecialchars($row['MedicalPres']); ?></td>
                  <td><small><?php echo htmlspecialchars($row['CreationDate']); ?></small></td>
                </tr>
                <?php $cnt++; endwhile; ?>
                <?php if($cnt === 1): ?>
                <tr><td colspan="7" style="text-align:center;padding:40px;color:var(--muted);">
                  <i class="fa fa-inbox" style="font-size:2rem;display:block;margin-bottom:10px;"></i>
                  No vitals records yet.
                </td></tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <?php endif; ?>

      <div style="margin-top:8px;">
        <a href="manage-medhistory.php" class="btn-hms btn-hms-outline">
          <i class="fa fa-arrow-left"></i> Back to Records
        </a>
      </div>

    </div>
    <?php include('include/footer.php'); ?>
  </div>
</div>
<?php include('include/scripts.php'); ?>
</body>
</html>
