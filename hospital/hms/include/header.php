<?php
error_reporting(0);
$pageTitle = $pageTitle ?? 'Dashboard';
$pageIcon  = $pageIcon  ?? 'fa-home';
$query = mysqli_query($con, "SELECT fullName FROM users WHERE id='" . $_SESSION['id'] . "'");
$urow  = mysqli_fetch_array($query);
$uname = $urow['fullName'] ?? 'Patient';
$initial = strtoupper(substr($uname, 0, 1));
?>
<div class="hms-overlay" id="hmsOverlay"></div>
<div class="hms-header">
  <div style="display:flex;align-items:center;gap:4px;">
    <button class="hms-toggle" id="hmsToggle" aria-label="Toggle menu">
      <i class="fa fa-bars"></i>
    </button>
    <div class="page-title">
      <i class="fa <?php echo $pageIcon; ?>"></i>
      <?php echo htmlspecialchars($pageTitle); ?>
    </div>
  </div>
  <div class="header-right">
    <a href="../../index.php" class="header-back"><i class="fa fa-arrow-left"></i> <span>Home</span></a>
    <div class="hms-user-pill">
      <div class="avatar"><?php echo $initial; ?></div>
      <div>
        <div class="uname"><?php echo htmlspecialchars($uname); ?></div>
        <div class="urole">Patient</div>
      </div>
      <i class="fa fa-chevron-down" style="font-size:0.65rem;color:var(--muted);margin-left:4px;"></i>
      <div class="user-dropdown">
        <a href="edit-profile.php"><i class="fa fa-user"></i> My Profile</a>
        <a href="change-password.php"><i class="fa fa-lock"></i> Change Password</a>
        <div class="ud-divider"></div>
        <a href="logout.php" class="logout-link"><i class="fa fa-sign-out"></i> Logout</a>
      </div>
    </div>
  </div>
</div>
