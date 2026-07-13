<?php
session_start();error_reporting(0);include('include/config.php');include('include/auth.php');
$pageTitle='Change Password';$pageIcon='fa-lock';
if(isset($_POST['submit'])){
  $cp=md5($_POST['cpass']);
  $np=md5($_POST['npass']);
  $cf=$_POST['cfpass'];
  if($_POST['npass']!==$cf){$msg='New passwords do not match.';$mtype='error';}
  else{
    $did=$_SESSION['id'];
    $chk=mysqli_query($con,"SELECT id FROM doctors WHERE password='$cp' AND id='$did'");
    if(mysqli_num_rows($chk)>0){
      mysqli_query($con,"UPDATE doctors SET password='$np' WHERE id='$did'");
      $msg='Password changed successfully!';$mtype='success';
    } else{$msg='Current password is incorrect.';$mtype='error';}
  }
}
?><!DOCTYPE html><html lang="en"><head><title>Change Password — HMS+ Doctor</title><?php include('include/head.php');?></head><body>
<div id="app"><?php include('include/sidebar.php');?>
<div class="app-content"><?php include('include/header.php');?>
<div class="main-content">
<div class="doc-breadcrumb"><i class="fa fa-home"></i><a href="dashboard.php">Dashboard</a><span class="sep">/</span><span class="cur">Change Password</span></div>
<?php if(!empty($msg)):?><div class="doc-alert doc-alert-<?php echo $mtype;?>"><i class="fa fa-<?php echo $mtype==='success'?'check-circle':'exclamation-circle';?>"></i><?php echo htmlspecialchars($msg);?></div><?php endif;?>
<div class="row justify-content-center"><div class="col-lg-5 col-md-7">
<div class="doc-card">
  <div class="doc-card-header"><div class="ch-left"><i class="fa fa-lock"></i><h5>Update Password</h5></div></div>
  <div class="doc-card-body">
  <form method="post" onsubmit="return chkPwd()">
    <div class="doc-fg"><label>Current Password</label>
      <div style="position:relative"><i class="fa fa-lock" style="position:absolute;left:13px;top:50%;transform:translateY(-50%);color:var(--muted)"></i>
      <input type="password" name="cpass" class="doc-input" style="padding-left:36px" placeholder="Enter current password" required></div>
    </div>
    <div class="doc-fg"><label>New Password</label>
      <div style="position:relative"><i class="fa fa-key" style="position:absolute;left:13px;top:50%;transform:translateY(-50%);color:var(--muted)"></i>
      <input type="password" name="npass" id="npass" class="doc-input" style="padding-left:36px" placeholder="Min. 6 characters" required></div>
    </div>
    <div class="doc-fg"><label>Confirm New Password</label>
      <div style="position:relative"><i class="fa fa-check-circle" style="position:absolute;left:13px;top:50%;transform:translateY(-50%);color:var(--muted)"></i>
      <input type="password" name="cfpass" id="cfpass" class="doc-input" style="padding-left:36px" placeholder="Repeat new password" required></div>
    </div>
    <button type="submit" name="submit" class="btn-doc btn-doc-primary" style="width:100%;justify-content:center"><i class="fa fa-save"></i> Change Password</button>
  </form>
  </div>
</div>
</div></div>
</div><?php include('include/footer.php');?></div></div>
<?php include('include/scripts.php');?>
<script>
function chkPwd(){var n=$('#npass').val(),c=$('#cfpass').val();if(n.length<6){alert('Min 6 characters.');return false;}if(n!==c){alert('Passwords do not match.');return false;}return true;}
</script>
</body></html>
