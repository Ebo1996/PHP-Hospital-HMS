<?php
session_start();
include('include/config.php');
include('include/checklogin.php');
check_login();
$pageTitle = 'Appointment History';
$pageIcon  = 'fa-calendar';

if(isset($_GET['cancel']) && isset($_GET['id'])){
    $cid = (int)$_GET['id'];
    mysqli_query($con,"UPDATE appointment SET userStatus='0' WHERE id='$cid'");
    $cancelMsg = 'Appointment cancelled successfully.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Appointment History — HMS+</title>
  <?php include('include/head.php'); ?>
</head>
<body>
<div id="app">
  <?php include('include/sidebar.php'); ?>
  <div class="app-content">
    <?php include('include/header.php'); ?>
    <div class="main-content">

      <div class="hms-breadcrumb">
        <i class="fa fa-home"></i> <a href="dashboard.php">Dashboard</a>
        <span class="sep">/</span><span class="current">Appointment History</span>
      </div>

      <?php if(!empty($cancelMsg)): ?>
      <div class="hms-alert hms-alert-info"><i class="fa fa-info-circle"></i> <?php echo $cancelMsg; ?></div>
      <?php endif; ?>

      <div class="hms-card">
        <div class="hms-card-header" style="justify-content:space-between;">
          <div style="display:flex;align-items:center;gap:10px;">
            <i class="fa fa-calendar"></i><h5>My Appointments</h5>
          </div>
          <a href="book-appointment.php" class="btn-hms btn-hms-primary btn-hms-sm">
            <i class="fa fa-plus"></i> New Appointment
          </a>
        </div>
        <div class="hms-card-body" style="padding:0;">
          <div class="hms-table-wrap">
            <table class="hms-table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Doctor</th>
                  <th>Specialization</th>
                  <th>Fees</th>
                  <th>Date / Time</th>
                  <th>Booked On</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $uid = $_SESSION['id'];
                $sql = mysqli_query($con,"SELECT doctors.doctorName as docname, appointment.* FROM appointment JOIN doctors ON doctors.id=appointment.doctorId WHERE appointment.userId='$uid' ORDER BY appointment.postingDate DESC");
                $cnt = 1;
                while($row = mysqli_fetch_array($sql)):
                    $uStatus = $row['userStatus'];
                    $dStatus = $row['doctorStatus'];
                    if($uStatus==1 && $dStatus==1)      { $badge='badge-active';    $label='Active'; }
                    elseif($uStatus==0 && $dStatus==1)  { $badge='badge-cancelled'; $label='Cancelled by You'; }
                    else                                 { $badge='badge-cancelled'; $label='Cancelled by Doctor'; }
                ?>
                <tr>
                  <td><?php echo $cnt; ?></td>
                  <td><strong><?php echo htmlspecialchars($row['docname']); ?></strong></td>
                  <td><?php echo htmlspecialchars($row['doctorSpecialization']); ?></td>
                  <td>ETB <?php echo htmlspecialchars($row['consultancyFees']); ?></td>
                  <td><?php echo htmlspecialchars($row['appointmentDate']); ?><br>
                    <small style="color:var(--muted)"><?php echo htmlspecialchars($row['appointmentTime']); ?></small></td>
                  <td><small><?php echo htmlspecialchars($row['postingDate']); ?></small></td>
                  <td><span class="badge-hms <?php echo $badge; ?>"><?php echo $label; ?></span></td>
                  <td>
                    <?php if($uStatus==1 && $dStatus==1): ?>
                    <a href="appointment-history.php?id=<?php echo $row['id']; ?>&cancel=1"
                       onclick="return confirm('Cancel this appointment?')"
                       class="btn-hms btn-hms-danger btn-hms-sm">
                      <i class="fa fa-times"></i> Cancel
                    </a>
                    <?php else: ?>
                    <span style="color:var(--muted);font-size:0.8rem;">—</span>
                    <?php endif; ?>
                  </td>
                </tr>
                <?php $cnt++; endwhile; ?>
                <?php if($cnt === 1): ?>
                <tr><td colspan="8" style="text-align:center;padding:40px;color:var(--muted);">
                  <i class="fa fa-calendar-times-o" style="font-size:2rem;display:block;margin-bottom:10px;"></i>
                  No appointments found. <a href="book-appointment.php">Book one now</a>.
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
