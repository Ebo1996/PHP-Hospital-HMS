<?php
session_start();error_reporting(0);include('include/config.php');include('include/auth.php');
$pageTitle='Add Patient';$pageIcon='fa-user-plus';
if(isset($_POST['submit'])){
  $docid=$_SESSION['id'];
  $pn=mysqli_real_escape_string($con,$_POST['patname']);
  $pc=mysqli_real_escape_string($con,$_POST['patcontact']);
  $pe=mysqli_real_escape_string($con,$_POST['patemail']);
  $pg=mysqli_real_escape_string($con,$_POST['gender']);
  $pa=mysqli_real_escape_string($con,$_POST['pataddress']);
  $page=mysqli_real_escape_string($con,$_POST['patage']);
  $mh=mysqli_real_escape_string($con,$_POST['medhis']);
  $q=mysqli_query($con,"INSERT INTO tblpatient(Docid,PatientName,PatientContno,PatientEmail,PatientGender,PatientAdd,PatientAge,PatientMedhis) VALUES('$docid','$pn','$pc','$pe','$pg','$pa','$page','$mh')");
  if($q){header('location:manage-patient.php');exit();}
  else{$err='Something went wrong. Please try again.';}
}
?><!DOCTYPE html><html lang="en"><head><title>Add Patient — HMS+ Doctor</title><?php include('include/head.php');?></head><body>
<div id="app"><?php include('include/sidebar.php');?>
<div class="app-content"><?php include('include/header.php');?>
<div class="main-content">
<div class="doc-breadcrumb"><i class="fa fa-home"></i><a href="dashboard.php">Dashboard</a><span class="sep">/</span><a href="manage-patient.php">Patients</a><span class="sep">/</span><span class="cur">Add Patient</span></div>
<?php if(!empty($err)):?><div class="doc-alert doc-alert-error"><i class="fa fa-exclamation-circle"></i><?php echo htmlspecialchars($err);?></div><?php endif;?>
<div class="row justify-content-center"><div class="col-lg-7 col-md-10">
<div class="doc-card">
  <div class="doc-card-header"><div class="ch-left"><i class="fa fa-user-plus"></i><h5>New Patient Registration</h5></div></div>
  <div class="doc-card-body">
  <form method="post">
    <div class="row">
      <div class="col-md-6"><div class="doc-fg"><label>Patient Name</label><input type="text" name="patname" class="doc-input" placeholder="Full name" required></div></div>
      <div class="col-md-6"><div class="doc-fg"><label>Contact Number</label><input type="text" name="patcontact" class="doc-input" placeholder="Phone" required maxlength="10" pattern="[0-9]+"></div></div>
    </div>
    <div class="doc-fg">
      <label>Email Address</label>
      <input type="email" id="patemail" name="patemail" class="doc-input" placeholder="patient@email.com" required onblur="chkEmail()">
      <span id="email-status" style="font-size:.8rem;margin-top:4px;display:block;"></span>
    </div>
    <div class="doc-fg">
      <label>Gender</label>
      <div style="padding:12px 16px;background:#f8fafc;border:1.5px solid var(--border);border-radius:10px;">
        <div class="gender-row">
          <label class="gender-opt"><input type="radio" name="gender" value="Male" required> Male</label>
          <label class="gender-opt"><input type="radio" name="gender" value="Female"> Female</label>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6"><div class="doc-fg"><label>Age</label><input type="text" name="patage" class="doc-input" placeholder="Age" required></div></div>
      <div class="col-md-6"><div class="doc-fg"><label>Address</label><input type="text" name="pataddress" class="doc-input" placeholder="Full address" required></div></div>
    </div>
    <div class="doc-fg"><label>Medical History (if any)</label><textarea name="medhis" class="doc-input" placeholder="Pre-existing conditions, allergies..."></textarea></div>
    <button type="submit" name="submit" id="submit" class="btn-doc btn-doc-primary"><i class="fa fa-save"></i> Save Patient</button>
    <a href="manage-patient.php" class="btn-doc btn-doc-outline" style="margin-left:10px">Cancel</a>
  </form>
  </div>
</div>
</div></div>
</div><?php include('include/footer.php');?></div></div>
<?php include('include/scripts.php');?>
<script>
function chkEmail(){$.post('check_availability.php',{email:$('#patemail').val()},function(d){$('#email-status').html(d);});}
</script>
</body></html>
