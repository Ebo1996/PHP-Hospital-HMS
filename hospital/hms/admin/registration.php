<?php
session_start();
error_reporting(0);
include_once('include/config.php');

if(isset($_POST['submit'])){
  $fname  = mysqli_real_escape_string($con,$_POST['full_name']);
  $address= mysqli_real_escape_string($con,$_POST['address']);
  $city   = mysqli_real_escape_string($con,$_POST['city']);
  $gender = mysqli_real_escape_string($con,$_POST['gender']);
  $email  = mysqli_real_escape_string($con,$_POST['email']);
  $password = md5($_POST['password']);
  $q = mysqli_query($con,"INSERT INTO users(fullname,address,city,gender,email,password) VALUES('$fname','$address','$city','$gender','$email','$password')");
  if($q){ $ok='Registration successful! You can now login.'; }
  else  { $err='Something went wrong. Please try again.'; }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>User Registration — HMS</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
  <style>
    *{box-sizing:border-box;margin:0;padding:0;}
    body{font-family:'Poppins',sans-serif;min-height:100vh;display:flex;align-items:center;justify-content:center;
         background:linear-gradient(135deg,#1a1a2e 0%,#16213e 50%,#0f3460 100%);padding:30px 16px;}
    .reg-wrap{width:100%;max-width:520px;}
    .reg-card{background:#fff;border-radius:24px;padding:40px 38px;box-shadow:0 30px 80px rgba(0,0,0,0.35);}
    .reg-logo{text-align:center;margin-bottom:28px;}
    .reg-logo .logo-icon{width:60px;height:60px;background:linear-gradient(135deg,#ee9b00,#cc8400);border-radius:16px;
                          display:inline-flex;align-items:center;justify-content:center;font-size:1.6rem;color:#fff;margin-bottom:12px;}
    .reg-logo h2{font-size:1.3rem;font-weight:700;color:#0d1b2a;margin-bottom:4px;}
    .reg-logo p{font-size:0.82rem;color:#6c757d;}
    .form-group{margin-bottom:16px;}
    .form-group label{font-size:0.8rem;font-weight:600;color:#0d1b2a;display:block;margin-bottom:5px;}
    .input-wrap{position:relative;}
    .input-wrap i.ic{position:absolute;left:13px;top:50%;transform:translateY(-50%);color:#94a3b8;font-size:0.88rem;pointer-events:none;}
    .input-wrap input{width:100%;border:1.5px solid #e2e8f0;border-radius:11px;padding:11px 14px 11px 38px;
                      font-size:0.87rem;font-family:'Poppins',sans-serif;transition:all 0.3s;background:#f8fafc;color:#0d1b2a;}
    .input-wrap input:focus{outline:none;border-color:#ee9b00;background:#fff;box-shadow:0 0 0 3px rgba(238,155,0,0.12);}
    .gender-row{display:flex;gap:16px;}
    .gender-opt{display:flex;align-items:center;gap:6px;font-size:0.85rem;color:#0d1b2a;cursor:pointer;}
    .gender-opt input{accent-color:#ee9b00;width:16px;height:16px;}
    .btn-reg{width:100%;background:linear-gradient(135deg,#ee9b00,#cc8400);color:#fff;border:none;border-radius:12px;
             padding:13px;font-size:0.93rem;font-weight:600;font-family:'Poppins',sans-serif;cursor:pointer;
             transition:all 0.3s;margin-top:6px;}
    .btn-reg:hover{transform:translateY(-2px);box-shadow:0 8px 25px rgba(238,155,0,0.4);}
    .alert-ok {background:#d1fae5;border:1px solid #6ee7b7;color:#065f46;border-radius:10px;padding:10px 14px;font-size:0.83rem;margin-bottom:16px;display:flex;align-items:center;gap:8px;}
    .alert-err{background:#fff0f0;border:1px solid #fecaca;color:#dc2626;border-radius:10px;padding:10px 14px;font-size:0.83rem;margin-bottom:16px;display:flex;align-items:center;gap:8px;}
    .login-link{text-align:center;margin-top:18px;font-size:0.83rem;color:#6c757d;}
    .login-link a{color:#ee9b00;font-weight:600;}
    .login-link a:hover{color:#cc8400;}
    .back-home{text-align:center;margin-top:14px;}
    .back-home a{color:rgba(255,255,255,0.7);font-size:0.82rem;text-decoration:none;}
    .back-home a:hover{color:#fff;}
    .divider-text{text-align:center;font-size:.75rem;color:#94a3b8;margin:14px 0 16px;letter-spacing:.3px;}
    .row-2{display:grid;grid-template-columns:1fr 1fr;gap:14px;}
  </style>
</head>
<body>
<div class="reg-wrap">
  <div class="reg-card">
    <div class="reg-logo">
      <div class="logo-icon"><i class="fa fa-user-plus"></i></div>
      <h2>HMS<span style="color:#ee9b00">+</span> Registration</h2>
      <p>Create your patient account</p>
    </div>

    <?php if(!empty($ok)):?>
    <div class="alert-ok"><i class="fa fa-check-circle"></i><?php echo htmlspecialchars($ok);?></div>
    <?php endif;?>
    <?php if(!empty($err)):?>
    <div class="alert-err"><i class="fa fa-exclamation-circle"></i><?php echo htmlspecialchars($err);?></div>
    <?php endif;?>

    <form method="post" autocomplete="off">

      <div class="divider-text">Personal Details</div>

      <div class="form-group">
        <label>Full Name</label>
        <div class="input-wrap">
          <i class="fa fa-user ic"></i>
          <input type="text" name="full_name" placeholder="Your full name" required>
        </div>
      </div>

      <div class="row-2">
        <div class="form-group">
          <label>City</label>
          <div class="input-wrap">
            <i class="fa fa-map-marker ic"></i>
            <input type="text" name="city" placeholder="City" required>
          </div>
        </div>
        <div class="form-group">
          <label>Gender</label>
          <div style="padding:11px 14px;background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:11px;">
            <div class="gender-row">
              <label class="gender-opt"><input type="radio" name="gender" value="Male" required> Male</label>
              <label class="gender-opt"><input type="radio" name="gender" value="Female"> Female</label>
            </div>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label>Address</label>
        <div class="input-wrap">
          <i class="fa fa-home ic"></i>
          <input type="text" name="address" placeholder="Full address" required>
        </div>
      </div>

      <div class="divider-text">Account Details</div>

      <div class="form-group">
        <label>Email Address</label>
        <div class="input-wrap">
          <i class="fa fa-envelope ic"></i>
          <input type="email" name="email" id="email" placeholder="you@email.com" required onblur="checkEmail()">
        </div>
        <span id="email-status" style="font-size:.76rem;margin-top:4px;display:block;"></span>
      </div>

      <div class="row-2">
        <div class="form-group">
          <label>Password</label>
          <div class="input-wrap">
            <i class="fa fa-lock ic"></i>
            <input type="password" name="password" id="password" placeholder="Min. 6 characters" required>
          </div>
        </div>
        <div class="form-group">
          <label>Confirm Password</label>
          <div class="input-wrap">
            <i class="fa fa-lock ic"></i>
            <input type="password" name="password_again" id="password_again" placeholder="Repeat password" required>
          </div>
        </div>
      </div>

      <button type="submit" name="submit" class="btn-reg" onclick="return validate()">
        <i class="fa fa-user-plus"></i> Create Account
      </button>
    </form>

    <div class="login-link">Already have an account? <a href="../user-login.php">Sign In</a></div>
  </div>
  <div class="back-home"><a href="../../index.php"><i class="fa fa-arrow-left"></i> Back to Home</a></div>
</div>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script>
function checkEmail(){
  $.post('check_availability.php',{emailid:$('#email').val()},function(d){$('#email-status').html(d);});
}
function validate(){
  var p=$('#password').val(),c=$('#password_again').val();
  if(p.length<6){alert('Password must be at least 6 characters.');return false;}
  if(p!==c){alert('Passwords do not match.');return false;}
  return true;
}
</script>
</body>
</html>
