<?php error_reporting(0);
$pageTitle = $pageTitle ?? 'Dashboard';
$pageIcon  = $pageIcon  ?? 'fa-home';
?>
<div class="adm-overlay" id="admOverlay"></div>
<div class="adm-header">
  <div style="display:flex;align-items:center;gap:4px;">
    <button class="adm-toggle" id="admToggle" aria-label="Toggle menu">
      <i class="fa fa-bars"></i>
    </button>
    <div class="page-title">
      <i class="fa <?php echo $pageIcon;?>"></i>
      <?php echo htmlspecialchars($pageTitle);?>
    </div>
  </div>
  <div class="adm-header-right">
    <a href="../../index.php" class="adm-back-btn">
      <i class="fa fa-arrow-left"></i> <span>Home</span>
    </a>
    <div class="adm-user-pill">
      <div class="adm-avatar"><i class="fa fa-user-shield"></i></div>
      <div>
        <div class="adm-uname">Administrator</div>
        <div class="adm-urole">Admin</div>
      </div>
      <i class="fa fa-chevron-down" style="font-size:.65rem;color:var(--muted);margin-left:4px;"></i>
      <div class="adm-dropdown">
        <a href="change-password.php"><i class="fa fa-lock"></i> Change Password</a>
        <div class="dd-div"></div>
        <a href="logout.php" class="logout"><i class="fa fa-sign-out"></i> Logout</a>
      </div>
    </div>
  </div>
</div>
