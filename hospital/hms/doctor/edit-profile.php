<?php
session_start();error_reporting(0);include('include/config.php');include('include/auth.php');
$pageTitle='Edit Profile';$pageIcon='fa-user-md';
if(isset($_POST['submit'])){
  $sp=mysqli_real_escape_string($con,$_POST['Doctorspecialization']);
  $dn=mysqli_real_escape_string($con,$_POST['docname']);
  $da=mysqli_real_escape_string($con,$_POST['clinicaddress']);
  $df=mysqli_real_escape_string($con,$_POST['docfees']);
  $dc=mysqli_real_escape_string($con,$_POST['doccontact']);
  $q=mysqli_query($con,"UPDATE doctors SET specilization='$sp',doctorName='$dn',address='$da',docFees='$df',contactno='$dc' WHERE id='".$_SESSION['id']."'");
  $msg=$q?'Profile updated successfully.':'Something went wrong.';
  $mtype=$q?'success':'error';
}
$did=$_SESSION['login'];
$sql=mysqli_query($con,"SELECT * FROM doctors WHERE docEmail='$did'");
$data=mysqli_fetch_array($sql);
?><!DOCTYPE html><html lang="en"><head><title>Edit Profile — HMS+ Doctor</title><?php include('include/head.php');?></head><body>
<div id="app"><?php include('include/sidebar.php');?>
<div class="app-content"><?php include('include/header.php');?>
<div class="main-content">
<div class="doc-breadcrumb"><i class="fa fa-home"></i><a href="dashboard.php">Dashboard</a><span class="sep">/</span><span class="cur">Edit Profile</span></div>
<?php if(!empty($msg)):?><div class="doc-alert doc-alert-<?php echo $mtype;?>"><i class="fa fa-<?php echo $mtype==='success'?'check-circle':'exclamation-circle';?>"></i><?php echo htmlspecialchars($msg);?></div><?php endif;?>
<?php if($data):?>
<div class="row justify-content-center"><div class="col-lg-7 col-md-10">
<div class="doc-card">
  <div class="doc-card-header">
    <div class="ch-left"><i class="fa fa-user-md"></i><h5>Dr. <?php echo htmlspecialchars($data['doctorName']);?></h5></div>
    <small style="color:var(--muted)">Registered: <?php echo htmlspecialchars($data['creationDate']);?></small>
  </div>
  <div class="doc-card-body">
  <form method="post">
    <div class="doc-fg">
      <label>Specialization</label>
      <select name="Doctorspecialization" class="doc-input" required>
        <option value="<?php echo htmlspecialchars($data['specilization']);?>"><?php echo htmlspecialchars($data['specilization']);?></option>
        <?php $ret=mysqli_query($con,"SELECT * FROM doctorspecilization");while($row=mysqli_fetch_array($ret)):?>
        <option value="<?php echo htmlspecialchars($row['specilization']);?>"><?php echo htmlspecialchars($row['specilization']);?></option>
        <?php endwhile;?>
      </select>
    </div>
    <div class="row">
      <div class="col-md-6"><div class="doc-fg"><label>Doctor Name</label><input type="text" name="docname" class="doc-input" value="<?php echo htmlspecialchars($data['doctorName']);?>" required></div></div>
      <div class="col-md-6"><div class="doc-fg"><label>Consultancy Fees</label><input type="text" name="docfees" class="doc-input" value="<?php echo htmlspecialchars($data['docFees']);?>" required></div></div>
    </div>
    <div class="doc-fg"><label>Contact Number</label><input type="text" name="doccontact" class="doc-input" value="<?php echo htmlspecialchars($data['contactno']);?>" required></div>
    <div class="doc-fg"><label>Clinic Address</label><textarea name="clinicaddress" class="doc-input"><?php echo htmlspecialchars($data['address']);?></textarea></div>
    <div class="doc-fg"><label>Email Address (read-only)</label><input type="email" name="docemail" class="doc-input" value="<?php echo htmlspecialchars($data['docEmail']);?>" readonly></div>
    <button type="submit" name="submit" class="btn-doc btn-doc-primary"><i class="fa fa-save"></i> Update Profile</button>
    <a href="dashboard.php" class="btn-doc btn-doc-outline" style="margin-left:10px">Cancel</a>
  </form>
  </div>
</div>
</div></div>
<?php else:?><div class="doc-alert doc-alert-error"><i class="fa fa-exclamation-circle"></i>Profile not found.</div><?php endif;?>
</div><?php include('include/footer.php');?></div></div>
<?php include('include/scripts.php');?></body></html>
