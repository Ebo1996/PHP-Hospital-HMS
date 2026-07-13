<?php
session_start();error_reporting(0);include('include/config.php');include('include/auth.php');
$pageTitle='Contact Us';$pageIcon='fa-envelope';
if(isset($_POST['submit'])){
  $pagetitle=mysqli_real_escape_string($con,$_POST['pagetitle']);
  $pagedes=mysqli_real_escape_string($con,$_POST['pagedes']);
  $email=mysqli_real_escape_string($con,$_POST['email']);
  $mobnum=mysqli_real_escape_string($con,$_POST['mobnum']);
  $q=mysqli_query($con,"UPDATE tblpage SET PageTitle='$pagetitle',PageDescription='$pagedes',Email='$email',MobileNumber='$mobnum' WHERE PageType='contactus'");
  $msg=$q?'Contact Us updated successfully.':'Something went wrong. Please try again.';
  $mtype=$q?'success':'error';
}
?><!DOCTYPE html><html lang="en"><head><title>Contact Us — HMS+ Admin</title><?php include('include/head.php');?></head><body>
<div id="app"><?php include('include/sidebar.php');?>
<div class="app-content"><?php include('include/header.php');?>
<div class="main-content">
<div class="adm-breadcrumb"><i class="fa fa-home"></i><a href="dashboard.php">Dashboard</a><span class="sep">/</span><span class="cur">Contact Us</span></div>
<?php if(!empty($msg)):?><div class="adm-alert adm-alert-<?php echo $mtype;?>"><i class="fa fa-<?php echo $mtype==='success'?'check-circle':'exclamation-circle';?>"></i><?php echo htmlspecialchars($msg);?></div><?php endif;?>
<div class="row justify-content-center"><div class="col-lg-8 col-md-10">
<div class="adm-card">
  <div class="adm-card-header"><div class="ch-left"><i class="fa fa-envelope"></i><h5>Update Contact Us Content</h5></div></div>
  <div class="adm-card-body">
  <form method="post">
    <?php $ret=mysqli_query($con,"SELECT * FROM tblpage WHERE PageType='contactus'");
    while($row=mysqli_fetch_array($ret)):?>
    <div class="adm-fg">
      <label>Page Title</label>
      <input type="text" name="pagetitle" class="adm-input" value="<?php echo htmlspecialchars($row['PageTitle']);?>" required>
    </div>
    <div class="adm-fg">
      <label>Page Description</label>
      <textarea name="pagedes" class="adm-input" rows="5"><?php echo htmlspecialchars($row['PageDescription']);?></textarea>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="adm-fg">
          <label>Email Address</label>
          <input type="email" name="email" class="adm-input" value="<?php echo htmlspecialchars($row['Email']);?>" required>
        </div>
      </div>
      <div class="col-md-6">
        <div class="adm-fg">
          <label>Mobile Number</label>
          <input type="text" name="mobnum" class="adm-input" value="<?php echo htmlspecialchars($row['MobileNumber']);?>" required maxlength="10" pattern="[0-9]+">
        </div>
      </div>
    </div>
    <?php endwhile;?>
    <button type="submit" name="submit" class="btn-adm btn-adm-primary"><i class="fa fa-save"></i> Save Changes</button>
    <a href="dashboard.php" class="btn-adm btn-adm-outline" style="margin-left:10px">Cancel</a>
  </form>
  </div>
</div>
</div></div>
</div><?php include('include/footer.php');?></div></div>
<?php include('include/scripts.php');?></body></html>
