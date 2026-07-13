<?php
session_start();error_reporting(0);include('include/config.php');include('include/auth.php');
$pageTitle='View Patient';$pageIcon='fa-user';
$vid=intval($_GET['viewid']??0);

if(isset($_POST['submit'])){
  $bp=mysqli_real_escape_string($con,$_POST['bp']);
  $bs=mysqli_real_escape_string($con,$_POST['bs']);
  $weight=mysqli_real_escape_string($con,$_POST['weight']);
  $temp=mysqli_real_escape_string($con,$_POST['temp']);
  $pres=mysqli_real_escape_string($con,$_POST['pres']);
  $q=mysqli_query($con,"INSERT INTO tblmedicalhistory(PatientID,BloodPressure,BloodSugar,Weight,Temperature,MedicalPres) VALUES('$vid','$bp','$bs','$weight','$temp','$pres')");
  if($q){$msg='Medical history added successfully.';$mtype='success';}
  else{$msg='Something went wrong. Please try again.';$mtype='error';}
}
?><!DOCTYPE html><html lang="en"><head><title>View Patient — HMS+ Admin</title><?php include('include/head.php');?></head><body>
<div id="app"><?php include('include/sidebar.php');?>
<div class="app-content"><?php include('include/header.php');?>
<div class="main-content">
<div class="adm-breadcrumb"><i class="fa fa-home"></i><a href="dashboard.php">Dashboard</a><span class="sep">/</span><a href="manage-patient.php">Patients</a><span class="sep">/</span><span class="cur">View Patient</span></div>
<?php if(!empty($msg)):?><div class="adm-alert adm-alert-<?php echo $mtype;?>"><i class="fa fa-<?php echo $mtype==='success'?'check-circle':'exclamation-circle';?>"></i><?php echo htmlspecialchars($msg);?></div><?php endif;?>

<?php
$ret=mysqli_query($con,"SELECT * FROM tblpatient WHERE ID='$vid'");
$patient=mysqli_fetch_array($ret);
if($patient):?>

<!-- Patient Info Card -->
<div class="adm-card" style="margin-bottom:24px;">
  <div class="adm-card-header">
    <div class="ch-left"><i class="fa fa-user"></i><h5><?php echo htmlspecialchars($patient['PatientName']);?></h5></div>
    <span class="adm-badge badge-info"><?php echo htmlspecialchars($patient['PatientGender']);?></span>
  </div>
  <div class="adm-card-body">
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:16px;">
      <div style="background:var(--body-bg);border-radius:10px;padding:14px;">
        <div style="font-size:.72rem;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px;">Email</div>
        <div style="font-size:.85rem;"><?php echo htmlspecialchars($patient['PatientEmail']);?></div>
      </div>
      <div style="background:var(--body-bg);border-radius:10px;padding:14px;">
        <div style="font-size:.72rem;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px;">Mobile</div>
        <div style="font-size:.85rem;"><?php echo htmlspecialchars($patient['PatientContno']);?></div>
      </div>
      <div style="background:var(--body-bg);border-radius:10px;padding:14px;">
        <div style="font-size:.72rem;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px;">Age</div>
        <div style="font-size:.85rem;"><?php echo htmlspecialchars($patient['PatientAge']);?></div>
      </div>
      <div style="background:var(--body-bg);border-radius:10px;padding:14px;">
        <div style="font-size:.72rem;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px;">Address</div>
        <div style="font-size:.85rem;"><?php echo htmlspecialchars($patient['PatientAdd']);?></div>
      </div>
      <div style="background:var(--body-bg);border-radius:10px;padding:14px;">
        <div style="font-size:.72rem;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px;">Medical History (pre-existing)</div>
        <div style="font-size:.85rem;"><?php echo $patient['PatientMedhis']?htmlspecialchars($patient['PatientMedhis']):'—';?></div>
      </div>
      <div style="background:var(--body-bg);border-radius:10px;padding:14px;">
        <div style="font-size:.72rem;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px;">Registered</div>
        <div style="font-size:.85rem;"><small><?php echo htmlspecialchars($patient['CreationDate']);?></small></div>
      </div>
    </div>
  </div>
