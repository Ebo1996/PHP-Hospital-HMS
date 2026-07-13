<?php
session_start();error_reporting(0);include('include/config.php');include('include/auth.php');
$pageTitle='Manage Doctors';$pageIcon='fa-user-md';
if(isset($_GET['del'])){$id=(int)$_GET['id'];mysqli_query($con,"DELETE FROM doctors WHERE id='$id'");$msg='Doctor deleted.';}
?><!DOCTYPE html><html lang="en"><head><title>Manage Doctors — HMS+ Admin</title><?php include('include/head.php');?></head><body>
<div id="app"><?php include('include/sidebar.php');?>
<div class="app-content"><?php include('include/header.php');?>
<div class="main-content">
<div class="adm-breadcrumb"><i class="fa fa-home"></i><a href="dashboard.php">Dashboard</a><span class="sep">/</span><span class="cur">Manage Doctors</span></div>
<?php if(!empty($msg)):?><div class="adm-alert adm-alert-warn"><i class="fa fa-info-circle"></i><?php echo $msg;?></div><?php endif;?>
<div class="adm-card">
  <div class="adm-card-header">
    <div class="ch-left"><i class="fa fa-user-md"></i><h5>All Doctors</h5></div>
    <a href="add-doctor.php" class="btn-adm btn-adm-primary btn-adm-sm"><i class="fa fa-plus"></i> Add Doctor</a>
  </div>
  <div class="adm-card-body" style="padding:0">
  <div class="adm-table-wrap"><table class="adm-table">
    <thead><tr><th>#</th><th>Doctor Name</th><th>Specialization</th><th>Email</th><th>Fees</th><th>Contact</th><th>Joined</th><th>Action</th></tr></thead>
    <tbody>
    <?php $sql=mysqli_query($con,"SELECT * FROM doctors ORDER BY creationDate DESC");$c=1;
    while($row=mysqli_fetch_array($sql)):?>
    <tr>
      <td><?php echo $c++;?></td>
      <td><strong><?php echo htmlspecialchars($row['doctorName']);?></strong></td>
      <td><span class="adm-badge badge-info"><?php echo htmlspecialchars($row['specilization']);?></span></td>
      <td><?php echo htmlspecialchars($row['docEmail']);?></td>
      <td>ETB <?php echo htmlspecialchars($row['docFees']);?></td>
      <td><?php echo htmlspecialchars($row['contactno']);?></td>
      <td><small><?php echo htmlspecialchars($row['creationDate']);?></small></td>
      <td style="white-space:nowrap">
        <a href="edit-doctor.php?id=<?php echo $row['id'];?>" class="btn-adm btn-adm-outline btn-adm-sm"><i class="fa fa-pencil"></i></a>
        <a href="manage-doctors.php?id=<?php echo $row['id'];?>&del=1" onclick="return confirm('Delete this doctor?')" class="btn-adm btn-adm-danger btn-adm-sm"><i class="fa fa-trash"></i></a>
      </td>
    </tr>
    <?php endwhile;?>
    </tbody>
  </table></div>
  </div>
</div>
</div><?php include('include/footer.php');?></div></div>
<?php include('include/scripts.php');?></body></html>
