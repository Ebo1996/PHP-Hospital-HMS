<?php
session_start();error_reporting(0);include('include/config.php');include('include/auth.php');
$pageTitle='Add Doctor';$pageIcon='fa-user-plus';
if(isset($_POST['submit'])){
  if($_POST['npass']!==$_POST['cfpass']){$err='Passwords do not match.';}
  else{
    $sp=mysqli_real_escape_string($con,$_POST['Doctorspecialization']);
    $dn=mysqli_real_escape_string($con,$_POST['docname']);
    $da=mysqli_real_escape_string($con,$_POST['clinicaddress']);
    $df=mysqli_real_escape_string($con,$_POST['docfees']);
    $dc=mysqli_real_escape_string($con,$_POST['doccontact']);
    $de=mysqli_real_escape_string($con,$_POST['docemail']);
    $pw=md5($_POST['npass']);
    $q=mysqli_query($con,"INSERT INTO doctors(specilization,doctorName,address,docFees,contactno,docEmail,password) VALUES('$sp','$dn','$da','$df','$dc','$de','$pw')");
    if($q){$ok='Doctor added successfully!';} else{$err='Failed to add doctor.';}
  }
}
?><!DOCTYPE html><html lang="en"><head><title>Add Doctor — HMS+ Admin</title><?php include('include/head.php');?></head><body>
<div id="app"><?php include('include/sidebar.php');?>
<div class="app-content"><?php include('include/header.php');?>
<div class="main-content">
<div class="adm-breadcrumb"><i class="fa fa-home"></i><a href="dashboard.php">Dashboard</a><span class="sep">/</span><a href="manage-doctors.php">Doctors</a><span class="sep">/</span><span class="cur">Add Doctor</span></div>
<?php if(!empty($ok)):?><div class="adm-alert adm-alert-success"><i class="fa fa-check-circle"></i><?php echo $ok;?></div><?php endif;?>
<?php if(!empty($err)):?><div class="adm-alert adm-alert-error"><i class="fa fa-exclamation-circle"></i><?php echo $err;?></div><?php endif;?>
<div class="row justify-content-center"><div class="col-lg-7 col-md-10">
<div class="adm-card">
  <div class="adm-card-header"><div class="ch-left"><i class="fa fa-user-plus"></i><h5>New Doctor Registration</h5></div></div>
  <div class="adm-card-body">
  <form method="post">
    <div class="adm-fg"><label>Specialization</label>
      <select name="Doctorspecialization" class="adm-input" required>
        <option value="">— Select —</option>
        <?php $r=mysqli_query($con,"SELECT * FROM doctorspecilization");while($row=mysqli_fetch_array($r)):?>
        <option value="<?php echo htmlspecialchars($row['specilization']);?>"><?php echo htmlspecialchars($row['specilization']);?></option>
        <?php endwhile;?>
      </select>
    </div>
    <div class="row">
      <div class="col-md-6"><div class="adm-fg"><label>Doctor Name</label><input type="text" name="docname" class="adm-input" placeholder="Full name" required></div></div>
      <div class="col-md-6"><div class="adm-fg"><label>Consultancy Fees</label><input type="text" name="docfees" class="adm-input" placeholder="Amount" required></div></div>
    </div>
    <div class="row">
      <div class="col-md-6"><div class="adm-fg"><label>Contact Number</label><input type="text" name="doccontact" class="adm-input" placeholder="Phone" required></div></div>
      <div class="col-md-6"><div class="adm-fg"><label>Email Address</label><input type="email" name="docemail" id="docemail" class="adm-input" placeholder="doctor@email.com" required onblur="chkEmail()"><span id="em-status" style="font-size:.76rem;margin-top:3px;display:block;"></span></div></div>
    </div>
    <div class="adm-fg"><label>Clinic Address</label><textarea name="clinicaddress" class="adm-input" placeholder="Full address" required></textarea></div>
    <div class="row">
      <div class="col-md-6"><div class="adm-fg"><label>Password</label><input type="password" name="npass" class="adm-input" placeholder="Min 6 chars" required></div></div>
      <div class="col-md-6"><div class="adm-fg"><label>Confirm Password</label><input type="password" name="cfpass" class="adm-input" placeholder="Repeat password" required></div></div>
    </div>
    <button type="submit" name="submit" class="btn-adm btn-adm-primary"><i class="fa fa-save"></i> Save Doctor</button>
    <a href="manage-doctors.php" class="btn-adm btn-adm-outline" style="margin-left:10px">Cancel</a>
  </form>
  </div>
</div>
</div></div>
</div><?php include('include/footer.php');?></div></div>
<?php include('include/scripts.php');?>
<script>
function chkEmail(){
  $.post('check_availability.php',{emailid:$('#docemail').val()},function(d){$('#em-status').html(d);});
}
</script>
</body></html>
