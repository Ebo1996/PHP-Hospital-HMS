<?php
session_start();
include('include/config.php');
include('include/checklogin.php');
check_login();

$pageTitle = 'Dashboard';
$pageIcon  = 'fa-home';

// Fetch counts
$uid = $_SESSION['id'];
$totalAppt = mysqli_num_rows(mysqli_query($con,"SELECT id FROM appointment WHERE userId='$uid'"));
$activeAppt= mysqli_num_rows(mysqli_query($con,"SELECT id FROM appointment WHERE userId='$uid' AND userStatus=1 AND doctorStatus=1"));
$cancelAppt= mysqli_num_rows(mysqli_query($con,"SELECT id FROM appointment WHERE userId='$uid' AND (userStatus=0 OR doctorStatus=0)"));
$query = mysqli_query($con,"SELECT fullName FROM users WHERE id='$uid'");
$urow  = mysqli_fetch_array($query);
$uname = $urow['fullName'] ?? 'Patient';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Dashboard — HMS+</title>
  <?php include('include/head.php'); ?>
  <style>
    /* Force hamburger to show on mobile - Debug styles */
    @media (max-width: 768px) {
      .hms-toggle {
        display: flex !important;
        visibility: visible !important;
        opacity: 1 !important;
        position: relative !important;
        z-index: 1000 !important;
      }
      
      /* Ensure sidebar is hidden by default on mobile */
      .hms-sidebar {
        transform: translateX(-100%) !important;
      }
      
      /* Show sidebar when open class is added */
      .hms-sidebar.open {
        transform: translateX(0) !important;
      }
    }
  </style>
</head>
<body>
<div id="app">
  <?php include('include/sidebar.php'); ?>
  <div class="app-content">
    <?php include('include/header.php'); ?>
    <div class="main-content">

      <!-- Welcome banner -->
      <div class="welcome-banner">
        <div class="welcome-content">
          <p class="welcome-subtitle">Welcome back,</p>
          <h3 class="welcome-title"><?php echo htmlspecialchars($uname); ?> 👋</h3>
          <p class="welcome-desc">Here's your health summary today.</p>
        </div>
        <div class="welcome-icon"><i class="fa fa-heartbeat"></i></div>
      </div>

<style>
/* Welcome Banner */
.welcome-banner {
  background: linear-gradient(135deg, var(--teal-dark), var(--teal));
  border-radius: 18px;
  padding: 28px 32px;
  margin-bottom: 28px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  box-shadow: 0 8px 30px rgba(0,95,115,0.25);
  flex-wrap: wrap;
  gap: 16px;
  position: relative;
  overflow: hidden;
}
.welcome-banner::before {
  content: '';
  position: absolute;
  top: -50%;
  right: -20%;
  width: 300px;
  height: 300px;
  background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
  border-radius: 50%;
  pointer-events: none;
}
.welcome-content {
  flex: 1;
  min-width: 200px;
  position: relative;
  z-index: 2;
}
.welcome-subtitle {
  color: rgba(255,255,255,0.75);
  font-size: 0.82rem;
  margin-bottom: 4px;
}
.welcome-title {
  color: #fff;
  font-size: 1.5rem;
  font-weight: 800;
  margin: 0;
  line-height: 1.2;
}
.welcome-desc {
  color: rgba(255,255,255,0.7);
  font-size: 0.85rem;
  margin-top: 6px;
  margin-bottom: 0;
}
.welcome-icon {
  opacity: 0.12;
  font-size: 6rem;
  flex-shrink: 0;
  position: relative;
  z-index: 1;
}

/* Quick Actions Section Label */
.section-label {
  font-weight: 700;
  font-size: 0.85rem;
  letter-spacing: 0.5px;
  text-transform: uppercase;
  color: var(--muted);
  margin-bottom: 16px;
  margin-top: 32px;
  display: flex;
  align-items: center;
  gap: 8px;
}
.section-label::before {
  content: '';
  width: 4px;
  height: 18px;
  background: var(--teal);
  border-radius: 2px;
}

/* Responsive Design */
@media (max-width: 1024px) {
  .welcome-banner {
    padding: 24px 26px;
  }
  .welcome-icon {
    font-size: 5rem;
  }
}

@media (max-width: 768px) {
  .welcome-banner {
    padding: 20px 22px;
  }
  .welcome-subtitle {
    font-size: 0.78rem;
  }
  .welcome-title {
    font-size: 1.3rem;
  }
  .welcome-desc {
    font-size: 0.82rem;
  }
  .welcome-icon {
    font-size: 4rem;
  }
  .row [class*='col-'] {
    margin-bottom: 0;
  }
  .section-label {
    font-size: 0.8rem;
    margin-top: 24px;
  }
}

