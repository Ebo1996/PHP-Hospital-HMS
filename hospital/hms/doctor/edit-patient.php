<?php
session_start();error_reporting(0);include('include/config.php');include('include/auth.php');
$pageTitle='Edit Patient';$pageIcon='fa-user-md';
$eid=intval($_GET['editid']??0);
if(isset($_POST['submit'])){
  $pn=mysqli_real_escape_string($con,$_POST['patname']);
  $pc=mysqli_real_escape_string($con,$_POST['patcontact']);
  $pe=mysqli_real_escape_string($con,$_POST['patemail']);
  $pg=mysqli_real_escape_string($con,$_POST['gender']);
  $pa=mysqli_real_escape_string($con,$_POST['pataddress']);
  $page=mysqli_real_escape_string($con,$_POST['patage']);
  $mh=mysqli_real_escape_string($con,$_POST['medhis']);
  $q=mysqli_query($con,"UPDATE tblpatient SET PatientName='$pn',PatientContno='$pc',PatientEmail='$pe',PatientGender='$pg',PatientAdd='$pa',PatientAge='$page',PatientMedhis='$mh' WHERE ID='$eid'");
  if($q){$msg='Patient updated successfully.';$mtype='success';}
  else{$msg='Something went wrong.';$mtype='error';}
}
$ret=mysqli_query($con,"SELECT * FROM tblpatient WHERE ID='$eid'");
$row=mysqli_fetch_array($ret);
?><!DOCTYPE html><html lang="en"><head><title>Edit Patient — HMS+ Doctor</title><?php include('include/head.php');?></head><body>
<div id="app"><?php include('include/sidebar.php');?>
<div class="app-content"><?php include('include/header.php');?>
<div class="main-content">
<div class="doc-breadcrumb"><i class="fa fa-home"></i><a href="dashboard.php">Dashboard</a><span class="sep">/</span><a href="manage-patient.php">Patients</a><span class="sep">/</span><span class="cur">Edit Patient</span></div>
<?php if(!empty($msg)):?><div class="doc-alert doc-alert-<?php echo $mtype;?>"><i class="fa fa-<?php echo $mtype==='success'?'check-circle':'exclamation-circle';?>"></i><?php echo htmlspecialchars($msg);?></div><?php endif;?>
<?php if($row):?>
<div class="row justify-content-center"><div class="col-lg-7 col-md-10">
<div class="doc-card">
  <div class="doc-card-header"><div class="ch-left"><i class="fa fa-user-md"></i><h5>Edit: <?php echo htmlspecialchars($row['PatientName']);?></h5></div>
    <small style="color:var(--muted)">Registered: <?php echo htmlspecialchars($row['CreationDate']);?></small>
  </div>
  <div class="doc-card-body">
  <form method="post">
    <div class="row">
      <div class="col-md-6"><div class="doc-fg"><label>Patient Name</label><input type="text" name="patname" class="doc-input" value="<?php echo htmlspecialchars($row['PatientName']);?>" required></div></div>
      <div class="col-md-6"><div class="doc-fg"><label>Contact Number</label><input type="text" name="patcontact" class="doc-input" value="<?php echo htmlspecialchars($row['PatientContno']);?>" required maxlength="10" pattern="[0-9]+"></div></div>
    </div>
    <div class="doc-fg"><label>Email Address</label><input type="email" name="patemail" class="doc-input" value="<?php echo htmlspecialchars($row['PatientEmail']);?>" readonly></div>
    <div class="doc-fg">
      <label>Gender</label>
      <div style="padding:12px 16px;background:#f8fafc;border:1.5px solid var(--border);border-radius:10px;">
        <div class="gender-row">
          <label class="gender-opt"><input type="radio" name="gender" value="Male" <?php echo $row['PatientGender']=='Male'?'checked':'';?>> Male</label>
          <label class="gender-opt"><input type="radio" name="gender" value="Female" <?php echo $row['PatientGender']=='Female'?'checked':'';?>> Female</label>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6"><div class="doc-fg"><label>Age</label><input type="text" name="patage" class="doc-input" value="<?php echo htmlspecialchars($row['PatientAge']);?>" required></div></div>
      <div class="col-md-6"><div class="doc-fg"><label>Address</label><input type="text" name="pataddress" class="doc-input" value="<?php echo htmlspecialchars($row['PatientAdd']);?>" required></div></div>
    </div>
    <div class="doc-fg"><label>Medical History</label><textarea name="medhis" class="doc-input"><?php echo htmlspecialchars($row['PatientMedhis']);?></textarea></div>
    <button type="submit" name="submit" class="btn-doc btn-doc-primary"><i class="fa fa-save"></i> Update Patient</button>
    <a href="manage-patient.php" class="btn-doc btn-doc-outline" style="margin-left:10px">Cancel</a>
  </form>
  </div>
</div>
</div></div>
<?php else:?><div class="doc-alert doc-alert-error"><i class="fa fa-exclamation-circle"></i>Patient not found.</div><?php endif;?>
</div><?php include('include/footer.php');?></div></div>
<?php include('include/scripts.php');?></body></html>
