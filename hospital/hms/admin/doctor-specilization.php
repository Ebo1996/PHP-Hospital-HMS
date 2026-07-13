<?php
session_start();error_reporting(0);include('include/config.php');include('include/auth.php');
$pageTitle='Doctor Specializations';$pageIcon='fa-stethoscope';
if(isset($_POST['submit'])){
  $s=mysqli_real_escape_string($con,$_POST['doctorspecilization']);
  mysqli_query($con,"INSERT INTO doctorSpecilization(specilization) VALUES('$s')");$ok='Specialization added!';
}
if(isset($_GET['del'])){$id=(int)$_GET['id'];mysqli_query($con,"DELETE FROM doctorSpecilization WHERE id='$id'");$ok='Deleted successfully.';}
?><!DOCTYPE html><html lang="en"><head><title>Specializations — HMS+ Admin</title><?php include('include/head.php');?></head><body>
<div id="app"><?php include('include/sidebar.php');?>
<div class="app-content"><?php include('include/header.php');?>
<div class="main-content">
<div class="adm-breadcrumb"><i class="fa fa-home"></i><a href="dashboard.php">Dashboard</a><span class="sep">/</span><span class="cur">Specializations</span></div>
<?php if(!empty($ok)):?><div class="adm-alert adm-alert-success"><i class="fa fa-check-circle"></i><?php echo $ok;?></div><?php endif;?>
<div class="row">
  <div class="col-lg-4">
    <div class="adm-card">
      <div class="adm-card-header"><div class="ch-left"><i class="fa fa-plus-circle"></i><h5>Add Specialization</h5></div></div>
      <div class="adm-card-body">
        <form method="post">
          <div class="adm-fg"><label>Specialization Name</label><input type="text" name="doctorspecilization" class="adm-input" placeholder="e.g. Cardiology" required></div>
          <button type="submit" name="submit" class="btn-adm btn-adm-primary"><i class="fa fa-plus"></i> Add</button>
        </form>
      </div>
    </div>
  </div>
  <div class="col-lg-8">
    <div class="adm-card">
      <div class="adm-card-header"><div class="ch-left"><i class="fa fa-list"></i><h5>All Specializations</h5></div></div>
      <div class="adm-card-body" style="padding:0">
      <div class="adm-table-wrap"><table class="adm-table">
        <thead><tr><th>#</th><th>Specialization</th><th>Created</th><th>Updated</th><th>Action</th></tr></thead>
        <tbody>
        <?php $sql=mysqli_query($con,"SELECT * FROM doctorSpecilization");$c=1;while($row=mysqli_fetch_array($sql)):?>
        <tr>
          <td><?php echo $c++;?></td>
          <td><span class="adm-badge badge-info"><?php echo htmlspecialchars($row['specilization']);?></span></td>
          <td><small><?php echo $row['creationDate'];?></small></td>
          <td><small><?php echo $row['updationDate']??'—';?></small></td>
          <td style="white-space:nowrap">
            <a href="edit-doctor-specialization.php?id=<?php echo $row['id'];?>" class="btn-adm btn-adm-outline btn-adm-sm"><i class="fa fa-pencil"></i></a>
            <a href="doctor-specilization.php?id=<?php echo $row['id'];?>&del=1" onclick="return confirm('Delete?')" class="btn-adm btn-adm-danger btn-adm-sm"><i class="fa fa-trash"></i></a>
          </td>
        </tr>
        <?php endwhile;?>
        </tbody>
      </table></div>
      </div>
    </div>
  </div>
</div>
</div><?php include('include/footer.php');?></div></div>
<?php include('include/scripts.php');?></body></html>
