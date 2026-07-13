<?php
session_start();
include('include/config.php');
include('include/checklogin.php');
check_login();
$pageTitle = 'Change Password';
$pageIcon  = 'fa-lock';
$msg = ''; $msgType = '';

if(isset($_POST['submit'])){
    $cpass = md5($_POST['cpass']);
    $npass = $_POST['npass'];
    $cfpass= $_POST['cfpass'];
    if($npass !== $cfpass){
        $msg = 'New password and confirm password do not match.'; $msgType='error';
    } elseif(strlen($npass) < 6){
        $msg = 'New password must be at least 6 characters.'; $msgType='error';
    } else {
        $chk = mysqli_query($con,"SELECT id FROM users WHERE password='$cpass' AND id='".$_SESSION['id']."'");
        if(mysqli_num_rows($chk) > 0){
            $hash = md5($npass);
            mysqli_query($con,"UPDATE users SET password='$hash' WHERE id='".$_SESSION['id']."'");
            $msg = 'Password changed successfully!'; $msgType='success';
        } else {
            $msg = 'Current password is incorrect.'; $msgType='error';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Change Password — HMS+</title>
  <?php include('include/head.php'); ?>
</head>
<body>
<div id="app">
  <?php include('include/sidebar.php'); ?>
  <div class="app-content">
    <?php include('include/header.php'); ?>
    <div class="main-content">

      <div class="hms-breadcrumb">
        <i class="fa fa-home"></i><a href="dashboard.php">Dashboard</a>
        <span class="sep">/</span><span class="current">Change Password</span>
      </div>

      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">

          <!-- Security tip card -->
          <div style="background:linear-gradient(135deg,var(--teal-dark),var(--teal));border-radius:16px;padding:20px 24px;margin-bottom:24px;display:flex;align-items:center;gap:14px;">
            <div style="width:44px;height:44px;background:rgba(255,255,255,0.15);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.2rem;color:#fff;flex-shrink:0;">
              <i class="fa fa-shield"></i>
            </div>
            <div>
              <div style="color:#fff;font-weight:700;font-size:0.9rem;">Security Tip</div>
              <div style="color:rgba(255,255,255,0.8);font-size:0.78rem;margin-top:2px;">Use at least 8 characters with a mix of letters and numbers.</div>
            </div>
          </div>

          <?php if($msg): ?>
          <div class="hms-alert <?php echo $msgType==='success'?'hms-alert-success':'hms-alert-error'; ?>">
            <i class="fa <?php echo $msgType==='success'?'fa-check-circle':'fa-exclamation-circle'; ?>"></i>
            <?php echo htmlspecialchars($msg); ?>
          </div>
          <?php endif; ?>

          <div class="hms-card">
            <div class="hms-card-header">
              <i class="fa fa-lock"></i><h5>Update Password</h5>
            </div>
            <div class="hms-card-body">
              <form method="post" onsubmit="return validatePwd()">

                <div class="hms-form-group">
                  <label>Current Password</label>
                  <div style="position:relative;">
                    <i class="fa fa-lock" style="position:absolute;left:14px;top:50%;transform:translateY(-50%);color:var(--muted);"></i>
                    <input type="password" name="cpass" id="cpass" class="hms-input" style="padding-left:38px;" placeholder="Enter current password" required>
                  </div>
                </div>

                <div class="hms-form-group">
                  <label>New Password</label>
                  <div style="position:relative;">
                    <i class="fa fa-key" style="position:absolute;left:14px;top:50%;transform:translateY(-50%);color:var(--muted);"></i>
                    <input type="password" name="npass" id="npass" class="hms-input" style="padding-left:38px;" placeholder="Enter new password (min 6 chars)" required>
                  </div>
                </div>

                <div class="hms-form-group">
                  <label>Confirm New Password</label>
                  <div style="position:relative;">
                    <i class="fa fa-check-circle" style="position:absolute;left:14px;top:50%;transform:translateY(-50%);color:var(--muted);"></i>
                    <input type="password" name="cfpass" id="cfpass" class="hms-input" style="padding-left:38px;" placeholder="Repeat new password" required>
                  </div>
                </div>

                <!-- Password strength indicator -->
                <div id="strengthBar" style="height:4px;border-radius:4px;background:#e0eeee;margin-bottom:18px;overflow:hidden;">
                  <div id="strengthFill" style="height:100%;width:0;border-radius:4px;transition:all 0.3s;"></div>
                </div>
                <div id="strengthText" style="font-size:0.76rem;color:var(--muted);margin-top:-14px;margin-bottom:16px;"></div>

                <button type="submit" name="submit" class="btn-hms btn-hms-primary" style="width:100%;justify-content:center;">
                  <i class="fa fa-save"></i> Update Password
                </button>
              </form>
            </div>
          </div>

        </div>
      </div>
    </div>
    <?php include('include/footer.php'); ?>
  </div>
</div>
<?php include('include/scripts.php'); ?>
<script>
// Password strength
document.getElementById('npass').addEventListener('input', function(){
  var v=this.value, s=0, t='', c='#e63946';
  if(v.length>=6) s++;
  if(/[A-Z]/.test(v)) s++;
  if(/[0-9]/.test(v)) s++;
  if(/[^A-Za-z0-9]/.test(v)) s++;
  var w=['0%','25%','50%','75%','100%'][s];
  var colors=['#e63946','#ee9b00','#f4a261','#2d6a4f','#0a9396'];
  var labels=['','Weak','Fair','Good','Strong'];
  document.getElementById('strengthFill').style.width=w;
  document.getElementById('strengthFill').style.background=colors[s];
  document.getElementById('strengthText').textContent=labels[s]?'Strength: '+labels[s]:'';
  document.getElementById('strengthText').style.color=colors[s];
});
function validatePwd(){
  var n=document.getElementById('npass').value;
  var c=document.getElementById('cfpass').value;
  if(n.length<6){alert('Password must be at least 6 characters.');return false;}
  if(n!==c){alert('Passwords do not match.');return false;}
  return true;
}
</script>
</body>
</html>
