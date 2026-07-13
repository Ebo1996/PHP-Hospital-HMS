<?php
$current = basename($_SERVER['PHP_SELF']);
function navLink($href, $icon, $label, $current) {
    $active = ($current === $href) ? 'active' : '';
    echo "<li><a href=\"$href\" class=\"$active\"><i class=\"fa $icon\"></i><span>$label</span></a></li>";
}
?>
<div class="hms-sidebar" id="hmsSidebar">
  <div class="sidebar-brand">
    <div class="brand-icon"><i class="fa fa-heartbeat"></i></div>
    <div class="brand-name">HMS<span>+</span></div>
  </div>

  <div class="sidebar-section-label">Patient Portal</div>
  <ul class="hms-nav">
    <?php navLink('dashboard.php',         'fa-home',           'Dashboard',          $current); ?>
    <?php navLink('book-appointment.php',  'fa-calendar-plus-o','Book Appointment',   $current); ?>
    <?php navLink('appointment-history.php','fa-calendar',      'Appointment History',$current); ?>
    <?php navLink('manage-medhistory.php', 'fa-file-medical',   'Medical History',    $current); ?>
    <?php navLink('edit-profile.php',      'fa-user',           'My Profile',         $current); ?>
    <?php navLink('change-password.php',   'fa-lock',           'Change Password',    $current); ?>
  </ul>

  <div class="sidebar-footer">
    <a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
  </div>
</div>
