<?php
session_start();
error_reporting(0);
include("include/config.php");

// Guard — must come from forgot-password
if(empty($_SESSION['name']) || empty($_SESSION['email'])){
    header('location:forgot-password.php'); exit();
}

$msg = ''; $msgType = '';
if(isset($_POST['change'])){
    $np  = $_POST['password'];
    $np2 = $_POST['password_again'];
    if(strlen($np) < 6){
        $msg = 'Password must be at least 6 characters.'; $msgType='error';
    } elseif($np !== $np2){
        $msg = 'Passwords do not match.'; $msgType='error';
    } else {
        $name  = mysqli_real_escape_string($con, $_SESSION['name']);
        $email = mysqli_real_escape_string($con, $_SESSION['email']);
        $hash  = md5($np);
        $q = mysqli_query($con,"UPDATE users SET password='$hash' WHERE fullName='$name' AND email='$email'");
        if($q){
            session_unset(); session_destroy();
            echo "<script>alert('Password updated successfully! Please log in.');window.location.href='user-login.php';</script>";
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Reset Password — HMS+</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
  <style>
    :root{--teal:#0a9396;--teal-dark:#005f73;--teal-xl:#e9f5f5;--accent:#ee9b00;--dark:#0d1b2a;--muted:#6c757d;--border:#dde8e8;}
    *{box-sizing:border-box;margin:0;padding:0;}
    body{font-family:'Poppins',sans-serif;min-height:100vh;display:flex;align-items:center;justify-content:center;
         background:linear-gradient(135deg,#003845,#005f73 50%,#0a9396);padding:20px;}
    .blob{position:fixed;border-radius:50%;filter:blur(80px);opacity:0.12;pointer-events:none;}
    .blob-1{width:450px;height:450px;background:#94d2bd;top:-100px;right:-100px;}
    .blob-2{width:300px;height:300px;background:#ee9b00;bottom:-80px;left:-80px;}
    .wrap{width:100%;max-width:420px;position:relative;z-index:2;}
    .card{background:#fff;border-radius:24px;padding:44px 40px;box-shadow:0 30px 80px rgba(0,0,0,0.28);}
    .top{text-align:center;margin-bottom:28px;}
    .logo-icon{width:60px;height:60px;border-radius:16px;background:linear-gradient(135deg,var(--teal),var(--teal-dark));
               display:inline-flex;align-items:center;justify-content:center;color:#fff;font-size:1.5rem;margin-bottom:12px;}
    .top h2{font-size:1.35rem;font-weight:800;color:var(--dark);margin-bottom:4px;}
    .top p{font-size:0.82rem;color:var(--muted);}
    .user-chip{display:inline-flex;align-items:center;gap:8px;background:var(--teal-xl);border-radius:25px;
               padding:8px 16px;font-size:0.82rem;font-weight:600;color:var(--teal-dark);margin-bottom:22px;}
    .user-chip i{color:var(--teal);}
    .fg{margin-bottom:16px;}
    .fg label{font-size:0.8rem;font-weight:600;color:var(--dark);display:block;margin-bottom:5px;}
    .fi-wrap{position:relative;}
    .fi-wrap i.ic{position:absolute;left:14px;top:50%;transform:translateY(-50%);color:var(--muted);font-size:0.9rem;}
    .fi-wrap .toggle-eye{position:absolute;right:14px;top:50%;transform:translateY(-50%);color:var(--muted);
                         cursor:pointer;font-size:0.9rem;background:none;border:none;padding:0;}
    .fi{width:100%;border:1.5px solid var(--border);border-radius:10px;padding:11px 38px;
        font-size:0.88rem;font-family:'Poppins',sans-serif;background:#f8fdfd;transition:all .3s;}
    .fi:focus{outline:none;border-color:var(--teal);background:#fff;box-shadow:0 0 0 3px rgba(10,147,150,0.1);}
    .fi::placeholder{color:#aab8b8;}
    .strength-bar{height:4px;border-radius:4px;background:#e0eeee;margin:8px 0 4px;overflow:hidden;}
    .strength-fill{height:100%;width:0;border-radius:4px;transition:all .3s;}
    .strength-text{font-size:0.74rem;margin-bottom:14px;}
    .err{background:#fee2e2;border:1px solid #fca5a5;color:#991b1b;border-radius:10px;
         padding:10px 14px;font-size:0.83rem;margin-bottom:16px;display:flex;align-items:center;gap:8px;}
    .btn-submit{width:100%;background:linear-gradient(135deg,var(--teal),var(--teal-dark));color:#fff;border:none;
                border-radius:12px;padding:13px;font-size:0.95rem;font-weight:700;font-family:'Poppins',sans-serif;
                cursor:pointer;transition:all .3s;display:flex;align-items:center;justify-content:center;gap:8px;
                box-shadow:0 6px 20px rgba(0,95,115,0.3);}
    .btn-submit:hover{transform:translateY(-2px);box-shadow:0 10px 28px rgba(0,95,115,0.4);}
    .links{text-align:center;margin-top:18px;font-size:0.83rem;color:var(--muted);}
    .links a{color:var(--teal);font-weight:600;}
    .back{text-align:center;margin-top:16px;position:relative;z-index:2;}
    .back a{color:rgba(255,255,255,0.7);font-size:0.82rem;}
    .back a:hover{color:#fff;}
  </style>
</head>
<body>
<div class="blob blob-1"></div>
<div class="blob blob-2"></div>
<div class="wrap">
  <div class="card">
    <div class="top">
      <div class="logo-icon"><i class="fa fa-unlock-alt"></i></div>
      <h2>Set New Password</h2>
      <p>Choose a strong password for your account</p>
    </div>
    <div class="text-center">
      <div class="user-chip">
        <i class="fa fa-user-circle"></i>
        <?php echo htmlspecialchars($_SESSION['name']); ?> &nbsp;&bull;&nbsp;
        <?php echo htmlspecialchars($_SESSION['email']); ?>
      </div>
    </div>

    <?php if($msg): ?>
    <div class="err"><i class="fa fa-exclamation-circle"></i><?php echo htmlspecialchars($msg); ?></div>
    <?php endif; ?>

    <form method="post" onsubmit="return validateReset()">
      <div class="fg">
        <label>New Password</label>
        <div class="fi-wrap">
          <i class="fa fa-lock ic"></i>
          <input type="password" name="password" id="newpwd" class="fi" placeholder="Enter new password" required>
          <button type="button" class="toggle-eye" onclick="togglePwd('newpwd',this)"><i class="fa fa-eye"></i></button>
        </div>
        <div class="strength-bar"><div class="strength-fill" id="sf"></div></div>
        <div class="strength-text" id="st"></div>
      </div>
      <div class="fg">
        <label>Confirm New Password</label>
        <div class="fi-wrap">
          <i class="fa fa-check-circle ic"></i>
          <input type="password" name="password_again" id="conpwd" class="fi" placeholder="Repeat new password" required>
          <button type="button" class="toggle-eye" onclick="togglePwd('conpwd',this)"><i class="fa fa-eye"></i></button>
        </div>
      </div>
      <button type="submit" name="change" class="btn-submit">
        <i class="fa fa-check-circle"></i> Reset Password
      </button>
    </form>
    <div class="links">Back to <a href="user-login.php">Sign in</a></div>
  </div>
  <div class="back"><a href="../index.php"><i class="fa fa-arrow-left"></i> Back to Home</a></div>
</div>
<script>
function togglePwd(id,btn){
  var f=document.getElementById(id);
  var show=f.type==='password';
  f.type=show?'text':'password';
  btn.querySelector('i').className='fa '+(show?'fa-eye-slash':'fa-eye');
}
document.getElementById('newpwd').addEventListener('input',function(){
  var v=this.value,s=0;
  if(v.length>=6)s++;if(/[A-Z]/.test(v))s++;if(/[0-9]/.test(v))s++;if(/[^A-Za-z0-9]/.test(v))s++;
  var colors=['#e63946','#ee9b00','#f4a261','#2d6a4f','#0a9396'];
  var labels=['','Weak','Fair','Good','Strong'];
  document.getElementById('sf').style.width=['0%','25%','50%','75%','100%'][s];
  document.getElementById('sf').style.background=colors[s];
  var st=document.getElementById('st');
  st.textContent=labels[s]?'Strength: '+labels[s]:'';
  st.style.color=colors[s];
});
function validateReset(){
  var p=document.getElementById('newpwd').value;
  var c=document.getElementById('conpwd').value;
  if(p.length<6){alert('Password must be at least 6 characters.');return false;}
  if(p!==c){alert('Passwords do not match.');return false;}
  return true;
}
</script>
</body>
</html>
