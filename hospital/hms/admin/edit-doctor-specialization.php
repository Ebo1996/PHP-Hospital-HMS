<?php
session_start();error_reporting(0);include('include/config.php');include('include/auth.php');
$pageTitle='Edit Specialization';$pageIcon='fa-stethoscope';
$id=intval($_GET['id']??0);
if(isset($_POST['submit'])){
  $spec=mysqli_real_escape_string($con,$_POST['doctorspecilization']);
  mysqli_query($con,"UPDATE doctorSpecilization SET specilization='$spec' WHERE id='$id'");
  $msg='Specialization updated successfully.';
  $mtype='success';
}
?><!DOCTYPE html><html lang="en"><head><title>Edit Specialization — HMS+ Admin</title><?php include('include/head.php');?></head><body>
<div id="app"><?php include('include/sidebar.php');?>
<div class="app-content"><?php include('include/header.php');?>
<div class="main-content">
<div class="adm-breadcrumb"><i class="fa fa-home"></i><a href="dashboard.php">Dashboard</a><span class="sep">/</span><a href="doctor-specilization.php">Specializations</a><span class="sep">/</span><span class="cur">Edit</span></div>
<?php if(!empty($msg)):?><div class="adm-alert adm-alert-<?php echo $mtype;?>"><i class="fa fa-check-circle"></i><?php echo htmlspecialchars($msg);?></div><?php endif;?>
<div class="row justify-content-center"><div class="col-lg-5 col-md-7">
<div class="adm-card">
  <div class="adm-card-header"><div class="ch-left"><i class="fa fa-stethoscope"></i><h5>Edit Doctor Specialization</h5></div></div>
  <div class="adm-card-body">
  <form method="post">
    <div class="adm-fg">
      <label>Specialization Name</label>
      <?php $r=mysqli_query($con,"SELECT * FROM doctorSpecilization WHERE id='$id'");
      $row=mysqli_fetch_array($r);?>
      <input type="text" name="doctorspecilization" class="adm-input" value="<?php echo htmlspecialchars($row['specilization']??'');?>" required>
    </div>
    <button type="submit" name="submit" class="btn-adm btn-adm-primary"><i class="fa fa-save"></i> Update</button>
    <a href="doctor-specilization.php" class="btn-adm btn-adm-outline" style="margin-left:10px"><i class="fa fa-arrow-left"></i> Back</a>
  </form>
  </div>
</div>
</div></div>
</div><?php include('include/footer.php');?></div></div>
<?php include('include/scripts.php');?></body></html>
