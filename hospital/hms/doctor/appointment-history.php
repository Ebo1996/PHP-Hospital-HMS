<?php
session_start();error_reporting(0);include('include/config.php');include('include/auth.php');
$pageTitle='Appointments';$pageIcon='fa-calendar';
if(isset($_GET['cancel'])){
  mysqli_query($con,"UPDATE appointment SET doctorStatus='0' WHERE id='".intval($_GET['id'])."'");
  $msg='Appointment cancelled successfully.';
}
?><!DOCTYPE html><html lang="en"><head><title>Appointments — HMS+ Doctor</title><?php include('include/head.php');?></head><body>
<div id="app"><?php include('include/sidebar.php');?>
<div class="app-content"><?php include('include/header.php');?>
<div class="main-content">
<div class="doc-breadcrumb"><i class="fa fa-home"></i><a href="dashboard.php">Dashboard</a><span class="sep">/</span><span class="cur">Appointments</span></div>
<?php if(!empty($msg)):?><div class="doc-alert doc-alert-warn"><i class="fa fa-info-circle"></i><?php echo htmlspecialchars($msg);?></div><?php endif;?>
<div class="doc-card">
  <div class="doc-card-header"><div class="ch-left"><i class="fa fa-calendar"></i><h5>My Appointment History</h5></div></div>
  <div class="doc-card-body" style="padding:0">
  <div class="doc-table-wrap"><table class="doc-table">
    <thead><tr><th>#</th><th>Patient Name</th><th>Specialization</th><th>Fee</th><th>Date / Time</th><th>Booked On</th><th>Status</th><th>Action</th></tr></thead>
    <tbody>
    <?php
    $sql=mysqli_query($con,"SELECT users.fullName as fname, appointment.* FROM appointment JOIN users ON users.id=appointment.userId WHERE appointment.doctorId='".$_SESSION['id']."' ORDER BY postingDate DESC");
    $c=1;
    if(mysqli_num_rows($sql)==0):?>
    <tr><td colspan="8" style="text-align:center;padding:36px;color:var(--muted)"><i class="fa fa-calendar" style="font-size:2rem;display:block;margin-bottom:10px;opacity:.3"></i>No appointments yet.</td></tr>
    <?php else: while($row=mysqli_fetch_array($sql)):
      $us=$row['userStatus'];$ds=$row['doctorStatus'];
      if($us==1&&$ds==1){$badge='badge-success';$label='Active';}
      elseif($us==0&&$ds==1){$badge='badge-danger';$label='Cancelled by Patient';}
      else{$badge='badge-danger';$label='Cancelled by You';}
    ?>
    <tr>
      <td><?php echo $c++;?></td>
      <td><strong><?php echo htmlspecialchars($row['fname']);?></strong></td>
      <td><?php echo htmlspecialchars($row['doctorSpecialization']);?></td>
      <td>ETB <?php echo htmlspecialchars($row['consultancyFees']);?></td>
      <td><?php echo htmlspecialchars($row['appointmentDate']);?><br><small style="color:var(--muted)"><?php echo htmlspecialchars($row['appointmentTime']);?></small></td>
      <td><small><?php echo htmlspecialchars($row['postingDate']);?></small></td>
      <td><span class="doc-badge <?php echo $badge;?>"><?php echo $label;?></span></td>
      <td>
        <?php if($us==1&&$ds==1):?>
        <a href="appointment-history.php?id=<?php echo $row['id'];?>&cancel=1" onclick="return confirm('Cancel this appointment?')" class="btn-doc btn-doc-danger btn-doc-sm"><i class="fa fa-times"></i> Cancel</a>
        <?php else:?><span style="color:var(--muted);font-size:.82rem;">Cancelled</span><?php endif;?>
      </td>
    </tr>
    <?php endwhile;endif;?>
    </tbody>
  </table></div>
  </div>
</div>
</div><?php include('include/footer.php');?></div></div>
<?php include('include/scripts.php');?></body></html>
