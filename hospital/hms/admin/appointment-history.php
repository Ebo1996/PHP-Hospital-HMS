<?php
session_start();error_reporting(0);include('include/config.php');include('include/auth.php');
$pageTitle='Appointment History';$pageIcon='fa-calendar';
?><!DOCTYPE html><html lang="en"><head><title>Appointments — HMS+ Admin</title><?php include('include/head.php');?></head><body>
<div id="app"><?php include('include/sidebar.php');?>
<div class="app-content"><?php include('include/header.php');?>
<div class="main-content">
<div class="adm-breadcrumb"><i class="fa fa-home"></i><a href="dashboard.php">Dashboard</a><span class="sep">/</span><span class="cur">Appointment History</span></div>
<div class="adm-card">
  <div class="adm-card-header"><div class="ch-left"><i class="fa fa-calendar"></i><h5>All Appointments</h5></div></div>
  <div class="adm-card-body" style="padding:0">
  <div class="adm-table-wrap"><table class="adm-table">
    <thead><tr><th>#</th><th>Doctor</th><th>Patient</th><th>Specialization</th><th>Fees</th><th>Date / Time</th><th>Booked On</th><th>Status</th></tr></thead>
    <tbody>
    <?php
    $sql=mysqli_query($con,"SELECT doctors.doctorName as doc, users.fullName as pat, appointment.* FROM appointment JOIN doctors ON doctors.id=appointment.doctorId JOIN users ON users.id=appointment.userId ORDER BY appointment.postingDate DESC");
    $c=1;
    while($row=mysqli_fetch_array($sql)):
      $us=$row['userStatus']; $ds=$row['doctorStatus'];
      if($us==1&&$ds==1){$badge='badge-success';$label='Active';}
      elseif($us==0&&$ds==1){$badge='badge-danger';$label='Cancelled by Patient';}
      else{$badge='badge-danger';$label='Cancelled by Doctor';}
    ?>
    <tr>
      <td><?php echo $c++;?></td>
      <td><strong><?php echo htmlspecialchars($row['doc']);?></strong></td>
      <td><?php echo htmlspecialchars($row['pat']);?></td>
      <td><?php echo htmlspecialchars($row['doctorSpecialization']);?></td>
      <td>ETB <?php echo htmlspecialchars($row['consultancyFees']);?></td>
      <td><?php echo htmlspecialchars($row['appointmentDate']);?><br><small style="color:var(--muted)"><?php echo htmlspecialchars($row['appointmentTime']);?></small></td>
      <td><small><?php echo htmlspecialchars($row['postingDate']);?></small></td>
      <td><span class="adm-badge <?php echo $badge;?>"><?php echo $label;?></span></td>
    </tr>
    <?php endwhile;?>
    </tbody>
  </table></div>
  </div>
</div>
</div><?php include('include/footer.php');?></div></div>
<?php include('include/scripts.php');?></body></html>
