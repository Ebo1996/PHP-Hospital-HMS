<?php
session_start();error_reporting(0);include('include/config.php');include('include/auth.php');
$pageTitle='Unread Queries';$pageIcon='fa-envelope';
$count=mysqli_num_rows(mysqli_query($con,"SELECT id FROM tblcontactus WHERE IsRead IS NULL"));
?><!DOCTYPE html><html lang="en"><head><title>Unread Queries — HMS+ Admin</title><?php include('include/head.php');?></head><body>
<div id="app"><?php include('include/sidebar.php');?>
<div class="app-content"><?php include('include/header.php');?>
<div class="main-content">
<div class="adm-breadcrumb"><i class="fa fa-home"></i><a href="dashboard.php">Dashboard</a><span class="sep">/</span><span class="cur">Unread Queries</span></div>
<?php if($count>0):?>
<div class="adm-alert adm-alert-warn"><i class="fa fa-bell"></i> <strong><?php echo $count;?></strong> unread message<?php echo $count>1?'s':'';?> waiting for review.</div>
<?php endif;?>
<div class="adm-card">
  <div class="adm-card-header"><div class="ch-left"><i class="fa fa-envelope-open"></i><h5>Unread Contact Messages</h5></div>
    <span class="adm-badge badge-warning"><?php echo $count;?> unread</span>
  </div>
  <div class="adm-card-body" style="padding:0">
  <div class="adm-table-wrap"><table class="adm-table">
    <thead><tr><th>#</th><th>Name</th><th>Email</th><th>Phone</th><th>Message</th><th>Received</th><th>Action</th></tr></thead>
    <tbody>
    <?php $sql=mysqli_query($con,"SELECT * FROM tblcontactus WHERE IsRead IS NULL ORDER BY PostingDate DESC");$c=1;
    while($row=mysqli_fetch_array($sql)):?>
    <tr>
      <td><?php echo $c++;?></td>
      <td><strong><?php echo htmlspecialchars($row['fullname']);?></strong></td>
      <td><?php echo htmlspecialchars($row['email']);?></td>
      <td><?php echo htmlspecialchars($row['contactno']);?></td>
      <td style="max-width:220px;white-space:normal;font-size:.82rem"><?php echo htmlspecialchars(substr($row['message'],0,80)).(strlen($row['message'])>80?'…':'');?></td>
      <td><small><?php echo htmlspecialchars($row['PostingDate']);?></small></td>
      <td><a href="query-details.php?id=<?php echo $row['id'];?>" class="btn-adm btn-adm-primary btn-adm-sm"><i class="fa fa-eye"></i> View</a></td>
    </tr>
    <?php endwhile;?>
    <?php if($count===0):?><tr><td colspan="7" style="text-align:center;padding:40px;color:var(--muted)"><i class="fa fa-check-circle" style="font-size:2rem;display:block;margin-bottom:10px;color:#2d6a4f"></i>No unread queries.</td></tr><?php endif;?>
    </tbody>
  </table></div>
  </div>
</div>
</div><?php include('include/footer.php');?></div></div>
<?php include('include/scripts.php');?></body></html>
