<?php error_reporting(0);
$pageTitle = $pageTitle ?? 'Dashboard';
$pageIcon  = $pageIcon  ?? 'fa-home';
$doctorName = $_SESSION['login'] ?? 'Doctor';
?>
<div class="doc-overlay" id="docOverlay"></div>
<div class="doc-header">
  <div style="display:flex;align-items:center;gap:4px;">
    <button class="doc-toggle" id="docToggle" aria-label="Toggle menu">
      <i class="fa fa-bars"></i>
    </button>
    <div class="page-title">
      <i class="fa <?php echo $pageIcon;?>"></i>
      <?php echo htmlspecialchars($pageTitle);?>
    </div>
  </div>
  <div class="doc-header-right">
    <a href="../../index.php" class="doc-back-btn">
      <i class="fa fa-arrow-left"></i> <span>Home</span>
    </a>
    <div class="doc-user-pill">
      <div class="doc-avatar"><i class="fa fa-user-md"></i></div>
      <div>
        <div class="doc-uname"><?php echo htmlspecialchars($doctorName);?></div>
        <div class="doc-urole">Doctor</div>
      </div>
      <i class="fa fa-chevron-down" style="font-size:.65rem;color:var(--muted);margin-left:4px;"></i>
      <div class="doc-dropdown">
        <a href="edit-profile.php"><i class="fa fa-user-md"></i> Edit Profile</a>
        <a href="change-password.php"><i class="fa fa-lock"></i> Change Password</a>
        <div class="dd-div"></div>
        <a href="logout.php" class="logout"><i class="fa fa-sign-out"></i> Logout</a>
      </div>
    </div>
  </div>
</div>
