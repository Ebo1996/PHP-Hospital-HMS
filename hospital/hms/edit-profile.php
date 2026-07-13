<?php
session_start();
include('include/config.php');
include('include/checklogin.php');
check_login();
$pageTitle = 'My Profile';
$pageIcon  = 'fa-user';
$msg = '';
if(isset($_POST['submit'])){
    $fname   = mysqli_real_escape_string($con,$_POST['fname']);
    $address = mysqli_real_escape_string($con,$_POST['address']);
    $city    = mysqli_real_escape_string($con,$_POST['city']);
    $gender  = mysqli_real_escape_string($con,$_POST['gender']);
    mysqli_query($con,"UPDATE users SET fullName='$fname',address='$address',city='$city',gender='$gender' WHERE id='".$_SESSION['id']."'");
    $msg = 'Profile updated successfully.';
}
$sql  = mysqli_query($con,"SELECT * FROM users WHERE id='".$_SESSION['id']."'");
$data = mysqli_fetch_array($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>My Profile — HMS+</title>
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
        <span class="sep">/</span><span class="current">My Profile</span>
      </div>

      <?php if($msg): ?>
      <div class="hms-alert hms-alert-success"><i class="fa fa-check-circle"></i> <?php echo $msg; ?></div>
      <?php endif; ?>

      <div class="row">
        <!-- Profile summary card -->
        <div class="col-lg-3 col-md-4">
          <div class="hms-card" style="text-align:center;padding:28px 16px;">
            <div class="profile-avatar" style="margin:0 auto 12px;">
              <?php echo strtoupper(substr($data['fullName'],0,1)); ?>
            </div>
            <h5 style="font-weight:700;margin-bottom:4px;"><?php echo htmlspecialchars($data['fullName']); ?></h5>
            <p style="font-size:0.8rem;color:var(--muted);margin-bottom:12px;"><?php echo htmlspecialchars($data['email']); ?></p>
            <span class="badge-hms badge-active">Patient</span>
            <hr style="border-color:var(--border);margin:16px 0;">
            <div style="font-size:0.8rem;color:var(--muted);text-align:left;">
              <div style="margin-bottom:8px;"><i class="fa fa-map-marker" style="width:18px;color:var(--teal);"></i> <?php echo htmlspecialchars($data['city']); ?></div>
              <div style="margin-bottom:8px;"><i class="fa fa-venus-mars" style="width:18px;color:var(--teal);"></i> <?php echo htmlspecialchars($data['gender']); ?></div>
              <div><i class="fa fa-calendar" style="width:18px;color:var(--teal);"></i> Joined <?php echo date('M Y', strtotime($data['regDate'])); ?></div>
            </div>
          </div>
        </div>

        <!-- Edit form -->
        <div class="col-lg-9 col-md-8">
          <div class="hms-card">
            <div class="hms-card-header">
              <i class="fa fa-edit"></i><h5>Edit Information</h5>
            </div>
            <div class="hms-card-body">
              <form method="post">
                <div class="row">
                  <div class="col-md-6">
                    <div class="hms-form-group">
                      <label>Full Name</label>
                      <input type="text" name="fname" class="hms-input" value="<?php echo htmlspecialchars($data['fullName']); ?>" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="hms-form-group">
                      <label>City</label>
                      <input type="text" name="city" class="hms-input" value="<?php echo htmlspecialchars($data['city']); ?>" required>
                    </div>
                  </div>
                </div>
                <div class="hms-form-group">
                  <label>Address</label>
                  <textarea name="address" class="hms-input"><?php echo htmlspecialchars($data['address']); ?></textarea>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="hms-form-group">
                      <label>Gender</label>
                      <select name="gender" class="hms-input">
                        <option value="male"   <?php echo ($data['gender']==='male')   ? 'selected':''; ?>>Male</option>
                        <option value="female" <?php echo ($data['gender']==='female') ? 'selected':''; ?>>Female</option>
                        <option value="other"  <?php echo ($data['gender']==='other')  ? 'selected':''; ?>>Other</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="hms-form-group">
                      <label>Email Address <small style="color:var(--muted)">(read-only)</small></label>
                      <input type="email" class="hms-input" readonly value="<?php echo htmlspecialchars($data['email']); ?>">
                      <small style="font-size:0.78rem;color:var(--teal);"><a href="change-emaild.php">Change email?</a></small>
                    </div>
                  </div>
                </div>
                <button type="submit" name="submit" class="btn-hms btn-hms-primary">
                  <i class="fa fa-save"></i> Save Changes
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
</body>
</html>
