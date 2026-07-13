<?php
session_start();error_reporting(0);include('include/config.php');include('include/auth.php');
$pageTitle='Manage Patients';$pageIcon='fa-procedures';
$docid=$_SESSION['id'];
?><!DOCTYPE html><html lang="en"><head><title>Manage Patients — HMS+ Doctor</title><?php include('include/head.php');?></head><body>
<div id="app"><?php include('include/sidebar.php');?>
<div class="app-content"><?php include('include/header.php');?>
<div class="main-content">
<div class="doc-breadcrumb"><i class="fa fa-home"></i><a href="dashboard.php">Dashboard</a><span class="sep">/</span><span class="cur">Manage Patients</span></div>
<div class="doc-card">
  <div class="doc-card-header">
    <div class="ch-left"><i class="fa fa-procedures"></i><h5>My Patients</h5></div>
    <a href="add-patient.php" class="btn-doc btn-doc-primary btn-doc-sm"><i class="fa fa-plus"></i> Add Patient</a>
  </div>
  <div class="doc-card-body" style="padding:0">
  <div class="doc-table-wrap"><table class="doc-table">
    <thead><tr><th>#</th><th>Patient Name</th><th>Contact</th><th>Gender</th><th>Registered</th><th>Last Updated</th><th>Action</th></tr></thead>
    <tbody>
    <?php
    $sql=mysqli_query($con,"SELECT * FROM tblpatient WHERE Docid='$docid' ORDER BY CreationDate DESC");
    $c=1;
    if(mysqli_num_rows($sql)==0):?>
    <tr><td colspan="7" style="text-align:center;padding:36px;color:var(--muted)"><i class="fa fa-procedures" style="font-size:2rem;display:block;margin-bottom:10px;opacity:.3"></i>No patients yet. <a href="add-patient.php">Add one</a>.</td></tr>
    <?php else: while($row=mysqli_fetch_array($sql)):?>
    <tr>
      <td><?php echo $c++;?></td>
      <td><strong><?php echo htmlspecialchars($row['PatientName']);?></strong></td>
      <td><?php echo htmlspecialchars($row['PatientContno']);?></td>
      <td><span class="doc-badge badge-teal"><?php echo htmlspecialchars($row['PatientGender']);?></span></td>
      <td><small><?php echo htmlspecialchars($row['CreationDate']);?></small></td>
      <td><small><?php echo $row['UpdationDate']?htmlspecialchars($row['UpdationDate']):'—';?></small></td>
      <td style="white-space:nowrap">
        <a href="edit-patient.php?editid=<?php echo $row['ID'];?>" class="btn-doc btn-doc-outline btn-doc-sm"><i class="fa fa-pencil"></i> Edit</a>
        <a href="view-patient.php?viewid=<?php echo $row['ID'];?>" class="btn-doc btn-doc-primary btn-doc-sm"><i class="fa fa-eye"></i> View</a>
      </td>
    </tr>
    <?php endwhile;endif;?>
    </tbody>
  </table></div>
  </div>
</div>
</div><?php include('include/footer.php');?></div></div>
<?php include('include/scripts.php');?></body></html>
