<?php
session_start();
include('include/config.php');
include('include/checklogin.php');
check_login();
$pageTitle = 'Medical History';
$pageIcon  = 'fa-heartbeat';
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
        <span class="sep">/</span><span class="current">Medical History</span>
      </div>

      <div class="hms-card">
        <div class="hms-card-header">
          <i class="fa fa-heartbeat"></i><h5>Patient Medical Records</h5>
        </div>
        <div class="hms-card-body" style="padding:0;">
          <div class="hms-table-wrap">
            <table class="hms-table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Patient Name</th>
                  <th>Contact Number</th>
                  <th>Gender</th>
                  <th>Registered On</th>
                  <th>Last Updated</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $uid = $_SESSION['id'];
                $sql = mysqli_query($con,"SELECT tblpatient.* FROM tblpatient JOIN users ON users.email=tblpatient.PatientEmail WHERE users.id='$uid'");
                $cnt = 1;
                while($row = mysqli_fetch_array($sql)):
                ?>
                <tr>
                  <td><?php echo $cnt; ?></td>
                  <td><strong><?php echo htmlspecialchars($row['PatientName']); ?></strong></td>
                  <td><?php echo htmlspecialchars($row['PatientContno']); ?></td>
                  <td><span class="badge-hms badge-active"><?php echo htmlspecialchars($row['PatientGender']); ?></span></td>
                  <td><small><?php echo htmlspecialchars($row['CreationDate']); ?></small></td>
                  <td><small><?php echo $row['UpdationDate'] ?: '—'; ?></small></td>
                  <td>
                    <a href="view-medhistory.php?viewid=<?php echo $row['ID']; ?>" class="btn-hms btn-hms-primary btn-hms-sm">
                      <i class="fa fa-eye"></i> View Details
                    </a>
                  </td>
                </tr>
                <?php $cnt++; endwhile; ?>
                <?php if($cnt===1): ?>
                <tr><td colspan="7" style="text-align:center;padding:40px;color:var(--muted);">
                  <i class="fa fa-file-medical" style="font-size:2rem;display:block;margin-bottom:10px;"></i>
                  No medical records found.
                </td></tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
    <?php include('include/footer.php'); ?>
  </div>
</div>
<?php include('include/scripts.php'); ?>
</body>
</html>
