<?php
session_start(); error_reporting(0);
include('include/config.php');
if(empty($_SESSION['login'])||empty($_SESSION['role'])||$_SESSION['role']!=='admin'){session_unset();session_destroy();header('location:index.php');exit();}
$pageTitle='Dashboard';$pageIcon='fa-home';
$users   =mysqli_num_rows(mysqli_query($con,"SELECT id FROM users"));
$doctors =mysqli_num_rows(mysqli_query($con,"SELECT id FROM doctors"));
$appts   =mysqli_num_rows(mysqli_query($con,"SELECT id FROM appointment"));
$patients=mysqli_num_rows(mysqli_query($con,"SELECT ID FROM tblpatient"));
$queries =mysqli_num_rows(mysqli_query($con,"SELECT id FROM tblcontactus WHERE IsRead IS NULL"));
?><!DOCTYPE html><html lang="en"><head><title>Dashboard — HMS+ Admin</title>
<?php include('include/head.php');?></head><body>
<div id="app">
<?php include('include/sidebar.php');?>
<div class="app-content">
<?php include('include/header.php');?>
<div class="main-content">

<!-- Welcome banner -->
<div style="background:linear-gradient(135deg,#1a2b3c,#0d1b2a);border-radius:18px;padding:26px 30px;margin-bottom:24px;display:flex;align-items:center;justify-content:space-between;box-shadow:0 8px 30px rgba(0,0,0,0.2);flex-wrap:wrap;gap:16px;">
  <div style="flex:1;min-width:200px;">
    <p style="color:rgba(255,255,255,.6);font-size:.8rem;margin-bottom:4px;">Welcome back,</p>
    <h3 style="color:#fff;font-size:1.4rem;font-weight:800;margin:0;">Administrator 👋</h3>
    <p style="color:rgba(255,255,255,.55);font-size:.82rem;margin-top:6px;">Here's what's happening in your hospital today.</p>
  </div>
  <div style="opacity:.1;font-size:5rem;color:#fff;flex-shrink:0;"><i class="fa fa-hospital-o"></i></div>
</div>
<style>
@media (max-width:768px){
  .row [class*='col-']{margin-bottom:16px;}
}
@media (max-width:480px){
  #app .main-content>div:first-child{padding:20px 16px!important;font-size:0.78rem;}
  #app .main-content>div:first-child h3{font-size:1.2rem!important;}
  #app .main-content>div:first-child>div:last-child{display:none;}
}
</style>

<!-- Stat cards -->
<div class="row">
  <div class="col-lg-3 col-md-6"><div class="adm-stat"><div class="si" style="background:rgba(238,155,0,.12);color:var(--amber)"><i class="fa fa-users"></i></div><div><div class="sn"><?php echo $users;?></div><div class="sl">Total Users</div><a href="manage-users.php" class="sa" style="background:rgba(238,155,0,.1);color:var(--amber)">View all <i class="fa fa-arrow-right"></i></a></div></div></div>
  <div class="col-lg-3 col-md-6"><div class="adm-stat"><div class="si" style="background:rgba(10,147,150,.12);color:var(--teal)"><i class="fa fa-user-md"></i></div><div><div class="sn"><?php echo $doctors;?></div><div class="sl">Total Doctors</div><a href="manage-doctors.php" class="sa" style="background:rgba(10,147,150,.1);color:var(--teal)">View all <i class="fa fa-arrow-right"></i></a></div></div></div>
  <div class="col-lg-3 col-md-6"><div class="adm-stat"><div class="si" style="background:rgba(0,119,182,.12);color:var(--blue)"><i class="fa fa-calendar"></i></div><div><div class="sn"><?php echo $appts;?></div><div class="sl">Appointments</div><a href="appointment-history.php" class="sa" style="background:rgba(0,119,182,.1);color:var(--blue)">View all <i class="fa fa-arrow-right"></i></a></div></div></div>
  <div class="col-lg-3 col-md-6"><div class="adm-stat"><div class="si" style="background:rgba(45,106,79,.12);color:var(--green)"><i class="fa fa-procedures"></i></div><div><div class="sn"><?php echo $patients;?></div><div class="sl">Patients</div><a href="manage-patient.php" class="sa" style="background:rgba(45,106,79,.1);color:var(--green)">View all <i class="fa fa-arrow-right"></i></a></div></div></div>
</div>

<?php if($queries>0):?>
<div class="adm-alert adm-alert-warn"><i class="fa fa-bell"></i> You have <strong><?php echo $queries;?> unread quer<?php echo $queries==1?'y':'ies';?></strong>. <a href="unread-queries.php" style="color:var(--amber-dark);font-weight:600;">View now &rarr;</a></div>
<?php endif;?>

<!-- Quick actions -->
<h6 style="font-size:.78rem;font-weight:700;letter-spacing:.5px;text-transform:uppercase;color:var(--muted);margin-bottom:14px;">Quick Actions</h6>
<div class="row">
<?php
$actions=[
  ['add-doctor.php','fa-user-plus','Add Doctor','Register a new doctor to the system','rgba(238,155,0,.1)','var(--amber)'],
  ['doctor-specilization.php','fa-stethoscope','Specializations','Manage doctor specialization categories','rgba(10,147,150,.1)','var(--teal)'],
  ['appointment-history.php','fa-calendar-check-o','All Appointments','View all patient appointments','rgba(0,119,182,.1)','var(--blue)'],
  ['unread-queries.php','fa-envelope-open','Unread Queries','Review contact form messages','rgba(230,57,70,.1)','#e63946'],
  ['between-dates-reports.php','fa-bar-chart','Reports','Generate appointment date reports','rgba(123,44,191,.1)','#7b2cbf'],
  ['patient-search.php','fa-search','Patient Search','Find patient by name or mobile','rgba(45,106,79,.1)','var(--green)'],
];
foreach($actions as $a):?>
<div class="col-lg-4 col-md-6">
  <a href="<?php echo $a[0];?>" style="display:block;background:#fff;border-radius:16px;padding:22px 20px;border:1.5px solid var(--border);box-shadow:var(--shadow);transition:all .3s;margin-bottom:20px;text-decoration:none;color:var(--dark);" onmouseover="this.style.transform='translateY(-5px)';this.style.boxShadow='0 12px 35px rgba(0,0,0,0.12)'" onmouseout="this.style.transform='';this.style.boxShadow=''">
    <div style="width:50px;height:50px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.3rem;margin-bottom:14px;background:<?php echo $a[4];?>;color:<?php echo $a[5];?>"><i class="fa <?php echo $a[1];?>"></i></div>
    <div style="font-weight:700;font-size:.9rem;margin-bottom:4px;"><?php echo $a[2];?></div>
    <div style="font-size:.78rem;color:var(--muted);"><?php echo $a[3];?></div>
  </a>
</div>
<?php endforeach;?>
</div>

</div><?php include('include/footer.php');?></div></div>
<?php include('include/scripts.php');?>
</body></html>
