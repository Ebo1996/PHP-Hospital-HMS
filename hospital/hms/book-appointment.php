<?php
session_start();
include('include/config.php');
include('include/checklogin.php');
check_login();
$pageTitle = 'Book Appointment';
$pageIcon  = 'fa-calendar-plus-o';
$successMsg = '';
if(isset($_POST['submit'])){
    $spec    = mysqli_real_escape_string($con,$_POST['Doctorspecialization']);
    $docid   = mysqli_real_escape_string($con,$_POST['doctor']);
    $userid  = $_SESSION['id'];
    $fees    = mysqli_real_escape_string($con,$_POST['fees']);
    $appdate = mysqli_real_escape_string($con,$_POST['appdate']);
    $time    = mysqli_real_escape_string($con,$_POST['apptime']);
    $q = mysqli_query($con,"INSERT INTO appointment(doctorSpecialization,doctorId,userId,consultancyFees,appointmentDate,appointmentTime,userStatus,doctorStatus) VALUES('$spec','$docid','$userid','$fees','$appdate','$time','1','1')");
    if($q) $successMsg = 'Your appointment has been booked successfully!';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Book Appointment — HMS+</title>
  <?php include('include/head.php'); ?>
  <script>
  function getdoctor(val){
    $.ajax({type:"POST",url:"get_doctor.php",data:'specilizationid='+val,success:function(data){$("#doctor").html(data);}});
  }
  function getfee(val){
    $.ajax({type:"POST",url:"get_doctor.php",data:'doctor='+val,success:function(data){$("#fees").html(data);}});
  }
  </script>
</head>
<body>
<div id="app">
  <?php include('include/sidebar.php'); ?>
  <div class="app-content">
    <?php include('include/header.php'); ?>
    <div class="main-content">

      <div class="hms-breadcrumb">
        <i class="fa fa-home"></i> <a href="dashboard.php">Dashboard</a>
        <span class="sep">/</span><span class="current">Book Appointment</span>
      </div>

      <?php if($successMsg): ?>
      <div class="hms-alert hms-alert-success"><i class="fa fa-check-circle"></i> <?php echo $successMsg; ?></div>
      <?php endif; ?>

      <div class="row justify-content-center">
        <div class="col-lg-7 col-md-10">
          <div class="hms-card">
            <div class="hms-card-header">
              <i class="fa fa-calendar-plus-o"></i>
              <h5>New Appointment</h5>
            </div>
            <div class="hms-card-body">
              <form method="post">
                <div class="hms-form-group">
                  <label><i class="fa fa-stethoscope" style="color:var(--teal);margin-right:6px;"></i>Doctor Specialization</label>
                  <select name="Doctorspecialization" class="hms-input" onchange="getdoctor(this.value);" required>
                    <option value="">— Select Specialization —</option>
                    <?php
                    $ret = mysqli_query($con,"SELECT * FROM doctorspecilization");
                    while($row = mysqli_fetch_array($ret)):?>
                    <option value="<?php echo htmlspecialchars($row['specilization']); ?>">
                      <?php echo htmlspecialchars($row['specilization']); ?>
                    </option>
                    <?php endwhile; ?>
                  </select>
                </div>
                <div class="hms-form-group">
                  <label><i class="fa fa-user-md" style="color:var(--teal);margin-right:6px;"></i>Select Doctor</label>
                  <select name="doctor" id="doctor" class="hms-input" onchange="getfee(this.value);" required>
                    <option value="">— Select Doctor —</option>
                  </select>
                </div>
                <div class="hms-form-group">
                  <label><i class="fa fa-money" style="color:var(--accent);margin-right:6px;"></i>Consultancy Fees</label>
                  <select name="fees" id="fees" class="hms-input">
                    <option>— auto-filled —</option>
                  </select>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="hms-form-group">
                      <label><i class="fa fa-calendar" style="color:var(--teal);margin-right:6px;"></i>Appointment Date</label>
                      <input type="text" name="appdate" class="hms-input datepicker" placeholder="YYYY-MM-DD" data-date-format="yyyy-mm-dd" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="hms-form-group">
                      <label><i class="fa fa-clock-o" style="color:var(--teal);margin-right:6px;"></i>Appointment Time</label>
                      <input type="text" name="apptime" id="timepicker1" class="hms-input" placeholder="e.g. 10:00 AM" required>
                    </div>
                  </div>
                </div>
                <div style="margin-top:8px;">
                  <button type="submit" name="submit" class="btn-hms btn-hms-primary">
                    <i class="fa fa-calendar-check-o"></i> Confirm Booking
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>
    <?php include('include/footer.php'); ?>
  </div>
</div>
<?php include('include/scripts.php'); ?>
<script>
$(function(){
  $('.datepicker').datepicker({format:'yyyy-mm-dd',startDate:'today'});
  $('#timepicker1').timepicker();
});
</script>
</body>
</html>