</div>

<!-- Medical History Table -->
<div class="adm-card" style="margin-bottom:24px;">
  <div class="adm-card-header"><div class="ch-left"><i class="fa fa-heartbeat"></i><h5>Visit History</h5></div></div>
  <div class="adm-card-body" style="padding:0">
  <div class="adm-table-wrap">
  <table class="adm-table">
    <thead>
      <tr>
        <th>#</th>
        <th>Blood Pressure</th>
        <th>Blood Sugar</th>
        <th>Weight</th>
        <th>Temperature</th>
        <th>Prescription</th>
        <th>Visit Date</th>
      </tr>
    </thead>
    <tbody>
    <?php
    $hist=mysqli_query($con,"SELECT * FROM tblmedicalhistory WHERE PatientID='$vid' ORDER BY CreationDate DESC");
    $cnt=1;
    if(mysqli_num_rows($hist)==0):?>
    <tr><td colspan="7" style="text-align:center;padding:28px;color:var(--muted);"><i class="fa fa-stethoscope" style="font-size:1.8rem;display:block;margin-bottom:8px;"></i>No visit records yet.</td></tr>
    <?php else: while($row=mysqli_fetch_array($hist)):?>
    <tr>
      <td><?php echo $cnt++;?></td>
      <td><?php echo htmlspecialchars($row['BloodPressure']);?></td>
      <td><?php echo htmlspecialchars($row['BloodSugar']);?></td>
      <td><?php echo htmlspecialchars($row['Weight']);?></td>
      <td><?php echo htmlspecialchars($row['Temperature']);?></td>
      <td><?php echo htmlspecialchars($row['MedicalPres']);?></td>
      <td><small><?php echo htmlspecialchars($row['CreationDate']);?></small></td>
    </tr>
    <?php endwhile; endif;?>
    </tbody>
  </table>
  </div>
  </div>
</div>

<!-- Add Medical History Form -->
<div class="row justify-content-center"><div class="col-lg-7 col-md-10">
<div class="adm-card">
  <div class="adm-card-header"><div class="ch-left"><i class="fa fa-plus-circle"></i><h5>Add Visit Record</h5></div></div>
  <div class="adm-card-body">
  <form method="post">
    <div class="row">
      <div class="col-md-6"><div class="adm-fg"><label>Blood Pressure</label><input type="text" name="bp" class="adm-input" placeholder="e.g. 120/80" required></div></div>
      <div class="col-md-6"><div class="adm-fg"><label>Blood Sugar</label><input type="text" name="bs" class="adm-input" placeholder="e.g. 95 mg/dL" required></div></div>
    </div>
    <div class="row">
      <div class="col-md-6"><div class="adm-fg"><label>Weight (kg)</label><input type="text" name="weight" class="adm-input" placeholder="e.g. 70" required></div></div>
      <div class="col-md-6"><div class="adm-fg"><label>Body Temperature (°F)</label><input type="text" name="temp" class="adm-input" placeholder="e.g. 98.6" required></div></div>
    </div>
    <div class="adm-fg"><label>Medical Prescription</label><textarea name="pres" class="adm-input" rows="3" placeholder="Enter prescription details..." required></textarea></div>
    <button type="submit" name="submit" class="btn-adm btn-adm-primary"><i class="fa fa-save"></i> Save Record</button>
    <a href="manage-patient.php" class="btn-adm btn-adm-outline" style="margin-left:10px"><i class="fa fa-arrow-left"></i> Back</a>
  </form>
  </div>
</div>
</div></div>

<?php else:?>
<div class="adm-alert adm-alert-error"><i class="fa fa-exclamation-circle"></i>Patient not found.</div>
<?php endif;?>

</div><?php include('include/footer.php');?></div></div>
<?php include('include/scripts.php');?></body></html>
