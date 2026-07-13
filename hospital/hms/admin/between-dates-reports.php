<?php
session_start();error_reporting(0);include('include/config.php');include('include/auth.php');
$pageTitle='Date Range Reports';$pageIcon='fa-bar-chart';
?><!DOCTYPE html><html lang="en"><head><title>Date Range Reports — HMS+ Admin</title><?php include('include/head.php');?></head><body>
<div id="app"><?php include('include/sidebar.php');?>
<div class="app-content"><?php include('include/header.php');?>
<div class="main-content">
<div class="adm-breadcrumb"><i class="fa fa-home"></i><a href="dashboard.php">Dashboard</a><span class="sep">/</span><span class="cur">Date Range Reports</span></div>
<div class="row justify-content-center"><div class="col-lg-6 col-md-8">
<div class="adm-card">
  <div class="adm-card-header"><div class="ch-left"><i class="fa fa-bar-chart"></i><h5>Generate Patient Report</h5></div></div>
  <div class="adm-card-body">
    <p style="font-size:.83rem;color:var(--muted);margin-bottom:20px;">Select a date range to generate a list of patients registered within that period.</p>
    <form method="post" action="betweendates-detailsreports.php">
      <div class="adm-fg">
        <label>From Date</label>
        <input type="date" name="fromdate" class="adm-input" required>
      </div>
      <div class="adm-fg">
        <label>To Date</label>
        <input type="date" name="todate" class="adm-input" required>
      </div>
      <button type="submit" name="submit" class="btn-adm btn-adm-primary"><i class="fa fa-search"></i> Generate Report</button>
    </form>
  </div>
</div>
</div></div>
</div><?php include('include/footer.php');?></div></div>
<?php include('include/scripts.php');?></body></html>
