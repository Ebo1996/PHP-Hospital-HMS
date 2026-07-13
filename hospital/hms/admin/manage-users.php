<?php
session_start();error_reporting(0);include('include/config.php');include('include/auth.php');
$pageTitle='Manage Users';$pageIcon='fa-users';
if(isset($_GET['del'])){$id=(int)$_GET['id'];mysqli_query($con,"DELETE FROM users WHERE id='$id'");$msg='User deleted.';}
?><!DOCTYPE html><html lang="en"><head><title>Manage Users — HMS+ Admin</title><?php include('include/head.php');?></head><body>
<div id="app"><?php include('include/sidebar.php');?>
<div class="app-content"><?php include('include/header.php');?>
<div class="main-content">
<div class="adm-breadcrumb"><i class="fa fa-home"></i><a href="dashboard.php">Dashboard</a><span class="sep">/</span><span class="cur">Manage Users</span></div>
<?php if(!empty($msg)):?><div class="adm-alert adm-alert-warn"><i class="fa fa-info-circle"></i><?php echo $msg;?></div><?php endif;?>
<div class="adm-card">
  <div class="adm-card-header"><div class="ch-left"><i class="fa fa-users"></i><h5>All Registered Users</h5></div></div>
  <div class="adm-card-body" style="padding:0">
  <div class="adm-table-wrap"><table class="adm-table">
    <thead><tr><th>#</th><th>Full Name</th><th>Email</th><th>City</th><th>Gender</th><th>Registered</th><th>Action</th></tr></thead>
    <tbody>
    <?php $sql=mysqli_query($con,"SELECT * FROM users ORDER BY regDate DESC");$c=1;
    while($row=mysqli_fetch_array($sql)):?>
    <tr>
      <td><?php echo $c++;?></td>
      <td><div style="display:flex;align-items:center;gap:10px"><div style="width:32px;height:32px;border-radius:50%;background:linear-gradient(135deg,var(--amber),var(--amber-dark));display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:.8rem;flex-shrink:0"><?php echo strtoupper(substr($row['fullName'],0,1));?></div><?php echo htmlspecialchars($row['fullName']);?></div></td>
      <td><?php echo htmlspecialchars($row['email']);?></td>
      <td><?php echo htmlspecialchars($row['city']);?></td>
      <td><span class="adm-badge badge-info"><?php echo htmlspecialchars($row['gender']);?></span></td>
      <td><small><?php echo htmlspecialchars($row['regDate']);?></small></td>
      <td><a href="manage-users.php?id=<?php echo $row['id'];?>&del=1" onclick="return confirm('Delete this user?')" class="btn-adm btn-adm-danger btn-adm-sm"><i class="fa fa-trash"></i></a></td>
    </tr>
    <?php endwhile;?>
    </tbody>
  </table></div>
  </div>
</div>
</div><?php include('include/footer.php');?></div></div>
<?php include('include/scripts.php');?></body></html>
