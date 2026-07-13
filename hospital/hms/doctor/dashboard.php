<?php
session_start();error_reporting(0);include('include/config.php');include('include/auth.php');
$pageTitle='Dashboard';$pageIcon='fa-home';
$did=$_SESSION['id'];
$patients =mysqli_num_rows(mysqli_query($con,"SELECT ID FROM tblpatient WHERE Docid='$did'"));
$appts    =mysqli_num_rows(mysqli_query($con,"SELECT id FROM appointment WHERE doctorId='$did'"));
$active   =mysqli_num_rows(mysqli_query($con,"SELECT id FROM appointment WHERE doctorId='$did' AND userStatus=1 AND doctorStatus=1"));
$doc=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM doctors WHERE id='$did'"));
?><!DOCTYPE html><html lang="en"><head><title>Dashboard — HMS+ Doctor</title><?php include('include/head.php');?></head><body>
<div id="app"><?php include('include/sidebar.php');?>
<div class="app-content"><?php include('include/header.php');?>
<div class="main-content">

<!-- Welcome banner -->
<div style="background:linear-gradient(135deg,#012a4a,#0077b6);border-radius:18px;padding:26px 30px;margin-bottom:24px;display:flex;align-items:center;justify-content:space-between;box-shadow:0 8px 30px rgba(0,0,0,0.2);">
  <div>
    <p style="color:rgba(255,255,255,.6);font-size:.85rem;margin-bottom:4px;">Welcome back,</p>
    <h3 style="color:#fff;font-size:1.5rem;font-weight:800;margin:0;">Dr. <?php echo htmlspecialchars($doc['doctorName']??'Doctor');?> 👋</h3>
    <p style="color:rgba(255,255,255,.55);font-size:.88rem;margin-top:6px;"><?php echo htmlspecialchars($doc['specilization']??'');?></p>
  </div>
  <div style="opacity:.1;font-size:5rem;color:#fff;"><i class="fa fa-stethoscope"></i></div>
</div>

<!-- Stat cards -->
<div class="row">
  <div class="col-lg-4 col-md-6">
    <div class="doc-stat">
      <div class="si" style="background:rgba(0,133,188,.12);color:var(--teal)"><i class="fa fa-procedures"></i></div>
      <div><div class="sn"><?php echo $patients;?></div><div class="sl">My Patients</div><a href="manage-patient.php" class="sa" style="background:rgba(0,133,188,.1);color:var(--teal)">View all <i class="fa fa-arrow-right"></i></a></div>
    </div>
  </div>
  <div class="col-lg-4 col-md-6">
    <div class="doc-stat">
      <div class="si" style="background:rgba(238,155,0,.12);color:var(--amber)"><i class="fa fa-calendar"></i></div>
      <div><div class="sn"><?php echo $appts;?></div><div class="sl">Total Appointments</div><a href="appointment-history.php" class="sa" style="background:rgba(238,155,0,.1);color:var(--amber)">View all <i class="fa fa-arrow-right"></i></a></div>
    </div>
  </div>
  <div class="col-lg-4 col-md-6">
    <div class="doc-stat">
      <div class="si" style="background:rgba(45,106,79,.12);color:var(--green)"><i class="fa fa-check-circle"></i></div>
      <div><div class="sn"><?php echo $active;?></div><div class="sl">Active Appointments</div><a href="appointment-history.php" class="sa" style="background:rgba(45,106,79,.1);color:var(--green)">View all <i class="fa fa-arrow-right"></i></a></div>
    </div>
  </div>
</div>

<!-- Quick actions -->
<h6 style="font-size:.82rem;font-weight:700;letter-spacing:.5px;text-transform:uppercase;color:var(--muted);margin-bottom:14px;">Quick Actions</h6>
<div class="row">
<?php
$actions=[
  ['appointment-history.php','fa-calendar','My Appointments','View all patient appointments','rgba(0,133,188,.1)','var(--teal)'],
  ['manage-patient.php','fa-procedures','Manage Patients','View and manage your patient list','rgba(238,155,0,.1)','var(--amber)'],
  ['add-patient.php','fa-user-plus','Add Patient','Register a new patient','rgba(45,106,79,.1)','var(--green)'],
  ['search.php','fa-search','Search Patient','Find patient by name or mobile','rgba(230,57,70,.1)','var(--red)'],
  ['edit-profile.php','fa-user-md','Edit Profile','Update your doctor profile','rgba(0,119,182,.1)','var(--blue)'],
  ['change-password.php','fa-lock','Change Password','Update your login password','rgba(123,44,191,.1)','#7b2cbf'],
];
foreach($actions as $a):?>
<div class="col-lg-4 col-md-6">
  <a href="<?php echo $a[0];?>" style="display:block;background:#fff;border-radius:16px;padding:22px 20px;border:1.5px solid var(--border);box-shadow:var(--shadow);transition:all .3s;margin-bottom:20px;text-decoration:none;color:var(--dark);" onmouseover="this.style.transform='translateY(-5px)';this.style.boxShadow='0 12px 35px rgba(0,0,0,0.12)'" onmouseout="this.style.transform='';this.style.boxShadow=''">
    <div style="width:50px;height:50px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.3rem;margin-bottom:14px;background:<?php echo $a[4];?>;color:<?php echo $a[5];?>"><i class="fa <?php echo $a[1];?>"></i></div>
    <div style="font-weight:700;font-size:.95rem;margin-bottom:4px;"><?php echo $a[2];?></div>
    <div style="font-size:.82rem;color:var(--muted);"><?php echo $a[3];?></div>
  </a>
</div>
<?php endforeach;?>
</div>

</div><?php include('include/footer.php');?></div></div>
<?php include('include/scripts.php');?></body></html>
