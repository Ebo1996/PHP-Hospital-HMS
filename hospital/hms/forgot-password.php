<?php
session_start();
error_reporting(0);
include("include/config.php");
$msg = ''; $msgType = '';

if(isset($_POST['submit'])){
    $name  = mysqli_real_escape_string($con, trim($_POST['fullname']));
    $email = mysqli_real_escape_string($con, trim($_POST['email']));
    $query = mysqli_query($con,"SELECT id FROM users WHERE fullName='$name' AND email='$email'");
    if(mysqli_num_rows($query) > 0){
        $_SESSION['name']  = $name;
        $_SESSION['email'] = $email;
        header('location:reset-password.php');
        exit();
    } else {
        $msg = 'No account found with those details. Please check and try again.';
        $msgType = 'error';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Forgot Password — HMS+</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
  <style>
    :root{--teal:#0a9396;--teal-dark:#005f73;--teal-xl:#e9f5f5;--dark:#0d1b2a;--muted:#6c757d;--border:#dde8e8;}
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
    .role-badge{display:inline-flex;align-items:center;gap:6px;background:var(--teal-xl);color:var(--teal);
                border-radius:20px;padding:5px 14px;font-size:0.76rem;font-weight:600;margin-bottom:22px;}
    .step-info{background:var(--teal-xl);border-radius:12px;padding:14px 16px;margin-bottom:22px;
               font-size:0.83rem;color:var(--teal-dark);display:flex;align-items:flex-start;gap:10px;}
    .step-info i{margin-top:2px;flex-shrink:0;}
    .fg{margin-bottom:16px;}
    .fg label{font-size:0.8rem;font-weight:600;color:var(--dark);display:block;margin-bottom:5px;}
    .fi-wrap{position:relative;}
    .fi-wrap i{position:absolute;left:14px;top:50%;transform:translateY(-50%);color:var(--muted);font-size:0.9rem;}
    .fi{width:100%;border:1.5px solid var(--border);border-radius:10px;padding:11px 14px 11px 38px;
        font-size:0.88rem;font-family:'Poppins',sans-serif;background:#f8fdfd;transition:all .3s;}
    .fi:focus{outline:none;border-color:var(--teal);background:#fff;box-shadow:0 0 0 3px rgba(10,147,150,0.1);}
    .fi::placeholder{color:#aab8b8;}
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
      <div class="logo-icon"><i class="fa fa-key"></i></div>
      <h2>Forgot Password?</h2>
      <p>We'll verify your identity to reset it</p>
    </div>
    <div class="text-center"><span class="role-badge"><i class="fa fa-user"></i> Patient Recovery</span></div>

    <div class="step-info">
      <i class="fa fa-info-circle"></i>
      <span>Enter the <strong>full name</strong> and <strong>email address</strong> linked to your account to continue.</span>
    </div>

    <?php if($msg): ?>
    <div class="err"><i class="fa fa-exclamation-circle"></i><?php echo htmlspecialchars($msg); ?></div>
    <?php endif; ?>

    <form method="post">
      <div class="fg">
        <label>Registered Full Name</label>
        <div class="fi-wrap">
          <i class="fa fa-user"></i>
          <input type="text" name="fullname" class="fi" placeholder="Enter your full name" required value="<?php echo htmlspecialchars($_POST['fullname']??''); ?>">
        </div>
      </div>
      <div class="fg">
        <label>Registered Email Address</label>
        <div class="fi-wrap">
          <i class="fa fa-envelope"></i>
          <input type="email" name="email" class="fi" placeholder="your@email.com" required value="<?php echo htmlspecialchars($_POST['email']??''); ?>">
        </div>
      </div>
      <button type="submit" name="submit" class="btn-submit">
        <i class="fa fa-arrow-circle-right"></i> Verify & Continue
      </button>
    </form>
    <div class="links">Remember your password? <a href="user-login.php">Sign in</a></div>
  </div>
  <div class="back"><a href="../index.php"><i class="fa fa-arrow-left"></i> Back to Home</a></div>
</div>
</body>
</html>
