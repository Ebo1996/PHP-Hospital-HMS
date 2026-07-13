<?php
session_start();error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
$pageTitle = 'Change Email';
$pageIcon  = 'fa-envelope';
if(isset($_POST['submit'])){
  $email = mysqli_real_escape_string($con, trim($_POST['email']));
  $chk   = mysqli_query($con,"SELECT id FROM users WHERE email='$email' AND id!='".$_SESSION['id']."'");
  if(mysqli_num_rows($chk)>0){$msg='This email is already in use.';$mtype='error';}
  else{
    mysqli_query($con,"UPDATE users SET email='$email' WHERE id='".$_SESSION['id']."'");
    $_SESSION['login']=$email;
    $msg='Email updated successfully.';$mtype='success';
  }
}
?><!DOCTYPE html><html lang="en"><head><title>Change Email — HMS+</title>
<?php include('include/head.php');?></head><body>
<div id="app"><?php include('include/sidebar.php');?>
<div class="app-content"><?php include('include/header.php');?>
<div class="main-content">
<div class="hms-breadcrumb">
  <i class="fa fa-home"></i><a href="dashboard.php">Dashboard</a>
  <span class="sep">/</span><a href="edit-profile.php">My Profile</a>
  <span class="sep">/</span><span class="current">Change Email</span>
</div>
<?php if(!empty($msg)):?>
<div class="hms-alert hms-alert-<?php echo $mtype;?>">
  <i class="fa fa-<?php echo $mtype==='success'?'check-circle':'exclamation-circle';?>"></i>
  <?php echo htmlspecialchars($msg);?>
</div>
<?php endif;?>
<div class="row justify-content-center"><div class="col-lg-5 col-md-7">
<div class="hms-card">
  <div class="hms-card-header">
    <i class="fa fa-envelope"></i><h5>Change Email Address</h5>
  </div>
  <div class="hms-card-body">
    <div style="background:var(--teal-xlight);border-radius:10px;padding:14px 16px;margin-bottom:20px;font-size:0.88rem;color:var(--teal-dark);display:flex;align-items:flex-start;gap:10px;">
      <i class="fa fa-info-circle" style="margin-top:2px;flex-shrink:0;"></i>
      <span>Changing your email will update your login credentials. You'll need to use the new email to sign in next time.</span>
    </div>
    <form method="post">
      <div class="hms-form-group">
        <label>New Email Address</label>
        <div style="position:relative;">
          <i class="fa fa-envelope" style="position:absolute;left:14px;top:50%;transform:translateY(-50%);color:var(--muted);"></i>
          <input type="email" name="email" id="emailField" class="hms-input" style="padding-left:38px;"
                 placeholder="new@email.com" required onblur="checkEmailAvail()">
        </div>
        <span id="av-status" style="font-size:0.8rem;margin-top:4px;display:block;"></span>
      </div>
      <button type="submit" name="submit" id="submit" class="btn-hms btn-hms-primary" style="width:100%;justify-content:center;">
        <i class="fa fa-save"></i> Update Email
      </button>
      <a href="edit-profile.php" class="btn-hms btn-hms-outline" style="width:100%;justify-content:center;margin-top:10px;">
        Cancel
      </a>
    </form>
  </div>
</div>
</div></div>
</div><?php include('include/footer.php');?></div></div>
<?php include('include/scripts.php');?>
<script>
function checkEmailAvail(){
  var e=$('#emailField').val().trim(), s=$('#av-status');
  if(e.length<4){s.html('');return;}
  s.html('<span style="color:var(--muted)"><i class="fa fa-spinner fa-spin"></i> Checking…</span>');
  $.post('check_availability.php',{email:e},function(d){s.html(d);});
}
</script>
</body></html>
