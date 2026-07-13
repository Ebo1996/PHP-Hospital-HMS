<?php
include_once('include/config.php');
$fname=$address=$city=$gender=$email='';
$errors=[];$success=false;
if(isset($_POST['submit'])){
    $fname   = trim($_POST['full_name']   ?? '');
    $address = trim($_POST['address']     ?? '');
    $city    = trim($_POST['city']        ?? '');
    $gender  = trim($_POST['gender']      ?? '');
    $email   = trim($_POST['email']       ?? '');
    $pwd     = trim($_POST['password']    ?? '');
    $pwd2    = trim($_POST['password_again'] ?? '');
    if(empty($fname)||!preg_match('/^[A-Za-z\s]+$/',$fname)) $errors['full_name']='Enter a valid full name (letters only).';
    if(empty($address)) $errors['address']='Address is required.';
    if(empty($city))    $errors['city']='City is required.';
    if(empty($gender))  $errors['gender']='Please select your gender.';
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)) $errors['email']='Enter a valid email address.';
    else{
        $chk=mysqli_prepare($con,"SELECT id FROM users WHERE email=?");
        mysqli_stmt_bind_param($chk,"s",$email);mysqli_stmt_execute($chk);mysqli_stmt_store_result($chk);
        if(mysqli_stmt_num_rows($chk)>0) $errors['email']='This email is already registered.';
        mysqli_stmt_close($chk);
    }
    if(strlen($pwd)<6) $errors['password']='Password must be at least 6 characters.';
    if($pwd!==$pwd2)   $errors['password_again']='Passwords do not match.';
    if(empty($errors)){
        $hash=md5($pwd);
        $ins=mysqli_prepare($con,"INSERT INTO users(fullname,address,city,gender,email,password) VALUES(?,?,?,?,?,?)");
        mysqli_stmt_bind_param($ins,"ssssss",$fname,$address,$city,$gender,$email,$hash);
        if(mysqli_stmt_execute($ins)){$success=true;$fname=$address=$city=$gender=$email='';}
        else $errors['general']='Registration failed. Try again.';
        mysqli_stmt_close($ins);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Patient Registration — HMS+</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
  <style>
    :root{--teal:#0a9396;--teal-dark:#005f73;--teal-light:#94d2bd;--teal-xl:#e9f5f5;--accent:#ee9b00;--dark:#0d1b2a;--muted:#6c757d;--border:#dde8e8;}
    *{box-sizing:border-box;margin:0;padding:0;}
    body{font-family:'Poppins',sans-serif;min-height:100vh;display:flex;align-items:center;justify-content:center;
         background:linear-gradient(135deg,#003845 0%,#005f73 40%,#0a9396 80%,#52b69a 100%);padding:30px 16px;}
    /* blobs */
    .blob{position:fixed;border-radius:50%;filter:blur(80px);opacity:0.15;pointer-events:none;}
    .blob-1{width:500px;height:500px;background:#94d2bd;top:-150px;right:-150px;}
    .blob-2{width:350px;height:350px;background:#ee9b00;bottom:-100px;left:-80px;}
    /* card */
    .reg-card{background:#fff;border-radius:24px;padding:40px 40px 36px;box-shadow:0 30px 80px rgba(0,0,0,0.3);
              width:100%;max-width:560px;position:relative;z-index:2;}
    /* top */
    .reg-top{text-align:center;margin-bottom:28px;}
    .reg-logo{width:58px;height:58px;border-radius:16px;background:linear-gradient(135deg,var(--teal),var(--teal-dark));
              display:inline-flex;align-items:center;justify-content:center;color:#fff;font-size:1.5rem;margin-bottom:12px;}
    .reg-top h2{font-size:1.4rem;font-weight:800;color:var(--dark);margin-bottom:4px;}
    .reg-top p{font-size:0.83rem;color:var(--muted);}
    .role-badge{display:inline-flex;align-items:center;gap:6px;background:var(--teal-xl);color:var(--teal);
                border-radius:20px;padding:5px 14px;font-size:0.76rem;font-weight:600;margin-bottom:20px;}
    /* alerts */
    .alert-ok{background:#d1fae5;border:1px solid #6ee7b7;color:#065f46;border-radius:12px;
              padding:12px 16px;display:flex;align-items:center;gap:10px;margin-bottom:20px;font-size:0.86rem;}
    .alert-err{background:#fee2e2;border:1px solid #fca5a5;color:#991b1b;border-radius:12px;
               padding:12px 16px;display:flex;align-items:center;gap:10px;margin-bottom:20px;font-size:0.86rem;}
    /* form */
    .fg{margin-bottom:16px;}
    .fg label{font-size:0.8rem;font-weight:600;color:var(--dark);display:block;margin-bottom:5px;}
    .fi{width:100%;border:1.5px solid var(--border);border-radius:10px;padding:11px 14px;
        font-size:0.88rem;font-family:'Poppins',sans-serif;background:#f8fdfd;color:var(--dark);transition:all .3s;}
    .fi:focus{outline:none;border-color:var(--teal);background:#fff;box-shadow:0 0 0 3px rgba(10,147,150,0.1);}
    .fi::placeholder{color:#aab8b8;}
    .fi.is-bad{border-color:#e63946;}
    select.fi{cursor:pointer;}textarea.fi{resize:vertical;min-height:80px;}
    .err-text{font-size:0.76rem;color:#e63946;margin-top:4px;}
    /* gender pills */
    .gender-wrap{display:flex;gap:12px;flex-wrap:wrap;}
    .gender-wrap input[type=radio]{display:none;}
    .gender-wrap label{display:inline-flex;align-items:center;gap:7px;cursor:pointer;
        background:#f8fdfd;border:1.5px solid var(--border);border-radius:25px;
        padding:8px 18px;font-size:0.83rem;font-weight:500;color:var(--muted);transition:all .25s;}
    .gender-wrap input[type=radio]:checked+label{background:var(--teal-xl);border-color:var(--teal);color:var(--teal);font-weight:600;}
    .gender-wrap label i{font-size:0.95rem;}
    /* submit */
    .btn-reg{width:100%;background:linear-gradient(135deg,var(--teal),var(--teal-dark));color:#fff;border:none;
             border-radius:12px;padding:13px;font-size:0.95rem;font-weight:700;font-family:'Poppins',sans-serif;
             cursor:pointer;transition:all .3s;display:flex;align-items:center;justify-content:center;gap:8px;
             box-shadow:0 6px 20px rgba(0,95,115,0.3);margin-top:8px;}
    .btn-reg:hover{transform:translateY(-2px);box-shadow:0 10px 30px rgba(0,95,115,0.4);}
    /* divider */
    .divider{text-align:center;color:#ccc;font-size:0.8rem;margin:18px 0;position:relative;}
    .divider::before,.divider::after{content:'';position:absolute;top:50%;width:40%;height:1px;background:#e8eeee;}
    .divider::before{left:0;}.divider::after{right:0;}
    /* portal links */
    .portal-links{display:flex;gap:10px;}
    .portal-link{flex:1;text-align:center;padding:10px 8px;border-radius:12px;border:1.5px solid var(--border);
                 font-size:0.78rem;font-weight:600;color:var(--muted);transition:all .3s;}
    .portal-link:hover{border-color:var(--teal);color:var(--teal);background:var(--teal-xl);}
    .portal-link i{display:block;font-size:1.1rem;margin-bottom:4px;}
    .login-link{text-align:center;font-size:0.84rem;color:var(--muted);margin-top:14px;}
    .login-link a{color:var(--teal);font-weight:600;}
    /* back */
    .back-home{text-align:center;margin-top:18px;position:relative;z-index:2;}
    .back-home a{color:rgba(255,255,255,0.7);font-size:0.82rem;}
    .back-home a:hover{color:#fff;}
    @media(max-width:480px){.reg-card{padding:28px 20px;}.gender-wrap{gap:8px;}}
    /* availability */
    #av-status{font-size:0.76rem;margin-top:3px;display:block;}
  </style>
</head>
<body>
<div class="blob blob-1"></div>
<div class="blob blob-2"></div>

<div style="width:100%;max-width:560px;position:relative;z-index:2;">
  <div class="reg-card">
    <div class="reg-top">
      <div class="reg-logo"><i class="fa fa-heartbeat"></i></div>
      <h2>HMS<span style="color:var(--teal)">+</span></h2>
      <p>Hospital Management System</p>
    </div>
    <div class="text-center"><span class="role-badge"><i class="fa fa-user"></i> Patient Registration</span></div>

    <?php if($success): ?>
    <div class="alert-ok"><i class="fa fa-check-circle fa-lg"></i>
      <div><strong>Registration Successful!</strong> You can now <a href="user-login.php" style="color:#065f46;font-weight:700;">login here</a>.</div>
    </div>
    <?php endif; ?>
    <?php if(!empty($errors['general'])): ?>
    <div class="alert-err"><i class="fa fa-exclamation-circle"></i> <?php echo htmlspecialchars($errors['general']); ?></div>
    <?php endif; ?>

    <form method="post" onsubmit="return validateForm()">
      <!-- Name -->
      <div class="fg">
        <label>Full Name</label>
        <input type="text" name="full_name" class="fi <?php echo isset($errors['full_name'])?'is-bad':''; ?>"
               placeholder="Your full name" value="<?php echo htmlspecialchars($fname); ?>" required>
        <?php if(isset($errors['full_name'])): ?><span class="err-text"><?php echo $errors['full_name']; ?></span><?php endif; ?>
      </div>
      <!-- Address + City -->
      <div class="row" style="margin:0 -6px;">
        <div class="col-md-7" style="padding:0 6px;">
          <div class="fg">
            <label>Address</label>
            <input type="text" name="address" class="fi <?php echo isset($errors['address'])?'is-bad':''; ?>"
                   placeholder="Street address" value="<?php echo htmlspecialchars($address); ?>" required>
            <?php if(isset($errors['address'])): ?><span class="err-text"><?php echo $errors['address']; ?></span><?php endif; ?>
          </div>
        </div>
        <div class="col-md-5" style="padding:0 6px;">
          <div class="fg">
            <label>City</label>
            <input type="text" name="city" class="fi <?php echo isset($errors['city'])?'is-bad':''; ?>"
                   placeholder="City" value="<?php echo htmlspecialchars($city); ?>" required>
            <?php if(isset($errors['city'])): ?><span class="err-text"><?php echo $errors['city']; ?></span><?php endif; ?>
          </div>
        </div>
      </div>
      <!-- Gender -->
      <div class="fg">
        <label>Gender</label>
        <div class="gender-wrap">
          <input type="radio" id="g-male" name="gender" value="male" <?php echo($gender==='male')?'checked':''; ?>>
          <label for="g-male"><i class="fa fa-mars"></i> Male</label>
          <input type="radio" id="g-female" name="gender" value="female" <?php echo($gender==='female')?'checked':''; ?>>
          <label for="g-female"><i class="fa fa-venus"></i> Female</label>
          <input type="radio" id="g-other" name="gender" value="other" <?php echo($gender==='other')?'checked':''; ?>>
          <label for="g-other"><i class="fa fa-genderless"></i> Other</label>
        </div>
        <?php if(isset($errors['gender'])): ?><span class="err-text"><?php echo $errors['gender']; ?></span><?php endif; ?>
      </div>
      <!-- Email -->
      <div class="fg">
        <label>Email Address</label>
        <input type="email" name="email" id="emailField" class="fi <?php echo isset($errors['email'])?'is-bad':''; ?>"
               placeholder="your@email.com" value="<?php echo htmlspecialchars($email); ?>" onblur="checkEmail()" required>
        <span id="av-status"></span>
        <?php if(isset($errors['email'])): ?><span class="err-text"><?php echo $errors['email']; ?></span><?php endif; ?>
      </div>
      <!-- Password row -->
      <div class="row" style="margin:0 -6px;">
        <div class="col-md-6" style="padding:0 6px;">
          <div class="fg">
            <label>Password</label>
            <input type="password" name="password" id="password" class="fi <?php echo isset($errors['password'])?'is-bad':''; ?>"
                   placeholder="Min. 6 characters" required>
            <?php if(isset($errors['password'])): ?><span class="err-text"><?php echo $errors['password']; ?></span><?php endif; ?>
          </div>
        </div>
        <div class="col-md-6" style="padding:0 6px;">
          <div class="fg">
            <label>Confirm Password</label>
            <input type="password" name="password_again" id="password_again" class="fi <?php echo isset($errors['password_again'])?'is-bad':''; ?>"
                   placeholder="Repeat password" required>
            <?php if(isset($errors['password_again'])): ?><span class="err-text"><?php echo $errors['password_again']; ?></span><?php endif; ?>
          </div>
        </div>
      </div>

      <button type="submit" name="submit" class="btn-reg">
        <i class="fa fa-user-plus"></i> Create Account
      </button>
    </form>

    <div class="divider">or access another portal</div>
    <div class="portal-links">
      <a href="doctor/index.php" class="portal-link"><i class="fa fa-stethoscope"></i>Doctor</a>
      <a href="user-login.php"   class="portal-link"><i class="fa fa-sign-in"></i>Login</a>
      <a href="admin/index.php"  class="portal-link"><i class="fa fa-cog"></i>Admin</a>
    </div>
    <div class="login-link">Already have an account? <a href="user-login.php">Sign in here</a></div>
  </div>
  <div class="back-home"><a href="../index.php"><i class="fa fa-arrow-left"></i> Back to Home</a></div>
</div>

<script src="vendor/jquery/jquery.min.js"></script>
<script>
function checkEmail(){
  var e=$('#emailField').val().trim(), s=$('#av-status');
  if(e.length<4){s.html('');return;}
  s.html('<span style="color:var(--muted)"><i class="fa fa-spinner fa-spin"></i> Checking…</span>');
  $.post('check_availability.php',{email:e},function(d){s.html(d);});
}
function validateForm(){
  var n=$('input[name=full_name]').val().trim();
  if(!/^[A-Za-z\s]+$/.test(n)){alert('Full name must contain letters only.');return false;}
  var p=$('#password').val(), p2=$('#password_again').val();
  if(p.length<6){alert('Password must be at least 6 characters.');return false;}
  if(p!==p2){alert('Passwords do not match.');return false;}
  if(!$('input[name=gender]:checked').length){alert('Please select your gender.');return false;}
  return true;
}
</script>
</body>
</html>
