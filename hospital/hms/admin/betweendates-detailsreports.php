<?php
session_start();error_reporting(0);include('include/config.php');include('include/auth.php');
$pageTitle='Report Results';$pageIcon='fa-bar-chart';
$fdate=isset($_POST['fromdate'])?$_POST['fromdate']:'';
$tdate=isset($_POST['todate'])?$_POST['todate']:'';
?><!DOCTYPE html><html lang="en"><head><title>Report Results — HMS+ Admin</title><?php include('include/head.php');?></head><body>
<div id="app"><?php include('include/sidebar.php');?>
<div class="app-content"><?php include('include/header.php');?>
<div class="main-content">
<div class="adm-breadcrumb"><i class="fa fa-home"></i><a href="dashboard.php">Dashboard</a><span class="sep">/</span><a href="between-dates-reports.php">Reports</a><span class="sep">/</span><span class="cur">Results</span></div>
<div class="adm-card">
  <div class="adm-card-header">
    <div class="ch-left"><i class="fa fa-bar-chart"></i><h5>Patient Report: <?php echo htmlspecialchars($fdate);?> &mdash; <?php echo htmlspecialchars($tdate);?></h5></div>
    <a href="between-dates-reports.php" class="btn-adm btn-adm-outline btn-adm-sm"><i class="fa fa-arrow-left"></i> New Report</a>
  </div>
  <div class="adm-card-body" style="padding:0">
  <div class="adm-table-wrap">
  <table class="adm-table">
    <thead>
      <tr>
        <th>#</th>
        <th>Patient Name</th>
        <th>Contact Number</th>
        <th>Gender</th>
        <th>Registration Date</th>
        <th>Last Updated</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php
    $sql=mysqli_query($con,"SELECT * FROM tblpatient WHERE DATE(CreationDate) BETWEEN '$fdate' AND '$tdate'");
    $cnt=1;
    if(mysqli_num_rows($sql)==0):?>
    <tr><td colspan="7" style="text-align:center;padding:32px;color:var(--muted);"><i class="fa fa-inbox" style="font-size:2rem;display:block;margin-bottom:10px;"></i>No patients found in this date range.</td></tr>
    <?php else: while($row=mysqli_fetch_array($sql)):?>
    <tr>
      <td><?php echo $cnt++;?></td>
      <td><strong><?php echo htmlspecialchars($row['PatientName']);?></strong></td>
      <td><?php echo htmlspecialchars($row['PatientContno']);?></td>
      <td><span class="adm-badge badge-info"><?php echo htmlspecialchars($row['PatientGender']);?></span></td>
      <td><small><?php echo htmlspecialchars($row['CreationDate']);?></small></td>
      <td><small><?php echo $row['UpdationDate']?htmlspecialchars($row['UpdationDate']):'—';?></small></td>
      <td><a href="view-patient.php?viewid=<?php echo $row['ID'];?>" class="btn-adm btn-adm-outline btn-adm-sm"><i class="fa fa-eye"></i> View</a></td>
    </tr>
    <?php endwhile; endif;?>
    </tbody>
  </table>
  </div>
  </div>
</div>
</div><?php include('include/footer.php');?></div></div>
<?php include('include/scripts.php');?></body></html>
