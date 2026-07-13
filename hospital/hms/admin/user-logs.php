<?php
session_start();error_reporting(0);include('include/config.php');include('include/auth.php');
$pageTitle='User Session Logs';$pageIcon='fa-users';
?><!DOCTYPE html><html lang="en"><head><title>User Logs — HMS+ Admin</title><?php include('include/head.php');?></head><body>
<div id="app"><?php include('include/sidebar.php');?>
<div class="app-content"><?php include('include/header.php');?>
<div class="main-content">
<div class="adm-breadcrumb"><i class="fa fa-home"></i><a href="dashboard.php">Dashboard</a><span class="sep">/</span><span class="cur">User Session Logs</span></div>
<div class="adm-card">
  <div class="adm-card-header"><div class="ch-left"><i class="fa fa-users"></i><h5>Patient Login History</h5></div></div>
  <div class="adm-card-body" style="padding:0">
  <div class="adm-table-wrap"><table class="adm-table">
    <thead><tr><th>#</th><th>User ID</th><th>Username</th><th>IP Address</th><th>Login Time</th><th>Logout Time</th><th>Status</th></tr></thead>
    <tbody>
    <?php $sql=mysqli_query($con,"SELECT * FROM userlog ORDER BY loginTime DESC");$c=1;
    while($row=mysqli_fetch_array($sql)):?>
    <tr>
      <td><?php echo $c++;?></td>
      <td><span class="adm-badge badge-info">#<?php echo htmlspecialchars($row['uid']??'—');?></span></td>
      <td><?php echo htmlspecialchars($row['username']);?></td>
      <td><code style="font-size:.78rem;background:#f4f6f9;padding:2px 8px;border-radius:6px"><?php echo htmlspecialchars($row['userip']);?></code></td>
      <td><small><?php echo htmlspecialchars($row['loginTime']);?></small></td>
      <td><small><?php echo $row['logout']??'—';?></small></td>
      <td><?php if($row['status']==1):?><span class="adm-badge badge-success"><i class="fa fa-check"></i> Success</span><?php else:?><span class="adm-badge badge-danger"><i class="fa fa-times"></i> Failed</span><?php endif;?></td>
    </tr>
    <?php endwhile;?>
    </tbody>
  </table></div>
  </div>
</div>
</div><?php include('include/footer.php');?></div></div>
<?php include('include/scripts.php');?></body></html>
