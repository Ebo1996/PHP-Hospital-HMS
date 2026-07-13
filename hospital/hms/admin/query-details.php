<?php
session_start();error_reporting(0);include('include/config.php');include('include/auth.php');
$pageTitle='Query Details';$pageIcon='fa-envelope-open';
$qid=intval($_GET['id']??0);
if(isset($_POST['update'])){
  $remark=mysqli_real_escape_string($con,$_POST['adminremark']);
  $q=mysqli_query($con,"UPDATE tblcontactus SET AdminRemark='$remark',IsRead=1 WHERE id='$qid'");
  if($q){header('location:read-query.php');exit();}
}
?><!DOCTYPE html><html lang="en"><head><title>Query Details — HMS+ Admin</title><?php include('include/head.php');?></head><body>
<div id="app"><?php include('include/sidebar.php');?>
<div class="app-content"><?php include('include/header.php');?>
<div class="main-content">
<div class="adm-breadcrumb"><i class="fa fa-home"></i><a href="dashboard.php">Dashboard</a><span class="sep">/</span><a href="unread-queries.php">Queries</a><span class="sep">/</span><span class="cur">Query Details</span></div>
<?php
$sql=mysqli_query($con,"SELECT * FROM tblcontactus WHERE id='$qid'");
$row=mysqli_fetch_array($sql);
if($row):?>
<div class="row justify-content-center"><div class="col-lg-7 col-md-10">
<div class="adm-card">
  <div class="adm-card-header">
    <div class="ch-left"><i class="fa fa-envelope-open"></i><h5>Query from <?php echo htmlspecialchars($row['fullname']);?></h5></div>
    <span class="adm-badge <?php echo $row['IsRead']?'badge-success':'badge-warning';?>">
      <?php echo $row['IsRead']?'Answered':'Pending';?>
    </span>
  </div>
  <div class="adm-card-body">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:20px;">
      <div style="background:var(--body-bg);border-radius:10px;padding:14px;">
        <div style="font-size:.72rem;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px;">Full Name</div>
        <div style="font-size:.88rem;font-weight:600;"><?php echo htmlspecialchars($row['fullname']);?></div>
      </div>
      <div style="background:var(--body-bg);border-radius:10px;padding:14px;">
        <div style="font-size:.72rem;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px;">Email</div>
        <div style="font-size:.88rem;"><?php echo htmlspecialchars($row['email']);?></div>
      </div>
      <div style="background:var(--body-bg);border-radius:10px;padding:14px;">
        <div style="font-size:.72rem;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px;">Contact Number</div>
        <div style="font-size:.88rem;"><?php echo htmlspecialchars($row['contactno']);?></div>
      </div>
      <div style="background:var(--body-bg);border-radius:10px;padding:14px;">
        <div style="font-size:.72rem;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px;">Query Date</div>
        <div style="font-size:.88rem;"><small><?php echo htmlspecialchars($row['PostingDate']);?></small></div>
      </div>
    </div>
    <div style="background:var(--body-bg);border-radius:10px;padding:14px;margin-bottom:20px;">
      <div style="font-size:.72rem;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:6px;">Message</div>
      <div style="font-size:.88rem;line-height:1.6;"><?php echo nl2br(htmlspecialchars($row['message']));?></div>
    </div>

    <?php if(empty($row['AdminRemark'])):?>
    <form method="post">
      <div class="adm-fg">
        <label>Admin Remark <span style="color:var(--red)">*</span></label>
        <textarea name="adminremark" class="adm-input" rows="4" placeholder="Write your response to this query..." required></textarea>
      </div>
      <button type="submit" name="update" class="btn-adm btn-adm-primary"><i class="fa fa-reply"></i> Submit Remark</button>
      <a href="unread-queries.php" class="btn-adm btn-adm-outline" style="margin-left:10px">Back</a>
    </form>
    <?php else:?>
    <div style="background:#d1fae5;border:1px solid #6ee7b7;border-radius:10px;padding:14px;margin-bottom:16px;">
      <div style="font-size:.72rem;font-weight:600;color:#065f46;text-transform:uppercase;letter-spacing:.5px;margin-bottom:6px;"><i class="fa fa-check-circle"></i> Admin Remark</div>
      <div style="font-size:.88rem;color:#065f46;"><?php echo nl2br(htmlspecialchars($row['AdminRemark']));?></div>
      <div style="font-size:.75rem;color:#6ee7b7;margin-top:6px;">Last updated: <?php echo htmlspecialchars($row['LastupdationDate']);?></div>
    </div>
    <a href="read-query.php" class="btn-adm btn-adm-outline"><i class="fa fa-arrow-left"></i> Back to Read Queries</a>
    <?php endif;?>
  </div>
</div>
</div></div>
<?php else:?>
<div class="adm-alert adm-alert-error"><i class="fa fa-exclamation-circle"></i>Query not found.</div>
<?php endif;?>
</div><?php include('include/footer.php');?></div></div>
<?php include('include/scripts.php');?></body></html>
