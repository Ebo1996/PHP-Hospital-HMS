<?php
session_start();error_reporting(0);include('include/config.php');include('include/auth.php');
$pageTitle='View Patient';$pageIcon='fa-user';
$vid=intval($_GET['viewid']??0);
if(isset($_POST['submit'])){
  $bp=mysqli_real_escape_string($con,$_POST['bp']);
  $bs=mysqli_real_escape_string($con,$_POST['bs']);
  $wt=mysqli_real_escape_string($con,$_POST['weight']);
  $tp=mysqli_real_escape_string($con,$_POST['temp']);
  $pr=mysqli_real_escape_string($con,$_POST['pres']);
  $q=mysqli_query($con,"INSERT INTO tblmedicalhistory(PatientID,BloodPressure,BloodSugar,Weight,Temperature,MedicalPres) VALUES('$vid','$bp','$bs','$wt','$tp','$pr')");
  if($q){$msg='Medical record added.';$mtype='success';}
  else{$msg='Something went wrong.';$mtype='error';}
}
$ret=mysqli_query($con,"SELECT * FROM tblpatient WHERE ID='$vid'");
$patient=mysqli_fetch_array($ret);
?><!DOCTYPE html><html lang="en"><head><title>View Patient — HMS+ Doctor</title><?php include('include/head.php');?></head><body>
<div id="app"><?php include('include/sidebar.php');?>
<div class="app-content"><?php include('include/header.php');?>
<div class="main-content">
<div class="doc-breadcrumb"><i class="fa fa-home"></i><a href="dashboard.php">Dashboard</a><span class="sep">/</span><a href="manage-patient.php">Patients</a><span class="sep">/</span><span class="cur">View Patient</span></div>
<?php if(!empty($msg)):?><div class="doc-alert doc-alert-<?php echo $mtype;?>"><i class="fa fa-<?php echo $mtype==='success'?'check-circle':'exclamation-circle';?>"></i><?php echo htmlspecialchars($msg);?></div><?php endif;?>
<?php if($patient):?>

<!-- Patient Info -->
<div class="doc-card">
  <div class="doc-card-header">
    <div class="ch-left"><i class="fa fa-user"></i><h5><?php echo htmlspecialchars($patient['PatientName']);?></h5></div>
    <span class="doc-badge badge-teal"><?php echo htmlspecialchars($patient['PatientGender']);?></span>
  </div>
  <div class="doc-card-body">
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:16px;">
      <?php foreach([['Email',$patient['PatientEmail']],['Mobile',$patient['PatientContno']],['Age',$patient['PatientAge']],['Address',$patient['PatientAdd']],['Pre-existing History',$patient['PatientMedhis']?:'-'],['Registered',$patient['CreationDate']]] as $f):?>
      <div style="background:var(--body-bg);border-radius:10px;padding:14px;">
        <div style="font-size:.72rem;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px;"><?php echo $f[0];?></div>
        <div style="font-size:.9rem;"><?php echo htmlspecialchars($f[1]);?></div>
      </div>
      <?php endforeach;?>
    </div>
  </div>
</div>

<!-- Medical History -->
<div class="doc-card">
  <div class="doc-card-header"><div class="ch-left"><i class="fa fa-heartbeat"></i><h5>Visit History</h5></div></div>
  <div class="doc-card-body" style="padding:0">
  <div class="doc-table-wrap"><table class="doc-table">
    <thead><tr><th>#</th><th>BP</th><th>Blood Sugar</th><th>Weight</th><th>Temperature</th><th>Prescription</th><th>Date</th></tr></thead>
    <tbody>
    <?php $hist=mysqli_query($con,"SELECT * FROM tblmedicalhistory WHERE PatientID='$vid' ORDER BY CreationDate DESC");$c=1;
    if(mysqli_num_rows($hist)==0):?>
    <tr><td colspan="7" style="text-align:center;padding:28px;color:var(--muted)"><i class="fa fa-stethoscope" style="font-size:1.8rem;display:block;margin-bottom:8px;opacity:.3"></i>No records yet.</td></tr>
    <?php else: while($row=mysqli_fetch_array($hist)):?>
    <tr>
      <td><?php echo $c++;?></td>
      <td><?php echo htmlspecialchars($row['BloodPressure']);?></td>
      <td><?php echo htmlspecialchars($row['BloodSugar']);?></td>
      <td><?php echo htmlspecialchars($row['Weight']);?></td>
      <td><?php echo htmlspecialchars($row['Temperature']);?></td>
      <td><?php echo htmlspecialchars($row['MedicalPres']);?></td>
      <td><small><?php echo htmlspecialchars($row['CreationDate']);?></small></td>
    </tr>
    <?php endwhile;endif;?>
    </tbody>
  </table></div>
  </div>
</div>

<!-- Add Record -->
<div class="row justify-content-center"><div class="col-lg-7 col-md-10">
<div class="doc-card">
  <div class="doc-card-header"><div class="ch-left"><i class="fa fa-plus-circle"></i><h5>Add Visit Record</h5></div></div>
  <div class="doc-card-body">
  <form method="post">
    <div class="row">
      <div class="col-md-6"><div class="doc-fg"><label>Blood Pressure</label><input type="text" name="bp" class="doc-input" placeholder="e.g. 120/80" required></div></div>
      <div class="col-md-6"><div class="doc-fg"><label>Blood Sugar</label><input type="text" name="bs" class="doc-input" placeholder="e.g. 95 mg/dL" required></div></div>
    </div>
    <div class="row">
      <div class="col-md-6"><div class="doc-fg"><label>Weight (kg)</label><input type="text" name="weight" class="doc-input" placeholder="e.g. 70" required></div></div>
      <div class="col-md-6"><div class="doc-fg"><label>Body Temperature (°F)</label><input type="text" name="temp" class="doc-input" placeholder="e.g. 98.6" required></div></div>
    </div>
    <div class="doc-fg"><label>Medical Prescription</label><textarea name="pres" class="doc-input" rows="3" placeholder="Prescription details..." required></textarea></div>
    <button type="submit" name="submit" class="btn-doc btn-doc-primary"><i class="fa fa-save"></i> Save Record</button>
    <a href="manage-patient.php" class="btn-doc btn-doc-outline" style="margin-left:10px"><i class="fa fa-arrow-left"></i> Back</a>
  </form>
  </div>
</div>
</div></div>

<?php else:?><div class="doc-alert doc-alert-error"><i class="fa fa-exclamation-circle"></i>Patient not found.</div><?php endif;?>
</div><?php include('include/footer.php');?></div></div>
<?php include('include/scripts.php');?></body></html>
