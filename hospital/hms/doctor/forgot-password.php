<?php
session_start();error_reporting(0);include("include/config.php");
if(isset($_POST['submit'])){
  $contactno=mysqli_real_escape_string($con,$_POST['contactno']);
  $email=mysqli_real_escape_string($con,$_POST['email']);
  $q=mysqli_query($con,"SELECT id FROM doctors WHERE contactno='$contactno' AND docEmail='$email'");
  if(mysqli_num_rows($q)>0){
    $_SESSION['cnumber']=$contactno;$_SESSION['email']=$email;
    header('location:reset-password.php');exit();
  } else{$err='Invalid details. Please try again.';}
}
?><!DOCTYPE html><html lang="en">
<head><title>Doctor Password Recovery — HMS</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
<style>
  *{box-sizing:border-box;margin:0;padding:0;}
  body{font-family:'Poppins',sans-serif;min-height:100vh;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#012a4a,#013a63,#0077b6);padding:20px;}
  .wrap{width:100%;max-width:420px;}
  .card{background:#fff;border-radius:24px;padding:40px 38px;box-shadow:0 30px 80px rgba(0,0,0,0.3);}
  .logo{text-align:center;margin-bottom:28px;}
  .logo-icon{width:60px;height:60px;background:linear-gradient(135deg,#0085bc,#003f72);border-radius:16px;display:inline-flex;align-items:center;justify-content:center;font-size:1.6rem;color:#fff;margin-bottom:12px;}
  .logo h2{font-size:1.3rem;font-weight:700;color:#0d1b2a;margin-bottom:4px;}
  .logo p{font-size:0.85rem;color:#6c757d;}
  .fg{margin-bottom:18px;}
  .fg label{font-size:0.9rem;font-weight:600;color:#0d1b2a;display:block;margin-bottom:6px;}
  .iw{position:relative;}
  .iw i{position:absolute;left:13px;top:50%;transform:translateY(-50%);color:#94a3b8;font-size:.9rem;}
  .iw input{width:100%;border:1.5px solid #e2e8f0;border-radius:11px;padding:12px 14px 12px 38px;font-size:0.9rem;font-family:'Poppins',sans-serif;transition:all .3s;background:#f8fafc;}
  .iw input:focus{outline:none;border-color:#0077b6;background:#fff;box-shadow:0 0 0 3px rgba(0,119,182,.12);}
  .btn-sub{width:100%;background:linear-gradient(135deg,#0085bc,#003f72);color:#fff;border:none;border-radius:12px;padding:13px;font-size:0.95rem;font-weight:600;font-family:'Poppins',sans-serif;cursor:pointer;transition:all .3s;margin-top:4px;}
  .btn-sub:hover{transform:translateY(-2px);box-shadow:0 8px 25px rgba(0,119,182,.4);}
  .err{background:#fff0f0;border:1px solid #fecaca;color:#dc2626;border-radius:10px;padding:10px 14px;font-size:0.88rem;margin-bottom:18px;display:flex;align-items:center;gap:8px;}
  .links{text-align:center;margin-top:18px;font-size:0.88rem;color:#6c757d;}
  .links a{color:#0077b6;font-weight:600;}
  .back{text-align:center;margin-top:14px;}
  .back a{color:rgba(255,255,255,.7);font-size:.85rem;text-decoration:none;}
  .back a:hover{color:#fff;}
</style>
</head>
<body>
<div class="wrap">
  <div class="card">
    <div class="logo">
      <div class="logo-icon"><i class="fa fa-lock"></i></div>
      <h2>Password Recovery</h2>
      <p>Doctor Portal — HMS+</p>
    </div>
    <?php if(!empty($err)):?><div class="err"><i class="fa fa-exclamation-circle"></i><?php echo htmlspecialchars($err);?></div><?php endif;?>
    <form method="post">
      <div class="fg"><label>Registered Contact Number</label>
        <div class="iw"><i class="fa fa-phone"></i><input type="text" name="contactno" placeholder="Your contact number" required></div>
      </div>
      <div class="fg"><label>Registered Email</label>
        <div class="iw"><i class="fa fa-envelope"></i><input type="email" name="email" placeholder="Your email address" required></div>
      </div>
      <button type="submit" name="submit" class="btn-sub"><i class="fa fa-arrow-circle-right"></i> Reset Password</button>
    </form>
    <div class="links">Remember your password? <a href="index.php">Sign In</a></div>
  </div>
  <div class="back"><a href="../../index.php"><i class="fa fa-arrow-left"></i> Back to Home</a></div>
</div>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
</body></html>