@media (max-width: 576px) {
  .welcome-banner {
    padding: 18px 18px;
    text-align: center;
    flex-direction: column;
  }
  .welcome-content {
    min-width: 100%;
  }
  .welcome-title {
    font-size: 1.2rem;
  }
  .welcome-desc {
    font-size: 0.8rem;
  }
  .welcome-icon {
    display: none;
  }
}

@media (max-width: 480px) {
  .welcome-banner {
    padding: 16px;
  }
  .welcome-subtitle {
    font-size: 0.75rem;
  }
  .welcome-title {
    font-size: 1.1rem;
  }
  .welcome-desc {
    font-size: 0.78rem;
  }
  .section-label {
    font-size: 0.78rem;
  }
}
</style>

      <!-- Stat cards -->
      <div class="row">
        <div class="col-md-4">
          <div class="hms-stat">
            <div class="stat-icon" style="background:rgba(10,147,150,0.12);color:var(--teal)"><i class="fa fa-calendar"></i></div>
            <div><div class="stat-num"><?php echo $totalAppt; ?></div><div class="stat-label">Total Appointments</div></div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="hms-stat">
            <div class="stat-icon" style="background:rgba(45,106,79,0.12);color:#2d6a4f"><i class="fa fa-check-circle"></i></div>
            <div><div class="stat-num"><?php echo $activeAppt; ?></div><div class="stat-label">Active Appointments</div></div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="hms-stat">
            <div class="stat-icon" style="background:rgba(230,57,70,0.1);color:#e63946"><i class="fa fa-times-circle"></i></div>
            <div><div class="stat-num"><?php echo $cancelAppt; ?></div><div class="stat-label">Cancelled</div></div>
          </div>
        </div>
      </div>

      <!-- Quick actions -->
      <h6 class="section-label">Quick Actions</h6>
      <div class="row">
        <div class="col-md-4">
          <a href="edit-profile.php" class="qa-card">
            <div class="qa-icon" style="background:rgba(10,147,150,0.1);color:var(--teal)"><i class="fa fa-user"></i></div>
            <h5>My Profile</h5>
            <p>View and update your personal information</p>
            <span class="qa-btn" style="background:var(--teal-xlight);color:var(--teal)">Update Profile <i class="fa fa-arrow-right"></i></span>
          </a>
        </div>
        <div class="col-md-4">
          <a href="appointment-history.php" class="qa-card">
            <div class="qa-icon" style="background:rgba(0,119,182,0.1);color:var(--blue)"><i class="fa fa-calendar"></i></div>
            <h5>My Appointments</h5>
            <p>View all your scheduled and past appointments</p>
            <span class="qa-btn" style="background:rgba(0,119,182,0.1);color:var(--blue)">View History <i class="fa fa-arrow-right"></i></span>
          </a>
        </div>
        <div class="col-md-4">
          <a href="book-appointment.php" class="qa-card">
            <div class="qa-icon" style="background:rgba(238,155,0,0.1);color:var(--accent)"><i class="fa fa-calendar-plus-o"></i></div>
            <h5>Book Appointment</h5>
            <p>Schedule a new appointment with a specialist</p>
            <span class="qa-btn" style="background:rgba(238,155,0,0.1);color:var(--accent)">Book Now <i class="fa fa-arrow-right"></i></span>
          </a>
        </div>
        <div class="col-md-4">
          <a href="manage-medhistory.php" class="qa-card">
            <div class="qa-icon" style="background:rgba(45,106,79,0.1);color:#2d6a4f"><i class="fa fa-heartbeat"></i></div>
            <h5>Medical History</h5>
            <p>View your complete medical records and history</p>
            <span class="qa-btn" style="background:rgba(45,106,79,0.1);color:#2d6a4f">View Records <i class="fa fa-arrow-right"></i></span>
          </a>
        </div>
        <div class="col-md-4">
          <a href="change-password.php" class="qa-card">
            <div class="qa-icon" style="background:rgba(123,44,191,0.1);color:#7b2cbf"><i class="fa fa-lock"></i></div>
            <h5>Change Password</h5>
            <p>Update your account security credentials</p>
            <span class="qa-btn" style="background:rgba(123,44,191,0.1);color:#7b2cbf">Update <i class="fa fa-arrow-right"></i></span>
          </a>
        </div>
      </div>

    </div>
    <?php include('include/footer.php'); ?>
  </div>
</div>
<?php include('include/scripts.php'); ?>
</body>
</html>
