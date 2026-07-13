<?php
session_start();error_reporting(0);include('include/config.php');include('include/auth.php');
$pageTitle='Read Queries';$pageIcon='fa-envelope-open';
?><!DOCTYPE html><html lang="en"><head><title>Read Queries — HMS+ Admin</title><?php include('include/head.php');?></head><body>
<div id="app"><?php include('include/sidebar.php');?>
<div class="app-content"><?php include('include/header.php');?>
<div class="main-content">
<div class="adm-breadcrumb"><i class="fa fa-home"></i><a href="dashboard.php">Dashboard</a><span class="sep">/</span><span class="cur">Read Queries</span></div>
<div class="adm-card">
  <div class="adm-card-header">
    <div class="ch-left"><i class="fa fa-envelope-open"></i><h5>Answered Queries</h5></div>
    <a href="unread-queries.php" class="btn-adm btn-adm-outline btn-adm-sm"><i class="fa fa-inbox"></i> Unread Queries</a>
  </div>
  <div class="adm-card-body" style="padding:0">
  <div class="adm-table-wrap">
  <table class="adm-table">
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Email</th>
        <th>Contact No.</th>
        <th>Message</th>
        <th>Query Date</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php
    $sql=mysqli_query($con,"SELECT * FROM tblcontactus WHERE IsRead IS NOT NULL ORDER BY PostingDate DESC");
    $cnt=1;
    if(mysqli_num_rows($sql)==0):?>
    <tr><td colspan="7" style="text-align:center;padding:32px;color:var(--muted);"><i class="fa fa-inbox" style="font-size:2rem;display:block;margin-bottom:10px;"></i>No answered queries yet.</td></tr>
    <?php else: while($row=mysqli_fetch_array($sql)):?>
    <tr>
      <td><?php echo $cnt++;?></td>
      <td><strong><?php echo htmlspecialchars($row['fullname']);?></strong></td>
      <td><?php echo htmlspecialchars($row['email']);?></td>
      <td><?php echo htmlspecialchars($row['contactno']);?></td>
      <td style="max-width:200px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" title="<?php echo htmlspecialchars($row['message']);?>"><?php echo htmlspecialchars($row['message']);?></td>
      <td><small><?php echo htmlspecialchars($row['PostingDate']);?></small></td>
      <td><a href="query-details.php?id=<?php echo $row['id'];?>" class="btn-adm btn-adm-outline btn-adm-sm"><i class="fa fa-eye"></i> View</a></td>
    </tr>
    <?php endwhile; endif;?>
    </tbody>
  </table>
  </div>
  </div>
</div>
</div><?php include('include/footer.php');?></div></div>
<?php include('include/scripts.php');?></body></html>
