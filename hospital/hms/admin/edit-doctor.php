<?php
session_start();error_reporting(0);include('include/config.php');include('include/auth.php');
$pageTitle='Edit Doctor';$pageIcon='fa-user-md';
$did=intval($_GET['id']??0);
if(isset($_POST['submit'])){
  $sp=mysqli_real_escape_string($con,$_POST['Doctorspecialization']);
  $dn=mysqli_real_escape_string($con,$_POST['docname']);
  $da=mysqli_real_escape_string($con,$_POST['clinicaddress']);
  $df=mysqli_real_escape_string($con,$_POST['docfees']);
  $dc=mysqli_real_escape_string($con,$_POST['doccontact']);
  $de=mysqli_real_escape_string($con,$_POST['docemail']);
  $q=mysqli_query($con,"UPDATE doctors SET specilization='$sp',doctorName='$dn',address='$da',docFees='$df',contactno='$dc',docEmail='$de' WHERE id='$did'");
  $msg=$q?'Doctor details updated successfully.':'Something went wrong. Please try again.';
  $mtype=$q?'success':'error';
}
?><!DOCTYPE html><html lang="en"><head><title>Edit Doctor — HMS+ Admin</title><?php include('include/head.php');?></head><body>
<div id="app"><?php include('include/sidebar.php');?>
<div class="app-content"><?php include('include/header.php');?>
<div class="main-content">
<div class="adm-breadcrumb"><i class="fa fa-home"></i><a href="dashboard.php">Dashboard</a><span class="sep">/</span><a href="manage-doctors.php">Doctors</a><span class="sep">/</span><span class="cur">Edit Doctor</span></div>
<?php if(!empty($msg)):?><div class="adm-alert adm-alert-<?php echo $mtype;?>"><i class="fa fa-<?php echo $mtype==='success'?'check-circle':'exclamation-circle';?>"></i><?php echo htmlspecialchars($msg);?></div><?php endif;?>
<div class="row justify-content-center"><div class="col-lg-7 col-md-10">
<?php $sql=mysqli_query($con,"SELECT * FROM doctors WHERE id='$did'");
$data=mysqli_fetch_array($sql);?>
<?php if($data):?>
<div class="adm-card">
  <div class="adm-card-header">
    <div class="ch-left"><i class="fa fa-user-md"></i><h5><?php echo htmlspecialchars($data['doctorName']);?>'s Profile</h5></div>
    <span style="font-size:.75rem;color:var(--muted);">Registered: <?php echo htmlspecialchars($data['creationDate']);?></span>
  </div>
  <div class="adm-card-body">
  <form method="post">
    <div class="adm-fg">
      <label>Specialization</label>
      <select name="Doctorspecialization" class="adm-input" required>
        <option value="<?php echo htmlspecialchars($data['specilization']);?>"><?php echo htmlspecialchars($data['specilization']);?></option>
        <?php $ret=mysqli_query($con,"SELECT * FROM doctorspecilization");while($row=mysqli_fetch_array($ret)):?>
        <option value="<?php echo htmlspecialchars($row['specilization']);?>"><?php echo htmlspecialchars($row['specilization']);?></option>
        <?php endwhile;?>
      </select>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="adm-fg"><label>Doctor Name</label><input type="text" name="docname" class="adm-input" value="<?php echo htmlspecialchars($data['doctorName']);?>" required></div>
      </div>
      <div class="col-md-6">
        <div class="adm-fg"><label>Consultancy Fees</label><input type="text" name="docfees" class="adm-input" value="<?php echo htmlspecialchars($data['docFees']);?>" required></div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="adm-fg"><label>Contact Number</label><input type="text" name="doccontact" class="adm-input" value="<?php echo htmlspecialchars($data['contactno']);?>" required></div>
      </div>
      <div class="col-md-6">
        <div class="adm-fg"><label>Email Address</label><input type="email" name="docemail" class="adm-input" value="<?php echo htmlspecialchars($data['docEmail']);?>" readonly></div>
      </div>
    </div>
    <div class="adm-fg"><label>Clinic Address</label><textarea name="clinicaddress" class="adm-input"><?php echo htmlspecialchars($data['address']);?></textarea></div>
    <button type="submit" name="submit" class="btn-adm btn-adm-primary"><i class="fa fa-save"></i> Update Doctor</button>
    <a href="manage-doctors.php" class="btn-adm btn-adm-outline" style="margin-left:10px">Cancel</a>
  </form>
  </div>
</div>
<?php else:?>
<div class="adm-alert adm-alert-error"><i class="fa fa-exclamation-circle"></i>Doctor not found.</div>
<?php endif;?>
</div></div>
</div><?php include('include/footer.php');?></div></div>
<?php include('include/scripts.php');?></body></html>
