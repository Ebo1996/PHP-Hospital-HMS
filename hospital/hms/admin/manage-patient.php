<?php
session_start();error_reporting(0);include('include/config.php');include('include/auth.php');
$pageTitle='Manage Patients';$pageIcon='fa-procedures';
?><!DOCTYPE html><html lang="en"><head><title>Manage Patients — HMS+ Admin</title><?php include('include/head.php');?></head><body>
<div id="app"><?php include('include/sidebar.php');?>
<div class="app-content"><?php include('include/header.php');?>
<div class="main-content">
<div class="adm-breadcrumb"><i class="fa fa-home"></i><a href="dashboard.php">Dashboard</a><span class="sep">/</span><span class="cur">Manage Patients</span></div>
<div class="adm-card">
  <div class="adm-card-header"><div class="ch-left"><i class="fa fa-procedures"></i><h5>All Patients</h5></div></div>
  <div class="adm-card-body" style="padding:0">
  <div class="adm-table-wrap"><table class="adm-table">
    <thead><tr><th>#</th><th>Patient Name</th><th>Contact</th><th>Gender</th><th>Registered</th><th>Last Updated</th><th>Action</th></tr></thead>
    <tbody>
    <?php $sql=mysqli_query($con,"SELECT * FROM tblpatient ORDER BY CreationDate DESC");$c=1;
    while($row=mysqli_fetch_array($sql)):?>
    <tr>
      <td><?php echo $c++;?></td>
      <td><strong><?php echo htmlspecialchars($row['PatientName']);?></strong></td>
      <td><?php echo htmlspecialchars($row['PatientContno']);?></td>
      <td><span class="adm-badge badge-info"><?php echo htmlspecialchars($row['PatientGender']);?></span></td>
      <td><small><?php echo htmlspecialchars($row['CreationDate']);?></small></td>
      <td><small><?php echo $row['UpdationDate']??'—';?></small></td>
      <td><a href="view-patient.php?viewid=<?php echo $row['ID'];?>" class="btn-adm btn-adm-primary btn-adm-sm"><i class="fa fa-eye"></i> View</a></td>
    </tr>
    <?php endwhile;?>
    </tbody>
  </table></div>
  </div>
</div>
</div><?php include('include/footer.php');?></div></div>
<?php include('include/scripts.php');?></body></html>
