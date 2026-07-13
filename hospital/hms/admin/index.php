<?php
session_start();
error_reporting(0);
include("include/config.php");

if (isset($_POST['submit'])) {
    $uname    = mysqli_real_escape_string($con, $_POST['username']);
    $upassword = $_POST['password']; // admin table stores plaintext — keep as-is but escape

    $ret = mysqli_query($con, "SELECT * FROM admin WHERE username='$uname' AND password='$upassword'");
    $num = mysqli_fetch_array($ret);

    if ($num && $num['id'] > 0) {
        $_SESSION['login'] = $uname;
        $_SESSION['id']    = $num['id'];
        $_SESSION['role']  = 'admin';   // ← role-based flag
        header("location:dashboard.php");
        exit();
    } else {
        $loginError = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Login — HMS</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <style>
        *{box-sizing:border-box;margin:0;padding:0;}
        body{font-family:'Poppins',sans-serif;min-height:100vh;display:flex;align-items:center;justify-content:center;
             background:linear-gradient(135deg,#1a1a2e 0%,#16213e 50%,#0f3460 100%);}
        .login-wrap{width:100%;max-width:440px;padding:20px;}
        .login-card{background:#fff;border-radius:24px;padding:44px 40px;box-shadow:0 30px 80px rgba(0,0,0,0.35);}
        .login-logo{text-align:center;margin-bottom:32px;}
        .login-logo .logo-icon{width:64px;height:64px;background:linear-gradient(135deg,#ee9b00,#cc8400);border-radius:18px;
                               display:inline-flex;align-items:center;justify-content:center;font-size:1.8rem;color:#fff;margin-bottom:14px;}
        .login-logo h2{font-size:1.4rem;font-weight:700;color:#0d1b2a;margin-bottom:4px;}
        .login-logo p{font-size:0.85rem;color:#6c757d;}
        .role-badge{display:inline-flex;align-items:center;gap:6px;background:rgba(238,155,0,0.1);color:#cc8400;
                    border-radius:20px;padding:5px 14px;font-size:0.78rem;font-weight:600;margin-bottom:24px;}
        .form-group{margin-bottom:18px;}
        .form-group label{font-size:0.82rem;font-weight:600;color:#0d1b2a;display:block;margin-bottom:6px;}
        .input-wrap{position:relative;}
        .input-wrap i{position:absolute;left:14px;top:50%;transform:translateY(-50%);color:#94a3b8;font-size:0.9rem;}
        .input-wrap input{width:100%;border:1.5px solid #e2e8f0;border-radius:12px;padding:12px 14px 12px 40px;
                          font-size:0.9rem;font-family:'Poppins',sans-serif;transition:all 0.3s;background:#f8fafc;}
        .input-wrap input:focus{outline:none;border-color:#ee9b00;background:#fff;box-shadow:0 0 0 3px rgba(238,155,0,0.12);}
        .btn-login{width:100%;background:linear-gradient(135deg,#ee9b00,#cc8400);color:#fff;border:none;border-radius:12px;
                   padding:13px;font-size:0.95rem;font-weight:600;font-family:'Poppins',sans-serif;cursor:pointer;
                   transition:all 0.3s;margin-top:8px;}
        .btn-login:hover{transform:translateY(-2px);box-shadow:0 8px 25px rgba(238,155,0,0.4);}
        .error-msg{background:#fff0f0;border:1px solid #fecaca;color:#dc2626;border-radius:10px;
                   padding:10px 14px;font-size:0.84rem;margin-bottom:18px;display:flex;align-items:center;gap:8px;}
        .divider{text-align:center;color:#94a3b8;font-size:0.82rem;margin:20px 0;position:relative;}
        .divider::before,.divider::after{content:'';position:absolute;top:50%;width:40%;height:1px;background:#e2e8f0;}
        .divider::before{left:0;}.divider::after{right:0;}
        .portal-links{display:flex;gap:10px;margin-top:4px;}
        .portal-link{flex:1;text-align:center;padding:10px;border-radius:12px;border:1.5px solid #e2e8f0;
                     font-size:0.78rem;font-weight:600;color:#6c757d;transition:all 0.3s;}
        .portal-link:hover{border-color:#ee9b00;color:#cc8400;background:rgba(238,155,0,0.04);}
        .portal-link i{display:block;font-size:1.2rem;margin-bottom:4px;}
        .back-home{text-align:center;margin-top:16px;}
        .back-home a{color:rgba(255,255,255,0.7);font-size:0.83rem;text-decoration:none;}
        .back-home a:hover{color:#fff;}
    </style>
</head>
<body>
<div class="login-wrap">
    <div class="login-card">
        <div class="login-logo">
            <div class="logo-icon"><i class="fa fa-cog"></i></div>
            <h2>HMS<span style="color:#ee9b00">+</span></h2>
            <p>Hospital Management System</p>
        </div>
        <div class="text-center"><span class="role-badge"><i class="fa fa-shield"></i> Admin Portal</span></div>

        <?php if (!empty($loginError)): ?>
        <div class="error-msg"><i class="fa fa-exclamation-circle"></i> <?php echo htmlspecialchars($loginError); ?></div>
        <?php endif; ?>

        <form method="post" autocomplete="off">
            <div class="form-group">
                <label>Username</label>
                <div class="input-wrap">
                    <i class="fa fa-user"></i>
                    <input type="text" name="username" placeholder="Admin username" required>
                </div>
            </div>
            <div class="form-group">
                <label>Password</label>
                <div class="input-wrap">
                    <i class="fa fa-lock"></i>
                    <input type="password" name="password" placeholder="Enter your password" required>
                </div>
            </div>
            <button type="submit" name="submit" class="btn-login">
                <i class="fa fa-sign-in"></i> Sign In as Admin
            </button>
        </form>

        <div class="divider">or access another portal</div>
        <div class="portal-links">
            <a href="../user-login.php" class="portal-link"><i class="fa fa-user"></i>Patient</a>
            <a href="../doctor" class="portal-link"><i class="fa fa-stethoscope"></i>Doctor</a>
        </div>
    </div>
    <div class="back-home"><a href="../../index.php"><i class="fa fa-arrow-left"></i> Back to Home</a></div>
</div>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
