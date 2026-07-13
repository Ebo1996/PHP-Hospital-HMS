<?php
session_start();error_reporting(0);include('include/config.php');include('include/auth.php');
$pageTitle='Change Password';$pageIcon='fa-lock';
$msg='';$mtype='';
if(isset($_POST['submit'])){
  $cp=$_POST['cpass'];$np=$_POST['npass'];$cf=$_POST['cfpass'];
  if($np!==$cf){$msg='New passwords do not match.';$mtype='error';}
  elseif(strlen($np)<6){$msg='New password must be at least 6 characters.';$mtype='error';}
  else{
    $uname=$_SESSION['login'];
    $chk=mysqli_query($con,"SELECT id FROM admin WHERE password='$cp' AND username='$uname'");
    if(mysqli_num_rows($chk)>0){
      mysqli_query($con,"UPDATE admin SET password='$np' WHERE username='$uname'");
      $msg='Password updated successfully!';$mtype='success';
    } else {$msg='Current password is incorrect.';$mtype='error';}
  }
}
?><!DOCTYPE html><html lang="en"><head><title>Change Password — HMS+ Admin</title><?php include('include/head.php');?></head><body>
<div id="app"><?php include('include/sidebar.php');?>
<div class="app-content"><?php include('include/header.php');?>
<div class="main-content">
<div class="adm-breadcrumb"><i class="fa fa-home"></i><a href="dashboard.php">Dashboard</a><span class="sep">/</span><span class="cur">Change Password</span></div>
<div class="row justify-content-center"><div class="col-lg-5 col-md-8">
<div style="background:linear-gradient(135deg,var(--dark),var(--dark2));border-radius:14px;padding:18px 22px;margin-bottom:22px;display:flex;align-items:center;gap:14px;">
  <div style="width:44px;height:44px;background:rgba(238,155,0,.2);border-radius:12px;display:flex;align-items:center;justify-content:center;color:var(--amber);font-size:1.2rem;"><i class="fa fa-shield"></i></div>
  <div><div style="color:#fff;font-weight:700;font-size:.88rem;">Security Note</div><div style="color:rgba(255,255,255,.6);font-size:.76rem;margin-top:2px;">Admin passwords are stored as plain text. Use a strong, unique password.</div></div>
</div>
<?php if($msg):?><div class="adm-alert adm-alert-<?php echo $mtype==='success'?'success':'error';?>"><i class="fa fa-<?php echo $mtype==='success'?'check-circle':'exclamation-circle';?>"></i><?php echo htmlspecialchars($msg);?></div><?php endif;?>
<div class="adm-card">
  <div class="adm-card-header"><div class="ch-left"><i class="fa fa-lock"></i><h5>Update Password</h5></div></div>
  <div class="adm-card-body">
  <form method="post" onsubmit="return chkPwd()">
    <div class="adm-fg"><label>Current Password</label>
      <div style="position:relative"><i class="fa fa-lock" style="position:absolute;left:13px;top:50%;transform:translateY(-50%);color:var(--muted)"></i>
      <input type="password" name="cpass" class="adm-input" style="padding-left:36px" placeholder="Enter current password" required></div>
    </div>
    <div class="adm-fg"><label>New Password</label>
      <div style="position:relative"><i class="fa fa-key" style="position:absolute;left:13px;top:50%;transform:translateY(-50%);color:var(--muted)"></i>
      <input type="password" name="npass" id="npass" class="adm-input" style="padding-left:36px" placeholder="Min. 6 characters" required onkeyup="pwdStrength(this.value)"></div>
      <div style="height:4px;border-radius:4px;background:#eee;margin-top:6px;overflow:hidden"><div id="sbar" style="height:100%;width:0;border-radius:4px;transition:all .3s"></div></div>
      <div id="slbl" style="font-size:.73rem;margin-top:3px;"></div>
    </div>
    <div class="adm-fg"><label>Confirm New Password</label>
      <div style="position:relative"><i class="fa fa-check-circle" style="position:absolute;left:13px;top:50%;transform:translateY(-50%);color:var(--muted)"></i>
      <input type="password" name="cfpass" id="cfpass" class="adm-input" style="padding-left:36px" placeholder="Repeat new password" required></div>
    </div>
    <button type="submit" name="submit" class="btn-adm btn-adm-primary" style="width:100%;justify-content:center"><i class="fa fa-save"></i> Update Password</button>
  </form>
  </div>
</div>
</div></div>
</div><?php include('include/footer.php');?></div></div>
<?php include('include/scripts.php');?>
<script>
function pwdStrength(v){var s=0;if(v.length>=6)s++;if(/[A-Z]/.test(v))s++;if(/[0-9]/.test(v))s++;if(/[^A-Za-z0-9]/.test(v))s++;var c=['','#e63946','#ee9b00','#2d6a4f','#0a9396'],l=['','Weak','Fair','Good','Strong'],w=[0,25,50,75,100];document.getElementById('sbar').style.width=w[s]+'%';document.getElementById('sbar').style.background=c[s];document.getElementById('slbl').textContent=l[s]?'Strength: '+l[s]:'';document.getElementById('slbl').style.color=c[s];}
function chkPwd(){var n=document.getElementById('npass').value,c=document.getElementById('cfpass').value;if(n.length<6){alert('Min 6 characters.');return false;}if(n!==c){alert('Passwords do not match.');return false;}return true;}
</script>
</body></html>
