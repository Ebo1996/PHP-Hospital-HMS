<?php
session_start();error_reporting(0);include('include/config.php');include('include/auth.php');
$pageTitle='Search Patient';$pageIcon='fa-search';
$searched=false;$q='';
if(isset($_POST['search'])){
  $searched=true;
  $q=mysqli_real_escape_string($con,$_POST['searchdata']);
  $results=mysqli_query($con,"SELECT * FROM tblpatient WHERE PatientName LIKE '%$q%' OR PatientContno LIKE '%$q%'");
}
?><!DOCTYPE html><html lang="en"><head><title>Search Patient — HMS+ Doctor</title><?php include('include/head.php');?></head><body>
<div id="app"><?php include('include/sidebar.php');?>
<div class="app-content"><?php include('include/header.php');?>
<div class="main-content">
<div class="doc-breadcrumb"><i class="fa fa-home"></i><a href="dashboard.php">Dashboard</a><span class="sep">/</span><span class="cur">Search Patient</span></div>
<div class="doc-card" style="margin-bottom:22px">
  <div class="doc-card-header"><div class="ch-left"><i class="fa fa-search"></i><h5>Search Patients</h5></div></div>
  <div class="doc-card-body">
    <form method="post">
      <div class="row align-items-end">
        <div class="col-md-9"><div class="doc-fg" style="margin-bottom:0"><label>Search by Name or Mobile Number</label><input type="text" name="searchdata" class="doc-input" placeholder="Enter patient name or phone number…" value="<?php echo htmlspecialchars($_POST['searchdata']??'');?>" required></div></div>
        <div class="col-md-3"><button type="submit" name="search" class="btn-doc btn-doc-primary" style="width:100%;justify-content:center;padding:12px"><i class="fa fa-search"></i> Search</button></div>
      </div>
    </form>
  </div>
</div>
<?php if($searched):?>
<div class="doc-card">
  <div class="doc-card-header"><div class="ch-left"><i class="fa fa-list"></i><h5>Results for "<?php echo htmlspecialchars($q);?>"</h5></div></div>
  <div class="doc-card-body" style="padding:0">
  <div class="doc-table-wrap"><table class="doc-table">
    <thead><tr><th>#</th><th>Name</th><th>Contact</th><th>Gender</th><th>Registered</th><th>Action</th></tr></thead>
    <tbody>
    <?php $c=1;$found=false;
    while($row=mysqli_fetch_array($results)):$found=true;?>
    <tr>
      <td><?php echo $c++;?></td>
      <td><strong><?php echo htmlspecialchars($row['PatientName']);?></strong></td>
      <td><?php echo htmlspecialchars($row['PatientContno']);?></td>
      <td><span class="doc-badge badge-teal"><?php echo htmlspecialchars($row['PatientGender']);?></span></td>
      <td><small><?php echo htmlspecialchars($row['CreationDate']);?></small></td>
      <td style="white-space:nowrap">
        <a href="edit-patient.php?editid=<?php echo $row['ID'];?>" class="btn-doc btn-doc-outline btn-doc-sm"><i class="fa fa-pencil"></i> Edit</a>
        <a href="view-patient.php?viewid=<?php echo $row['ID'];?>" class="btn-doc btn-doc-primary btn-doc-sm"><i class="fa fa-eye"></i> View</a>
      </td>
    </tr>
    <?php endwhile;?>
    <?php if(!$found):?><tr><td colspan="6" style="text-align:center;padding:36px;color:var(--muted)"><i class="fa fa-search" style="font-size:2rem;display:block;margin-bottom:10px;opacity:.3"></i>No patients found for "<?php echo htmlspecialchars($q);?>".</td></tr><?php endif;?>
    </tbody>
  </table></div>
  </div>
</div>
<?php endif;?>
</div><?php include('include/footer.php');?></div></div>
<?php include('include/scripts.php');?></body></html>
