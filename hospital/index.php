<?php
include_once('hms/include/config.php');
if(isset($_POST['submit'])){
    $name=mysqli_real_escape_string($con,$_POST['fullname']);
    $email=mysqli_real_escape_string($con,$_POST['emailid']);
    $mobileno=mysqli_real_escape_string($con,$_POST['mobileno']);
    $dscrption=mysqli_real_escape_string($con,$_POST['description']);
    mysqli_query($con,"INSERT INTO tblcontactus(fullname,email,contactno,message) VALUES('$name','$email','$mobileno','$dscrption')");
    echo "<script>alert('Your message was sent successfully!');window.location.href='index.php';</script>";
}
?><!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>HMS — Hospital Management System</title>
<link rel="icon" href="assets/images/medical.png" type="image/x-icon">
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/fontawsom-all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700;9..144,800&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>
/* ===================== GLOBAL ===================== */
:root{
  --teal:#0a9396;--teal-dark:#005f73;--teal-light:#94d2bd;--teal-xlight:#e9f5f5;
  --accent:#ee9b00;--accent-light:#fff3cd;
  --blue:#0077b6;--blue-light:#caf0f8;
  --green:#2d6a4f;--green-light:#d8f3dc;
  --red:#e63946;--red-light:#ffe8e9;
  --dark:#0d1b2a;--body:#f4fafa;--muted:#6c757d;--white:#fff;
  --font-display:'Fraunces','Poppins',serif;--font-body:'Poppins',sans-serif;
  --radius:16px;--shadow:0 8px 32px rgba(0,95,115,0.13);
}
*{margin:0;padding:0;box-sizing:border-box;}
html{scroll-behavior:smooth;}
body{font-family:var(--font-body);background:var(--body);color:var(--dark);overflow-x:hidden;-webkit-font-smoothing:antialiased;font-size:1rem;}
a{text-decoration:none;color:inherit;}
img{max-width:100%;display:block;}
.section-pad{padding:100px 0;}
h1,h2,h3,.nav-brand,.hero-title,.sec-title,.footer-brand-name,.contact-info-box h3,.contact-form-box h3,.about-exp-badge .exp-num,.stat-card .s-num{font-family:var(--font-display);letter-spacing:-0.01em;}
::selection{background:var(--teal);color:#fff;}
</style>
</head>
<body>

<!-- ╔══════════════════════════════════════════════╗
     ║           SECTION 1 · NAVBAR                ║
     ╚══════════════════════════════════════════════╝ -->
<style>
.navbar-hms{
  position:fixed;top:0;left:0;width:100%;z-index:2000;
  background:rgba(255,255,255,0.92);backdrop-filter:blur(16px);
  -webkit-backdrop-filter:blur(16px);
  border-bottom:1px solid rgba(10,147,150,0.1);
  transition:all 0.4s ease;
  padding:0 0;
}
.navbar-hms.scrolled{
  background:rgba(255,255,255,0.98);
  box-shadow:0 4px 30px rgba(0,95,115,0.15);
  padding:0;
}
.navbar-hms .container{display:flex;align-items:center;justify-content:space-between;height:72px;}
/* Brand */
.nav-brand{display:flex;align-items:center;gap:10px;font-size:1.55rem;font-weight:800;color:var(--teal-dark);letter-spacing:-0.5px;}
.nav-brand .brand-icon{width:40px;height:40px;background:linear-gradient(135deg,var(--teal),var(--teal-dark));border-radius:10px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:1.1rem;}
.nav-brand span{color:var(--teal);}
/* Links */
.nav-links{display:flex;align-items:center;gap:4px;list-style:none;}
.nav-links li a{
  font-size:0.88rem;font-weight:500;color:#444;
  padding:8px 14px;border-radius:8px;
  transition:all 0.25s;position:relative;
}
.nav-links li a:hover,.nav-links li a.active{color:var(--teal);background:var(--teal-xlight);}
.nav-links li a.active::after{
  content:'';position:absolute;bottom:2px;left:50%;transform:translateX(-50%);
  width:18px;height:2px;background:var(--teal);border-radius:2px;
}
/* CTA button */
.nav-cta{
  background:linear-gradient(135deg,var(--teal),var(--teal-dark));
  color:#fff!important;border-radius:25px;
  padding:10px 22px!important;font-weight:600!important;
  box-shadow:0 4px 15px rgba(0,95,115,0.35);
  transition:transform 0.2s,box-shadow 0.2s!important;
}
.nav-cta:hover{transform:translateY(-2px)!important;box-shadow:0 8px 25px rgba(0,95,115,0.45)!important;background:var(--teal-dark)!important;color:#fff!important;}
.nav-cta.active::after{display:none!important;}
/* Hamburger */
.nav-hamburger{display:none;flex-direction:column;gap:5px;cursor:pointer;padding:6px;border:none;background:none;}
.nav-hamburger span{display:block;width:24px;height:2px;background:var(--teal-dark);border-radius:2px;transition:all 0.3s;}
.nav-hamburger.open span:nth-child(1){transform:rotate(45deg) translate(5px,5px);}
.nav-hamburger.open span:nth-child(2){opacity:0;}
.nav-hamburger.open span:nth-child(3){transform:rotate(-45deg) translate(5px,-5px);}
/* Mobile */
@media(max-width:768px){
  .nav-links{display:none;position:absolute;top:72px;left:0;width:100%;background:#fff;flex-direction:column;gap:0;padding:16px 0;box-shadow:0 8px 30px rgba(0,0,0,0.1);}
  .nav-links.show{display:flex;}
  .nav-links li{width:100%;}
  .nav-links li a{display:block;padding:12px 28px;border-radius:0;border-bottom:1px solid #f0f0f0;}
  .nav-hamburger{display:flex;}
}
</style>

<nav class="navbar-hms" id="mainNav">
  <div class="container">
    <a class="nav-brand" href="#">
      <div class="brand-icon"><i class="fas fa-heartbeat"></i></div>
      HMS<span>+</span>
    </a>
    <ul class="nav-links" id="navLinks">
      <li><a href="#hero" class="active">Home</a></li>
      <li><a href="#services">Services</a></li>
      <li><a href="#about_us">About</a></li>
      <li><a href="#gallery">Gallery</a></li>
      <li><a href="#contact_us">Contact</a></li>
      <li><a href="hms/user-login.php" class="nav-cta">Book Appointment</a></li>
    </ul>
    <button class="nav-hamburger" id="navHamburger" aria-label="Toggle menu">
      <span></span><span></span><span></span>
    </button>
  </div>
</nav>

<!-- ╔══════════════════════════════════════════════╗
     ║           SECTION 2 · HERO                  ║
     ╚══════════════════════════════════════════════╝ -->
<style>
.hero-section{
  min-height:100vh;padding-top:72px;
  background:linear-gradient(135deg,#003845 0%,#005f73 40%,#0a9396 75%,#52b69a 100%);
  position:relative;overflow:hidden;display:flex;align-items:center;
}
/* Decorative blobs */
.hero-blob{position:absolute;border-radius:50%;filter:blur(80px);opacity:0.18;pointer-events:none;}
.hero-blob-1{width:600px;height:600px;background:#94d2bd;top:-200px;right:-150px;}
.hero-blob-2{width:400px;height:400px;background:#ee9b00;bottom:-150px;left:-100px;}
.hero-blob-3{width:250px;height:250px;background:#fff;top:40%;left:30%;}
/* Floating cross icons */
.hero-crosses span{position:absolute;color:rgba(255,255,255,0.12);font-size:2rem;animation:floatY 4s ease-in-out infinite;}
.hero-crosses span:nth-child(1){top:15%;left:8%;animation-delay:0s;}
.hero-crosses span:nth-child(2){top:65%;left:5%;animation-delay:1s;font-size:1.2rem;}
.hero-crosses span:nth-child(3){top:25%;right:8%;animation-delay:2s;font-size:1.5rem;}
.hero-crosses span:nth-child(4){bottom:20%;right:12%;animation-delay:0.5s;font-size:2.5rem;}
@keyframes floatY{0%,100%{transform:translateY(0);}50%{transform:translateY(-18px);}}
/* Content */
.hero-left{position:relative;z-index:3;padding:80px 0 80px;}
.hero-eyebrow{
  display:inline-flex;align-items:center;gap:8px;
  background:rgba(255,255,255,0.15);border:1px solid rgba(255,255,255,0.3);
  color:#fff;border-radius:30px;padding:8px 18px;font-size:0.8rem;font-weight:500;
  letter-spacing:1px;text-transform:uppercase;margin-bottom:24px;
  backdrop-filter:blur(6px);
}
.hero-eyebrow i{color:var(--accent);}
.hero-title{font-size:3.6rem;font-weight:800;color:#fff;line-height:1.15;margin-bottom:22px;}
.hero-title .highlight{
  color:transparent;
  background:linear-gradient(90deg,#94d2bd,#ee9b00);
  -webkit-background-clip:text;background-clip:text;
}
.hero-desc{font-size:1.05rem;color:rgba(255,255,255,0.82);line-height:1.85;max-width:500px;margin-bottom:40px;}
.hero-actions{display:flex;align-items:center;gap:16px;flex-wrap:wrap;}
.btn-hero-solid{
  background:#fff;color:var(--teal-dark);font-weight:700;
  padding:15px 34px;border-radius:50px;font-size:0.95rem;
  box-shadow:0 8px 25px rgba(0,0,0,0.2);transition:all 0.3s;
  display:inline-flex;align-items:center;gap:8px;
}
.btn-hero-solid:hover{background:var(--accent);color:#fff;transform:translateY(-3px);box-shadow:0 14px 35px rgba(238,155,0,0.4);}
.btn-hero-ghost{
  background:transparent;color:#fff;font-weight:600;
  padding:14px 32px;border-radius:50px;font-size:0.95rem;
  border:2px solid rgba(255,255,255,0.55);transition:all 0.3s;
  display:inline-flex;align-items:center;gap:8px;
}
.btn-hero-ghost:hover{background:rgba(255,255,255,0.15);border-color:#fff;transform:translateY(-2px);}
/* Pulse ring on icon */
.pulse-ring{position:relative;display:inline-flex;}
.pulse-ring::after{
  content:'';position:absolute;inset:-6px;border-radius:50%;
  border:2px solid rgba(238,155,0,0.5);animation:pulse 2s ease-out infinite;
}
@keyframes pulse{0%{transform:scale(1);opacity:1;}100%{transform:scale(1.5);opacity:0;}}
/* Hero image side */
.hero-right{position:relative;z-index:3;padding:80px 0;}
.hero-img-frame{position:relative;display:inline-block;}
.hero-img-frame img{
  border-radius:24px;width:100%;max-height:520px;object-fit:cover;
  box-shadow:0 40px 80px rgba(0,0,0,0.4);
  border:3px solid rgba(255,255,255,0.2);
}
/* Corner deco */
.hero-img-frame::before{
  content:'';position:absolute;top:-12px;left:-12px;width:80px;height:80px;
  border-top:3px solid var(--accent);border-left:3px solid var(--accent);border-radius:6px;
}
.hero-img-frame::after{
  content:'';position:absolute;bottom:-12px;right:-12px;width:80px;height:80px;
  border-bottom:3px solid rgba(255,255,255,0.4);border-right:3px solid rgba(255,255,255,0.4);border-radius:6px;
}
/* Floating stat cards */
.hero-stat{
  position:absolute;background:#fff;border-radius:14px;
  padding:14px 18px;box-shadow:0 10px 35px rgba(0,0,0,0.18);
  display:flex;align-items:center;gap:12px;min-width:160px;
  animation:floatY 5s ease-in-out infinite;
}
.hero-stat-1{bottom:60px;left:-40px;animation-delay:0.3s;}
.hero-stat-2{top:40px;right:-30px;animation-delay:1.5s;}
.hero-stat .hs-icon{width:44px;height:44px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.2rem;flex-shrink:0;}
.hero-stat .hs-num{font-size:1.2rem;font-weight:800;line-height:1;color:var(--dark);}
.hero-stat .hs-label{font-size:0.72rem;color:var(--muted);margin-top:2px;}
/* Scroll indicator */
.hero-scroll{position:absolute;bottom:32px;left:50%;transform:translateX(-50%);display:flex;flex-direction:column;align-items:center;gap:8px;color:rgba(255,255,255,0.6);font-size:0.78rem;z-index:3;}
.scroll-dot{width:24px;height:38px;border:2px solid rgba(255,255,255,0.4);border-radius:12px;position:relative;}
.scroll-dot::after{content:'';position:absolute;top:5px;left:50%;transform:translateX(-50%);width:4px;height:8px;background:rgba(255,255,255,0.6);border-radius:2px;animation:scrollDown 1.6s ease-in-out infinite;}
@keyframes scrollDown{0%{top:5px;opacity:1;}100%{top:20px;opacity:0;}}
@media(max-width:991px){.hero-title{font-size:2.5rem;}.hero-right{padding-top:0;}.hero-stat{display:none;}}
@media(max-width:767px){
  .hero-title{font-size:2rem;}.hero-left{padding:50px 0 40px;}
  .hero-eyebrow{font-size:0.72rem;padding:6px 14px;}
  .hero-desc{font-size:0.95rem;max-width:100%;}
  .hero-actions{gap:12px;}
  .btn-hero-solid{padding:13px 28px;font-size:0.88rem;}
  .btn-hero-ghost{padding:12px 26px;font-size:0.88rem;}
  .hero-img-frame::before,.hero-img-frame::after{width:50px;height:50px;}
  .hero-scroll{display:none;}
}
@media(max-width:480px){
  .hero-title{font-size:1.6rem;}
  .btn-hero-solid,.btn-hero-ghost{width:100%;justify-content:center;}
  .nav-brand{font-size:1.3rem;}
  .nav-brand .brand-icon{width:36px;height:36px;font-size:1rem;}
}
</style>

<section class="hero-section" id="hero">
  <div class="hero-blob hero-blob-1"></div>
  <div class="hero-blob hero-blob-2"></div>
  <div class="hero-blob hero-blob-3"></div>
  <div class="hero-crosses">
    <span><i class="fas fa-plus"></i></span>
    <span><i class="fas fa-plus"></i></span>
    <span><i class="fas fa-plus"></i></span>
    <span><i class="fas fa-plus"></i></span>
  </div>
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 hero-left">
        <div class="hero-eyebrow"><i class="fas fa-shield-alt"></i> Trusted Healthcare Since 2010</div>
        <h1 class="hero-title">Your Health Is Our<br><span class="highlight">Top Priority</span></h1>
        <p class="hero-desc">A modern platform connecting patients, doctors & admins. Book appointments, track records, and manage your healthcare — all in one seamless system.</p>
        <div class="hero-actions">
          <a href="hms/user-login.php" class="btn-hero-solid">
            <span class="pulse-ring"><i class="fas fa-calendar-plus"></i></span> Book Appointment
          </a>
          <a href="#about_us" class="btn-hero-ghost"><i class="fas fa-play-circle"></i> Learn More</a>
        </div>
      </div>
      <div class="col-lg-6 hero-right">
        <div class="hero-img-frame">
          <img src="assets/images/slider/slider_1.jpg" alt="Hospital">
          <div class="hero-stat hero-stat-1">
            <div class="hs-icon" style="background:rgba(10,147,150,0.12);color:var(--teal)"><i class="fas fa-user-md"></i></div>
            <div><div class="hs-num">120+</div><div class="hs-label">Specialist Doctors</div></div>
          </div>
          <div class="hero-stat hero-stat-2">
            <div class="hs-icon" style="background:rgba(238,155,0,0.12);color:var(--accent)"><i class="fas fa-smile-beam"></i></div>
            <div><div class="hs-num">50K+</div><div class="hs-label">Happy Patients</div></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="hero-scroll"><div class="scroll-dot"></div>Scroll</div>
</section>

<!-- ╔══════════════════════════════════════════════╗
     ║           SECTION 3 · STATS BAR             ║
     ╚══════════════════════════════════════════════╝ -->
<style>
.stats-section{background:var(--dark);padding:0;position:relative;overflow:hidden;}
.stats-section::before{
  content:'';position:absolute;inset:0;
  background:url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}
.stat-card{
  padding:44px 20px;text-align:center;position:relative;
  border-right:1px solid rgba(255,255,255,0.07);
  transition:background 0.3s;
}
.stat-card:last-child{border-right:none;}
.stat-card:hover{background:rgba(255,255,255,0.04);}
.stat-card .s-icon{
  width:56px;height:56px;border-radius:16px;margin:0 auto 16px;
  display:flex;align-items:center;justify-content:center;font-size:1.4rem;
}
.stat-card .s-num{
  font-size:2.8rem;font-weight:800;line-height:1;
  background:linear-gradient(135deg,var(--teal-light),var(--accent));
  -webkit-background-clip:text;background-clip:text;color:transparent;
  display:block;margin-bottom:8px;
}
.stat-card .s-label{color:rgba(255,255,255,0.6);font-size:0.85rem;font-weight:400;letter-spacing:0.5px;}
.stat-divider{display:none;}
@media(max-width:767px){
  .stat-card{border-right:none;border-bottom:1px solid rgba(255,255,255,0.07);padding:30px 20px;}
  .stat-card:last-child{border-bottom:none;}
  .stat-card .s-num{font-size:2.2rem;}
  .stat-card .s-icon{width:48px;height:48px;font-size:1.2rem;}
}
@media(max-width:480px){
  .stat-card{padding:24px 16px;}
  .stat-card .s-num{font-size:1.8rem;}
  .stat-card .s-label{font-size:0.78rem;}
}
</style>

<section class="stats-section">
  <div class="container-fluid px-0">
    <div class="row no-gutters">
      <div class="col-6 col-md-3">
        <div class="stat-card">
          <div class="s-icon" style="background:rgba(10,147,150,0.2);color:var(--teal-light)"><i class="fas fa-user-md"></i></div>
          <span class="s-num" data-target="120">0</span>
          <span class="s-label">Expert Doctors</span>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="stat-card">
          <div class="s-icon" style="background:rgba(238,155,0,0.2);color:#ffd166"><i class="fas fa-procedures"></i></div>
          <span class="s-num" data-target="50000">0</span>
          <span class="s-label">Patients Served</span>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="stat-card">
          <div class="s-icon" style="background:rgba(0,119,182,0.2);color:#90e0ef"><i class="fas fa-hospital"></i></div>
          <span class="s-num" data-target="20">0</span>
          <span class="s-label">Departments</span>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="stat-card">
          <div class="s-icon" style="background:rgba(45,106,79,0.3);color:#95d5b2"><i class="fas fa-award"></i></div>
          <span class="s-num">15+</span>
          <span class="s-label">Years of Excellence</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ╔══════════════════════════════════════════════╗
     ║           SECTION 4 · SERVICES              ║
     ╚══════════════════════════════════════════════╝ -->
<style>
.services-section{padding:100px 0;background:#fff;position:relative;overflow:hidden;}
.services-section::before{
  content:'';position:absolute;top:0;right:0;width:350px;height:350px;
  background:radial-gradient(circle,rgba(10,147,150,0.06) 0%,transparent 70%);pointer-events:none;
}
.services-section::after{
  content:'';position:absolute;bottom:0;left:0;width:300px;height:300px;
  background:radial-gradient(circle,rgba(238,155,0,0.05) 0%,transparent 70%);pointer-events:none;
}
/* Section label */
.sec-label{display:inline-flex;align-items:center;gap:8px;background:var(--teal-xlight);color:var(--teal);font-size:0.78rem;font-weight:600;letter-spacing:2px;text-transform:uppercase;padding:7px 18px;border-radius:30px;margin-bottom:14px;}
.sec-label i{font-size:0.7rem;}
.sec-title{font-size:2.4rem;font-weight:800;color:var(--dark);margin-bottom:14px;line-height:1.2;}
.sec-title span{color:var(--teal);}
.sec-sub{color:var(--muted);max-width:560px;margin:0 auto;line-height:1.8;font-size:0.95rem;}
.sec-divider{width:50px;height:4px;background:linear-gradient(90deg,var(--teal),var(--teal-light));border-radius:4px;margin:18px auto 0;}
/* Service cards */
.svc-card{
  background:#fff;border-radius:20px;padding:38px 28px;
  border:1.5px solid #e8f4f4;
  box-shadow:0 4px 20px rgba(0,95,115,0.06);
  transition:all 0.4s cubic-bezier(0.175,0.885,0.32,1.275);
  height:100%;position:relative;overflow:hidden;margin-bottom:28px;
  cursor:default;
}
.svc-card::before{
  content:'';position:absolute;top:0;left:0;width:100%;height:4px;
  background:linear-gradient(90deg,var(--teal),var(--teal-light));
  transform:scaleX(0);transform-origin:left;transition:transform 0.4s;
}
.svc-card:hover{transform:translateY(-10px);box-shadow:0 24px 60px rgba(0,95,115,0.18);border-color:var(--teal-light);}
.svc-card:hover::before{transform:scaleX(1);}
.svc-num{position:absolute;top:20px;right:24px;font-size:3.5rem;font-weight:800;color:rgba(10,147,150,0.06);line-height:1;pointer-events:none;}
.svc-icon-wrap{
  width:70px;height:70px;border-radius:18px;margin-bottom:22px;
  display:flex;align-items:center;justify-content:center;font-size:1.8rem;
  transition:all 0.4s;
}
.svc-card:hover .svc-icon-wrap{transform:scale(1.1) rotate(-5deg);}
.svc-card h5{font-size:1.05rem;font-weight:700;color:var(--dark);margin-bottom:10px;}
.svc-card p{font-size:0.86rem;color:var(--muted);line-height:1.75;margin-bottom:18px;}
.svc-link{font-size:0.82rem;font-weight:600;color:var(--teal);display:inline-flex;align-items:center;gap:6px;transition:gap 0.2s;}
.svc-card:hover .svc-link{gap:10px;}
</style>

<section class="services-section" id="services">
  <div class="container">
    <div class="text-center mb-5">
      <div class="sec-label"><i class="fas fa-circle"></i> What We Offer</div>
      <h2 class="sec-title">Our <span>Medical</span> Departments</h2>
      <p class="sec-sub">Comprehensive care delivered by world-class specialists across every major medical discipline.</p>
      <div class="sec-divider"></div>
    </div>
    <div class="row">
      <?php
      $services=[
        ['fa-heartbeat','Cardiology','Advanced cardiac diagnostics, interventional procedures, and long-term heart disease management.','rgba(230,57,70,0.12)','#e63946'],
        ['fa-bone','Orthopaedics','Expert surgical and non-surgical treatments for bones, joints, and musculoskeletal conditions.','rgba(0,119,182,0.12)','#0077b6'],
        ['fa-brain','Neurology','Specialized diagnosis and treatment for brain, spine, and nervous system disorders.','rgba(123,44,191,0.12)','#7b2cbf'],
        ['fa-capsules','Pharmacy','Full in-house pharmacy with a wide formulary and expert pharmaceutical counseling.','rgba(45,106,79,0.12)','#2d6a4f'],
        ['fa-microscope','Laboratory','State-of-the-art diagnostics delivering accurate results quickly for faster treatment.','rgba(238,155,0,0.12)','#ee9b00'],
        ['fa-ambulance','Emergency','24/7 rapid response emergency care with life-saving interventions at every hour.','rgba(10,147,150,0.12)','#0a9396'],
      ];
      foreach($services as $i=>$s): ?>
      <div class="col-lg-4 col-md-6">
        <div class="svc-card">
          <div class="svc-num"><?php echo str_pad($i+1,2,'0',STR_PAD_LEFT);?></div>
          <div class="svc-icon-wrap" style="background:<?php echo $s[3];?>;color:<?php echo $s[4];?>">
            <i class="fas <?php echo $s[0];?>"></i>
          </div>
          <h5><?php echo $s[1];?></h5>
          <p><?php echo $s[2];?></p>
          <span class="svc-link">Learn more <i class="fas fa-arrow-right"></i></span>
        </div>
      </div>
      <?php endforeach;?>
    </div>
  </div>
</section>

<!-- ╔══════════════════════════════════════════════╗
     ║           SECTION 5 · ABOUT US              ║
     ╚══════════════════════════════════════════════╝ -->
<style>
.about-section{padding:60px 0;background:linear-gradient(160deg,#f0fafa 0%,#ffffff 60%,#f4fafa 100%);position:relative;overflow:hidden;}
.about-section::before{content:'';position:absolute;top:-80px;left:-80px;width:300px;height:300px;background:radial-gradient(circle,rgba(10,147,150,0.08),transparent 70%);pointer-events:none;}
/* Image column */
.about-img-col{position:relative;padding-right:40px;}
.about-img-main{border-radius:24px;width:100%;height:360px;object-fit:cover;box-shadow:0 30px 70px rgba(0,95,115,0.2);}
.about-img-small{
  position:absolute;bottom:-24px;right:10px;
  width:120px;height:120px;object-fit:cover;
  border-radius:18px;border:4px solid #fff;
  box-shadow:0 14px 40px rgba(0,0,0,0.2);
}
.about-exp-badge{
  position:absolute;top:30px;left:-20px;
  background:linear-gradient(135deg,var(--teal),var(--teal-dark));
  color:#fff;border-radius:16px;padding:20px 22px;text-align:center;
  box-shadow:0 12px 35px rgba(0,95,115,0.4);
}
.about-exp-badge .exp-num{font-size:2.2rem;font-weight:800;display:block;line-height:1;}
.about-exp-badge .exp-lbl{font-size:0.72rem;opacity:0.88;margin-top:4px;display:block;}
/* Deco dots */
.about-dots{position:absolute;bottom:-10px;left:-30px;opacity:0.35;}
.about-dots svg circle{fill:var(--teal);}
/* Content column */
.about-content{padding-left:24px;}
.about-content .sec-label{margin-bottom:10px;}
.about-content .sec-title{text-align:left;font-size:1.7rem;}
.about-content .sec-divider{margin:10px 0 16px;}
.about-lead{font-size:0.9rem;color:#444;line-height:1.75;margin-bottom:18px;}
/* Feature rows */
.about-feat{display:flex;gap:12px;align-items:flex-start;margin-bottom:12px;padding:12px;border-radius:14px;transition:background 0.3s;}
.about-feat:hover{background:var(--teal-xlight);}
.about-feat .af-ic{width:38px;height:38px;min-width:38px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1rem;}
.about-feat h6{font-weight:700;font-size:0.88rem;margin-bottom:2px;color:var(--dark);}
.about-feat p{font-size:0.8rem;color:var(--muted);line-height:1.5;margin:0;}
/* CTA row */
.about-cta{display:flex;align-items:center;gap:20px;margin-top:34px;flex-wrap:wrap;}
.btn-about-primary{background:linear-gradient(135deg,var(--teal),var(--teal-dark));color:#fff;padding:14px 30px;border-radius:50px;font-weight:600;font-size:0.9rem;transition:all 0.3s;display:inline-flex;align-items:center;gap:8px;box-shadow:0 8px 25px rgba(0,95,115,0.3);}
.btn-about-primary:hover{transform:translateY(-2px);box-shadow:0 14px 35px rgba(0,95,115,0.45);color:#fff;}
.about-cta-mini{display:flex;align-items:center;gap:12px;}
.about-cta-mini img,.about-cta-mini .doc-avatar{width:44px;height:44px;border-radius:50%;border:2px solid #fff;object-fit:cover;}
.about-cta-mini .doc-avatar{background:var(--teal);display:flex;align-items:center;justify-content:center;color:#fff;font-size:1rem;}
.about-cta-mini .doc-overlap{display:flex;margin-left:-10px;}
.about-cta-mini .doc-overlap .doc-avatar:not(:first-child){margin-left:-12px;}
.about-cta-mini small{color:var(--muted);font-size:0.8rem;display:block;}
.about-cta-mini strong{font-size:0.9rem;color:var(--dark);}
@media(max-width:991px){.about-img-col{padding-right:15px;margin-bottom:60px;}.about-content{padding-left:0;}}
@media(max-width:767px){
  .services-section,.gallery-section,.contact-section,.about-section{padding:60px 0;}
  .sec-title{font-size:1.8rem;}
  .sec-sub{font-size:0.88rem;}
  .svc-card{padding:28px 20px;}
  .svc-num{font-size:2.5rem;}
  .about-img-main{height:280px;}
  .about-img-small{width:100px;height:100px;}
  .about-exp-badge{padding:16px 18px;left:-10px;}
  .about-exp-badge .exp-num{font-size:1.8rem;}
  .about-cta{flex-direction:column;align-items:flex-start;gap:14px;}
  .btn-about-primary{width:100%;justify-content:center;}
  /* Navbar improvements */
  .navbar-hms .container{height:64px;}
  /* Stats section */
  .stats-section{padding:0;}
  /* Hero adjustments */
  .hero-section{padding-top:64px;}
}
@media(max-width:576px){
  .services-section,.gallery-section,.contact-section,.about-section{padding:50px 0;}
  .sec-title{font-size:1.6rem;}
  .sec-sub{font-size:0.85rem;}
  .sec-label{font-size:0.75rem;padding:6px 14px;}
  .sec-divider{width:40px;height:3px;margin:14px auto 0;}
  .svc-card{padding:24px 18px;margin-bottom:20px;}
  .svc-num{font-size:2.2rem;}
  .svc-icon-wrap{width:60px;height:60px;font-size:1.6rem;margin-bottom:18px;}
  .svc-card h5{font-size:1rem;}
  .svc-card p{font-size:0.84rem;}
  .about-img-col{margin-bottom:50px;}
  .about-img-main{height:240px;}
  .about-img-small{width:90px;height:90px;bottom:-18px;right:5px;}
  .about-exp-badge{padding:14px 16px;left:-8px;top:20px;}
  .about-exp-badge .exp-num{font-size:1.6rem;}
  .about-exp-badge .exp-lbl{font-size:0.7rem;}
  .about-feat{padding:10px;margin-bottom:10px;}
  .about-feat .af-ic{width:34px;height:34px;min-width:34px;font-size:0.9rem;}
  .about-feat h6{font-size:0.85rem;}
  .about-feat p{font-size:0.78rem;}
  .about-dots{display:none;}
}
@media(max-width:480px){
  .services-section,.gallery-section,.contact-section,.about-section{padding:40px 0;}
  .sec-title{font-size:1.4rem;}
  .sec-sub{font-size:0.82rem;}
  .svc-card{padding:20px 16px;margin-bottom:18px;}
  .svc-icon-wrap{width:56px;height:56px;font-size:1.4rem;margin-bottom:14px;}
  .svc-card h5{font-size:0.95rem;}
  .svc-card p{font-size:0.82rem;margin-bottom:14px;}
  .svc-link{font-size:0.8rem;}
  .contact-info-box,.contact-form-box{padding:32px 24px;}
  .cf-input{padding:11px 14px;font-size:0.88rem;}
  .about-content .sec-title{font-size:1.4rem;}
  .about-lead{font-size:0.84rem;line-height:1.65;}
  .btn-about-primary{padding:12px 24px;font-size:0.85rem;}
  .about-img-main{height:220px;}
  .about-img-small{width:80px;height:80px;border:3px solid #fff;}
  .about-exp-badge{padding:12px 14px;}
  .about-exp-badge .exp-num{font-size:1.4rem;}
}
</style>

<section class="about-section" id="about_us">
  <div class="container">
    <div class="row align-items-center">

      <div class="col-lg-5 about-img-col mb-5 mb-lg-0">
        <!-- Dot grid deco -->
        <div class="about-dots">
          <svg width="120" height="120" viewBox="0 0 120 120"><defs><pattern id="dots" x="0" y="0" width="15" height="15" patternUnits="userSpaceOnUse"><circle cx="3" cy="3" r="2"/></pattern></defs><rect width="120" height="120" fill="url(#dots)"/></svg>
        </div>
        <img src="assets/images/gallery/gallery_12.jpg" alt="About" class="about-img-main">
        <img src="assets/images/why.jpg" alt="Hospital" class="about-img-small">
        <div class="about-exp-badge">
          <span class="exp-num">15+</span>
          <span class="exp-lbl">Years of<br>Excellence</span>
        </div>
      </div>

      <div class="col-lg-7 about-content">
        <div class="sec-label"><i class="fas fa-circle"></i> Who We Are</div>
        <h2 class="sec-title">Dedicated to <span>Healing</span><br>& Your Well-being</h2>
        <div class="sec-divider" style="margin:14px 0 24px;"></div>

        <?php
        $ret=mysqli_query($con,"SELECT * FROM tblpage WHERE PageType='aboutus'");
        $aboutText='We are committed to providing the highest quality healthcare services with compassion and innovation.';
        while($row=mysqli_fetch_array($ret)){
            $clean = html_entity_decode($row['PageDescription'], ENT_QUOTES|ENT_HTML5, 'UTF-8');
            $clean = strip_tags($clean);
            $clean = preg_replace('/\s+/', ' ', trim($clean));
            // Trim to first 2 sentences only
            $sentences = preg_split('/(?<=[.!?])\s+/', $clean);
            $aboutText = implode(' ', array_slice($sentences, 0, 2));
        }
        ?>
        <p class="about-lead"><?php echo htmlspecialchars($aboutText);?></p>

        <div class="about-feat">
          <div class="af-ic" style="background:rgba(230,57,70,0.1);color:#e63946"><i class="fas fa-award"></i></div>
          <div><h6>Award-Winning Healthcare</h6><p>Nationally recognised for clinical excellence, patient satisfaction, and medical innovation.</p></div>
        </div>
        <div class="about-feat">
          <div class="af-ic" style="background:rgba(0,119,182,0.1);color:#0077b6"><i class="fas fa-user-shield"></i></div>
          <div><h6>Patient Safety First</h6><p>Every procedure and protocol is designed around your safety, comfort, and recovery.</p></div>
        </div>
        <div class="about-feat">
          <div class="af-ic" style="background:rgba(45,106,79,0.1);color:#2d6a4f"><i class="fas fa-clock"></i></div>
          <div><h6>24 / 7 Availability</h6><p>Round-the-clock emergency care, consultations, and support — 365 days a year.</p></div>
        </div>

        <div class="about-cta">
          <a href="hms/user-login.php" class="btn-about-primary"><i class="fas fa-calendar-check"></i> Get an Appointment</a>
          <div class="about-cta-mini">
            <div class="doc-overlap">
              <div class="doc-avatar"><i class="fas fa-user-md"></i></div>
              <div class="doc-avatar" style="background:#0077b6"><i class="fas fa-user-nurse"></i></div>
              <div class="doc-avatar" style="background:#2d6a4f"><i class="fas fa-stethoscope"></i></div>
            </div>
            <div><strong>120+ Specialists</strong><small>ready to help you</small></div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ╔══════════════════════════════════════════════╗
     ║           SECTION 6 · GALLERY               ║
     ╚══════════════════════════════════════════════╝ -->
<style>
.gallery-section{padding:100px 0;background:linear-gradient(160deg,#f0fafa,#f8fdfd);}
/* Filter pills */
.gallery-pills{display:flex;flex-wrap:wrap;gap:10px;justify-content:center;margin-bottom:44px;}
.gpill{
  background:#fff;border:1.5px solid rgba(10,147,150,0.2);color:var(--muted);
  border-radius:30px;padding:9px 22px;font-size:0.84rem;font-weight:500;
  cursor:pointer;transition:all 0.3s;display:flex;align-items:center;gap:7px;
  box-shadow:0 2px 10px rgba(0,0,0,0.04);
}
.gpill i{font-size:0.75rem;}
.gpill:hover{border-color:var(--teal);color:var(--teal);}
.gpill.active{background:linear-gradient(135deg,var(--teal),var(--teal-dark));color:#fff;border-color:transparent;box-shadow:0 6px 20px rgba(0,95,115,0.3);}
/* Masonry-style grid */
.gallery-grid{column-count:3;column-gap:20px;}
.gal-item{
  break-inside:avoid;margin-bottom:20px;border-radius:18px;
  overflow:hidden;position:relative;cursor:pointer;
  box-shadow:0 4px 20px rgba(0,95,115,0.1);
  transition:transform 0.35s,box-shadow 0.35s;display:block;
}
.gal-item:hover{transform:scale(1.02);box-shadow:0 16px 45px rgba(0,95,115,0.2);}
.gal-item img{width:100%;display:block;transition:transform 0.5s;}
.gal-item:hover img{transform:scale(1.06);}
/* Overlay */
.gal-overlay{
  position:absolute;inset:0;
  background:linear-gradient(to bottom,transparent 30%,rgba(0,95,115,0.85));
  opacity:0;transition:opacity 0.35s;
  display:flex;flex-direction:column;align-items:center;justify-content:flex-end;
  padding:20px;color:#fff;
}
.gal-item:hover .gal-overlay{opacity:1;}
.gal-overlay .gal-zoom{
  width:44px;height:44px;border-radius:50%;background:rgba(255,255,255,0.2);
  backdrop-filter:blur(6px);display:flex;align-items:center;justify-content:center;
  font-size:1.1rem;margin-bottom:10px;border:1px solid rgba(255,255,255,0.4);
  transition:transform 0.3s;
}
.gal-item:hover .gal-zoom{transform:scale(1.1);}
.gal-overlay .gal-cat{font-size:0.78rem;opacity:0.8;letter-spacing:1px;text-transform:uppercase;}
/* Category colour dots */
.gal-item[data-cat="hdpe"] .gal-cat-dot{background:#0077b6;}
.gal-item[data-cat="sprinkle"] .gal-cat-dot{background:#e63946;}
.gal-item[data-cat="spray"] .gal-cat-dot{background:#7b2cbf;}
.gal-item[data-cat="irrigation"] .gal-cat-dot{background:#2d6a4f;}
/* Lightbox */
.lightbox-backdrop{position:fixed;inset:0;background:rgba(0,0,0,0.92);z-index:9999;display:none;align-items:center;justify-content:center;padding:20px;}
.lightbox-backdrop.open{display:flex;}
.lightbox-img{max-width:90vw;max-height:90vh;border-radius:12px;box-shadow:0 30px 80px rgba(0,0,0,0.6);}
.lightbox-close{position:fixed;top:20px;right:28px;color:#fff;font-size:2rem;cursor:pointer;z-index:10000;opacity:0.8;transition:opacity 0.2s;}
.lightbox-close:hover{opacity:1;}
/* Gallery responsive */
@media(max-width:991px){
  .gallery-grid{column-count:2;column-gap:16px;}
  .gal-item{margin-bottom:16px;border-radius:14px;}
}
@media(max-width:767px){
  .gallery-pills{gap:8px;margin-bottom:32px;}
  .gpill{padding:8px 18px;font-size:0.82rem;}
  .gpill i{font-size:0.7rem;}
  .gallery-grid{column-count:2;column-gap:14px;}
  .gal-item{margin-bottom:14px;}
  .gal-overlay{padding:16px;}
  .gal-overlay .gal-zoom{width:38px;height:38px;font-size:1rem;}
  .gal-overlay .gal-cat{font-size:0.72rem;}
}
@media(max-width:576px){
  .gallery-pills{gap:6px;}
  .gpill{padding:7px 14px;font-size:0.78rem;}
  .gallery-grid{column-count:1;column-gap:0;}
  .gal-item{border-radius:12px;}
}
@media(max-width:480px){
  .gpill{padding:6px 12px;font-size:0.76rem;}
  .gpill i{display:none;}
  .gal-item{margin-bottom:12px;}
}
</style>

<section class="gallery-section" id="gallery">
  <div class="container">
    <div class="text-center mb-5">
      <div class="sec-label"><i class="fas fa-circle"></i> Our Facility</div>
      <h2 class="sec-title">Hospital <span>Gallery</span></h2>
      <p class="sec-sub">A glimpse inside our world-class wards, theatres, and specialist departments.</p>
      <div class="sec-divider"></div>
    </div>

    <div class="gallery-pills">
      <button class="gpill active" data-filter="all"><i class="fas fa-th"></i> All</button>
      <button class="gpill" data-filter="hdpe"><i class="fas fa-tooth"></i> Dental</button>
      <button class="gpill" data-filter="sprinkle"><i class="fas fa-heartbeat"></i> Cardiology</button>
      <button class="gpill" data-filter="spray"><i class="fas fa-brain"></i> Neurology</button>
      <button class="gpill" data-filter="irrigation"><i class="fas fa-microscope"></i> Laboratory</button>
    </div>

    <div class="gallery-grid" id="galleryGrid">
      <div class="gal-item" data-cat="hdpe">
        <img src="assets/images/gallery/gallery_01.jpg" alt="Dental">
        <div class="gal-overlay"><div class="gal-zoom"><i class="fas fa-search-plus"></i></div><div class="gal-cat">Dental</div></div>
      </div>
      <div class="gal-item" data-cat="sprinkle">
        <img src="assets/images/gallery/gallery_02.jpg" alt="Cardiology">
        <div class="gal-overlay"><div class="gal-zoom"><i class="fas fa-search-plus"></i></div><div class="gal-cat">Cardiology</div></div>
      </div>
      <div class="gal-item" data-cat="hdpe">
        <img src="assets/images/gallery/gallery_03.jpg" alt="Dental">
        <div class="gal-overlay"><div class="gal-zoom"><i class="fas fa-search-plus"></i></div><div class="gal-cat">Dental</div></div>
      </div>
      <div class="gal-item" data-cat="irrigation">
        <img src="assets/images/gallery/gallery_04.jpg" alt="Laboratory">
        <div class="gal-overlay"><div class="gal-zoom"><i class="fas fa-search-plus"></i></div><div class="gal-cat">Laboratory</div></div>
      </div>
      <div class="gal-item" data-cat="spray">
        <img src="assets/images/gallery/gallery_05.jpg" alt="Neurology">
        <div class="gal-overlay"><div class="gal-zoom"><i class="fas fa-search-plus"></i></div><div class="gal-cat">Neurology</div></div>
      </div>
      <div class="gal-item" data-cat="spray">
        <img src="assets/images/gallery/gallery_06.jpg" alt="Neurology">
        <div class="gal-overlay"><div class="gal-zoom"><i class="fas fa-search-plus"></i></div><div class="gal-cat">Neurology</div></div>
      </div>
      <div class="gal-item" data-cat="sprinkle">
        <img src="assets/images/gallery/gallery_08.jpg" alt="Cardiology">
        <div class="gal-overlay"><div class="gal-zoom"><i class="fas fa-search-plus"></i></div><div class="gal-cat">Cardiology</div></div>
      </div>
      <div class="gal-item" data-cat="irrigation">
        <img src="assets/images/gallery/gallery_09.jpg" alt="Laboratory">
        <div class="gal-overlay"><div class="gal-zoom"><i class="fas fa-search-plus"></i></div><div class="gal-cat">Laboratory</div></div>
      </div>
      <div class="gal-item" data-cat="hdpe">
        <img src="assets/images/gallery/gallery_10.jpg" alt="Dental">
        <div class="gal-overlay"><div class="gal-zoom"><i class="fas fa-search-plus"></i></div><div class="gal-cat">Dental</div></div>
      </div>
    </div>
  </div>
</section>

<!-- Lightbox -->
<div class="lightbox-backdrop" id="lightbox">
  <span class="lightbox-close" id="lightboxClose">&times;</span>
  <img src="" alt="" class="lightbox-img" id="lightboxImg">
</div>

<!-- ╔══════════════════════════════════════════════╗
     ║           SECTION 7 · CONTACT               ║
     ╚══════════════════════════════════════════════╝ -->
<style>
.contact-section{padding:100px 0;background:#fff;position:relative;overflow:hidden;}
.contact-section::before{content:'';position:absolute;bottom:0;right:0;width:400px;height:400px;background:radial-gradient(circle,rgba(10,147,150,0.05),transparent 70%);pointer-events:none;}
.contact-info-box{
  background:linear-gradient(145deg,var(--teal-dark) 0%,var(--teal) 100%);
  border-radius:24px;padding:48px 40px;color:#fff;height:100%;position:relative;overflow:hidden;
}
.contact-info-box::before{content:'';position:absolute;top:-60px;right:-60px;width:200px;height:200px;background:rgba(255,255,255,0.07);border-radius:50%;}
.contact-info-box::after{content:'';position:absolute;bottom:-40px;left:-40px;width:150px;height:150px;background:rgba(255,255,255,0.05);border-radius:50%;}
.contact-info-box h3{font-size:1.7rem;font-weight:800;margin-bottom:10px;position:relative;z-index:1;}
.contact-info-box .ci-lead{opacity:0.85;line-height:1.8;font-size:0.9rem;margin-bottom:36px;position:relative;z-index:1;}
.ci-row{display:flex;align-items:flex-start;gap:16px;margin-bottom:26px;position:relative;z-index:1;}
.ci-icon-box{width:48px;height:48px;min-width:48px;border-radius:14px;background:rgba(255,255,255,0.18);display:flex;align-items:center;justify-content:center;font-size:1.1rem;backdrop-filter:blur(4px);}
.ci-row .ci-label{font-size:0.75rem;text-transform:uppercase;letter-spacing:1px;opacity:0.7;display:block;margin-bottom:3px;}
.ci-row .ci-value{font-size:0.95rem;font-weight:500;}
/* Social row */
.ci-social{display:flex;gap:10px;margin-top:36px;position:relative;z-index:1;}
.ci-social a{width:42px;height:42px;border-radius:12px;background:rgba(255,255,255,0.15);color:#fff;display:flex;align-items:center;justify-content:center;font-size:1rem;transition:all 0.3s;border:1px solid rgba(255,255,255,0.2);}
.ci-social a:hover{background:#fff;color:var(--teal-dark);transform:translateY(-3px);}
/* Form box */
.contact-form-box{
  background:#fff;border-radius:24px;padding:48px 40px;
  box-shadow:0 10px 60px rgba(0,95,115,0.1);
  border:1.5px solid rgba(10,147,150,0.1);height:100%;
}
.contact-form-box h3{font-size:1.6rem;font-weight:800;color:var(--dark);margin-bottom:6px;}
.contact-form-box .cf-sub{color:var(--muted);font-size:0.88rem;margin-bottom:32px;}
.cf-group{position:relative;margin-bottom:20px;}
.cf-group label{font-size:0.8rem;font-weight:600;color:var(--dark);display:block;margin-bottom:6px;letter-spacing:0.3px;}
.cf-input{
  width:100%;border:1.5px solid #dde8e8;border-radius:12px;
  padding:13px 16px;font-size:0.9rem;font-family:'Poppins',sans-serif;
  background:#f8fdfd;color:var(--dark);transition:all 0.3s;
}
.cf-input:focus{outline:none;border-color:var(--teal);background:#fff;box-shadow:0 0 0 4px rgba(10,147,150,0.08);}
.cf-input::placeholder{color:#b0bec5;font-size:0.88rem;}
.cf-input.cf-textarea{resize:vertical;min-height:120px;}
.btn-cf-send{
  width:100%;background:linear-gradient(135deg,var(--teal),var(--teal-dark));
  color:#fff;border:none;border-radius:14px;padding:15px;
  font-size:0.95rem;font-weight:700;font-family:'Poppins',sans-serif;
  cursor:pointer;transition:all 0.3s;display:flex;align-items:center;justify-content:center;gap:10px;
  box-shadow:0 6px 25px rgba(0,95,115,0.3);
}
.btn-cf-send:hover{transform:translateY(-2px);box-shadow:0 12px 35px rgba(0,95,115,0.4);}
/* Contact responsive */
@media(max-width:991px){
  .contact-info-box,.contact-form-box{padding:40px 36px;margin-bottom:30px;}
  .contact-info-box h3{font-size:1.5rem;}
  .contact-form-box h3{font-size:1.4rem;}
}
@media(max-width:767px){
  .contact-info-box,.contact-form-box{padding:36px 30px;margin-bottom:24px;}
  .contact-info-box h3{font-size:1.4rem;}
  .contact-form-box h3{font-size:1.3rem;}
  .ci-lead,.cf-sub{font-size:0.86rem;margin-bottom:28px;}
  .ci-row{margin-bottom:22px;gap:14px;}
  .ci-icon-box{width:44px;height:44px;min-width:44px;font-size:1rem;}
  .ci-row .ci-label{font-size:0.72rem;}
  .ci-row .ci-value{font-size:0.9rem;}
  .ci-social{margin-top:28px;gap:8px;}
  .ci-social a{width:38px;height:38px;font-size:0.95rem;}
  .cf-input{padding:12px 14px;font-size:0.88rem;}
  .btn-cf-send{padding:14px;font-size:0.9rem;}
}
@media(max-width:576px){
  .contact-info-box,.contact-form-box{padding:32px 24px;}
  .contact-info-box h3,.contact-form-box h3{font-size:1.3rem;}
  .ci-lead,.cf-sub{font-size:0.84rem;}
  .cf-group label{font-size:0.78rem;}
}
@media(max-width:480px){
  .contact-info-box,.contact-form-box{padding:28px 20px;border-radius:18px;}
  .contact-info-box h3{font-size:1.2rem;}
  .contact-form-box h3{font-size:1.2rem;}
  .ci-lead{font-size:0.82rem;margin-bottom:24px;}
  .cf-sub{font-size:0.82rem;margin-bottom:24px;}
  .ci-row{margin-bottom:18px;gap:12px;}
  .ci-icon-box{width:40px;height:40px;min-width:40px;font-size:0.95rem;}
  .ci-row .ci-value{font-size:0.86rem;}
  .ci-social{margin-top:24px;}
  .cf-input{padding:11px 13px;font-size:0.86rem;}
  .cf-input::placeholder{font-size:0.84rem;}
  .cf-input.cf-textarea{min-height:100px;}
  .btn-cf-send{padding:13px;font-size:0.88rem;gap:8px;}
}
</style>

<section class="contact-section" id="contact_us">
  <div class="container">
    <div class="text-center mb-5">
      <div class="sec-label"><i class="fas fa-circle"></i> Get In Touch</div>
      <h2 class="sec-title">Contact <span>Us</span></h2>
      <p class="sec-sub">Have a question or want to schedule a visit? We're here to help you anytime.</p>
      <div class="sec-divider"></div>
    </div>
    <div class="row align-items-stretch">
      <?php
      $ret2=mysqli_query($con,"SELECT * FROM tblpage WHERE PageType='contactus'");
      $cRow=mysqli_fetch_array($ret2);
      ?>
      <div class="col-lg-5 mb-4 mb-lg-0">
        <div class="contact-info-box">
          <h3>We're Here For You</h3>
          <p class="ci-lead">Our friendly team is available to answer your questions and help you book appointments at any time.</p>
          <div class="ci-row">
            <div class="ci-icon-box"><i class="fas fa-map-marker-alt"></i></div>
            <div>
              <span class="ci-label">Address</span>
              <span class="ci-value"><?php echo $cRow ? htmlspecialchars(trim(preg_replace('/\s+/',' ',strip_tags(html_entity_decode($cRow['PageDescription'],ENT_QUOTES|ENT_HTML5,'UTF-8'))))) : '123 Medical Drive, Health City'; ?></span>
            </div>
          </div>
          <div class="ci-row">
            <div class="ci-icon-box"><i class="fas fa-phone-alt"></i></div>
            <div>
              <span class="ci-label">Phone</span>
              <span class="ci-value"><?php echo $cRow ? htmlspecialchars($cRow['MobileNumber']) : '+1 (555) 000-0000'; ?></span>
            </div>
          </div>
          <div class="ci-row">
            <div class="ci-icon-box"><i class="fas fa-envelope"></i></div>
            <div>
              <span class="ci-label">Email</span>
              <span class="ci-value"><?php echo $cRow ? htmlspecialchars($cRow['Email']) : 'info@hospital.com'; ?></span>
            </div>
          </div>
          <div class="ci-row">
            <div class="ci-icon-box"><i class="fas fa-clock"></i></div>
            <div>
              <span class="ci-label">Working Hours</span>
              <span class="ci-value"><?php echo $cRow ? htmlspecialchars($cRow['OpenningTime']) : 'Mon–Sat: 8AM – 8PM'; ?></span>
            </div>
          </div>
          <div class="ci-social">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
          </div>
        </div>
      </div>
      <div class="col-lg-7">
        <div class="contact-form-box">
          <h3>Send Us a Message</h3>
          <p class="cf-sub">Fill in the form below and we'll get back to you within 24 hours.</p>
          <form method="post" onsubmit="return validateContactForm()">
            <div class="row">
              <div class="col-md-6">
                <div class="cf-group">
                  <label>Full Name</label>
                  <input type="text" class="cf-input" id="fullname" name="fullname" placeholder="Enter your full name" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="cf-group">
                  <label>Email Address</label>
                  <input type="email" class="cf-input" id="emailid" name="emailid" placeholder="your@email.com" required>
                </div>
              </div>
            </div>
            <div class="cf-group">
              <label>Mobile Number</label>
              <input type="text" class="cf-input" id="mobileno" name="mobileno" placeholder="10-digit mobile number" required>
            </div>
            <div class="cf-group">
              <label>Your Message</label>
              <textarea class="cf-input cf-textarea" name="description" placeholder="How can we help you?" required></textarea>
            </div>
            <button type="submit" name="submit" class="btn-cf-send">
              <i class="fas fa-paper-plane"></i> Send Message
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ╔══════════════════════════════════════════════╗
     ║           SECTION 8 · FOOTER                ║
     ╚══════════════════════════════════════════════╝ -->
<style>
.footer-main{background:#0d1b2a;padding:80px 0 0;color:rgba(255,255,255,0.75);}
.footer-brand-name{font-size:1.6rem;font-weight:800;color:#fff;margin-bottom:12px;}
.footer-brand-name span{color:var(--teal-light);}
.footer-desc{font-size:0.86rem;line-height:1.85;margin-bottom:24px;max-width:300px;}
.footer-social a{display:inline-flex;align-items:center;justify-content:center;width:40px;height:40px;border-radius:12px;background:rgba(255,255,255,0.08);color:rgba(255,255,255,0.7);margin-right:8px;font-size:0.9rem;transition:all 0.3s;border:1px solid rgba(255,255,255,0.08);}
.footer-social a:hover{background:var(--teal);color:#fff;transform:translateY(-3px);border-color:var(--teal);}
.footer-col h5{color:#fff;font-weight:700;font-size:0.95rem;margin-bottom:22px;letter-spacing:0.3px;position:relative;padding-bottom:10px;}
.footer-col h5::after{content:'';position:absolute;bottom:0;left:0;width:30px;height:2px;background:var(--teal);border-radius:2px;}
.footer-list{list-style:none;padding:0;}
.footer-list li{margin-bottom:10px;}
.footer-list li a{color:rgba(255,255,255,0.65);font-size:0.86rem;transition:all 0.25s;display:flex;align-items:center;gap:8px;}
.footer-list li a i{font-size:0.65rem;color:var(--teal-light);transition:transform 0.2s;}
.footer-list li a:hover{color:#fff;padding-left:4px;}
.footer-list li a:hover i{transform:translateX(3px);}
.footer-contact-row{display:flex;align-items:flex-start;gap:12px;margin-bottom:16px;font-size:0.86rem;}
.footer-contact-row i{color:var(--teal-light);margin-top:3px;width:16px;text-align:center;}
.footer-hr{border-color:rgba(255,255,255,0.08);margin:50px 0 0;}
.footer-bottom-bar{padding:22px 0;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;}
.footer-copy{font-size:0.82rem;color:rgba(255,255,255,0.45);}
.footer-copy a{color:rgba(255,255,255,0.6);transition:color 0.2s;}
.footer-copy a:hover{color:var(--teal-light);}
/* Back to top */
.back-to-top{
  position:fixed;bottom:28px;right:28px;z-index:999;
  width:46px;height:46px;background:var(--teal);color:#fff;
  border-radius:12px;display:flex;align-items:center;justify-content:center;
  font-size:1.1rem;box-shadow:0 6px 20px rgba(0,95,115,0.4);
  transition:all 0.3s;opacity:0;pointer-events:none;
}
.back-to-top.show{opacity:1;pointer-events:all;}
.back-to-top:hover{background:var(--teal-dark);transform:translateY(-3px);color:#fff;}
@media(max-width:767px){
  .footer-main{padding:60px 0 0;}
  .footer-brand-name{font-size:1.4rem;}
  .footer-desc{font-size:0.82rem;}
  .footer-col h5{font-size:0.9rem;}
  .footer-list li a{font-size:0.82rem;}
  .footer-contact-row{font-size:0.82rem;}
  .footer-bottom-bar{padding:18px 0;flex-direction:column;text-align:center;}
  .back-to-top{width:42px;height:42px;bottom:20px;right:20px;}
}
@media(max-width:480px){
  .footer-main{padding:40px 0 0;}
  .footer-col{text-align:center;margin-bottom:30px;}
  .footer-col h5::after{left:50%;transform:translateX(-50%);}
  .footer-list{text-align:center;}
  .footer-list li a{justify-content:center;}
  .footer-contact-row{justify-content:center;}
  .footer-social{justify-content:center;}
  .footer-brand-name{font-size:1.3rem;}
  .footer-desc{font-size:0.8rem;margin:0 auto 20px;text-align:center;}
  .back-to-top{width:40px;height:40px;bottom:16px;right:16px;font-size:1rem;}
}
/* Touch device optimizations */
@media(hover:none)and(pointer:coarse){
  .nav-links li a,
  .btn-hero-solid,
  .btn-hero-ghost,
  .gpill,
  .btn-cf-send,
  .footer-list li a{min-height:44px;display:flex;align-items:center;justify-content:center;}
  *{-webkit-tap-highlight-color:rgba(10,147,150,0.15);}
}
/* Landscape tablets */
@media(min-width:768px)and(max-width:1024px)and(orientation:landscape){
  .hero-section{min-height:auto;padding:120px 0 80px;}
  .section-pad{padding:70px 0;}
}
</style>

<footer class="footer-main">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-6 mb-5">
        <div class="footer-brand-name">HMS<span>+</span></div>
        <p class="footer-desc">Providing world-class healthcare with compassion and innovation. Trusted by thousands of patients and doctors for over 15 years.</p>
        <div class="footer-social">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-linkedin-in"></i></a>
          <a href="#"><i class="fab fa-youtube"></i></a>
        </div>
      </div>
      <div class="col-lg-2 col-md-3 col-6 mb-5">
        <div class="footer-col">
          <h5>Quick Links</h5>
          <ul class="footer-list">
            <li><a href="#hero"><i class="fas fa-angle-right"></i> Home</a></li>
            <li><a href="#services"><i class="fas fa-angle-right"></i> Services</a></li>
            <li><a href="#about_us"><i class="fas fa-angle-right"></i> About Us</a></li>
            <li><a href="#gallery"><i class="fas fa-angle-right"></i> Gallery</a></li>
            <li><a href="#contact_us"><i class="fas fa-angle-right"></i> Contact</a></li>
          </ul>
        </div>
      </div>
      <div class="col-lg-2 col-md-3 col-6 mb-5">
        <div class="footer-col">
          <h5>Portals</h5>
          <ul class="footer-list">
            <li><a href="hms/user-login.php"><i class="fas fa-angle-right"></i> Patient Login</a></li>
            <li><a href="hms/doctor"><i class="fas fa-angle-right"></i> Doctor Login</a></li>
            <li><a href="hms/admin"><i class="fas fa-angle-right"></i> Admin Login</a></li>
            <li><a href="hms/registration.php"><i class="fas fa-angle-right"></i> Register</a></li>
          </ul>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 mb-5">
        <div class="footer-col">
          <h5>Contact Info</h5>
          <?php if($cRow): ?>
          <div class="footer-contact-row"><i class="fas fa-map-marker-alt"></i><span><?php echo htmlspecialchars(trim(preg_replace('/\s+/',' ',strip_tags(html_entity_decode($cRow['PageDescription'],ENT_QUOTES|ENT_HTML5,'UTF-8'))))); ?></span></div>
          <div class="footer-contact-row"><i class="fas fa-phone-alt"></i><span><?php echo htmlspecialchars($cRow['MobileNumber']); ?></span></div>
          <div class="footer-contact-row"><i class="fas fa-envelope"></i><span><?php echo htmlspecialchars($cRow['Email']); ?></span></div>
          <div class="footer-contact-row"><i class="fas fa-clock"></i><span><?php echo htmlspecialchars($cRow['OpenningTime']); ?></span></div>
          <?php else: ?>
          <div class="footer-contact-row"><i class="fas fa-map-marker-alt"></i><span>123 Medical Drive, Health City</span></div>
          <div class="footer-contact-row"><i class="fas fa-phone-alt"></i><span>+1 (555) 000-0000</span></div>
          <div class="footer-contact-row"><i class="fas fa-envelope"></i><span>info@hospital.com</span></div>
          <div class="footer-contact-row"><i class="fas fa-clock"></i><span>Mon–Sat: 8AM – 8PM</span></div>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <hr class="footer-hr">
    <div class="footer-bottom-bar">
      <div class="footer-copy">&copy; <?php echo date('Y'); ?> Hospital Management System. All rights reserved.</div>
      <div class="footer-copy">Built with <i class="fas fa-heart" style="color:#ee9b00;margin:0 3px;"></i> for better healthcare</div>
    </div>
  </div>
</footer>

<a href="#" class="back-to-top" id="backToTop"><i class="fas fa-arrow-up"></i></a>

<!-- ===== SCRIPTS ===== -->
<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/plugins/scroll-nav/js/jquery.easing.min.js"></script>
<script>
$(function(){
  // Navbar scroll
  $(window).on('scroll',function(){
    var s=$(this).scrollTop();
    if(s>60){$('#mainNav').addClass('scrolled');}else{$('#mainNav').removeClass('scrolled');}
    // Back to top
    if(s>300){$('#backToTop').addClass('show');}else{$('#backToTop').removeClass('show');}
    // Active nav link
    var pos=s+80;
    $('[data-section]').each(function(){
      var t=$(this);var sid=t.data('section');
      var sec=$('#'+sid);
      if(sec.length&&sec.offset().top<=pos&&sec.offset().top+sec.outerHeight()>pos){
        $('#navLinks a').removeClass('active');
        $('#navLinks a[href="#'+sid+'"]').addClass('active');
      }
    });
  });
  
  // Hamburger toggle - Enhanced for mobile
  $('#navHamburger').on('click',function(e){
    e.stopPropagation();
    $(this).toggleClass('open');
    $('#navLinks').toggleClass('show');
    $('body').toggleClass('nav-open');
  });
  
  // Close mobile menu when clicking outside
  $(document).on('click',function(e){
    if(!$(e.target).closest('.navbar-hms').length&&$('#navLinks').hasClass('show')){
      $('#navLinks').removeClass('show');
      $('#navHamburger').removeClass('open');
      $('body').removeClass('nav-open');
    }
  });
  
  // Close mobile menu when window resized to desktop
  $(window).on('resize',function(){
    if($(window).width()>768&&$('#navLinks').hasClass('show')){
      $('#navLinks').removeClass('show');
      $('#navHamburger').removeClass('open');
      $('body').removeClass('nav-open');
    }
  });
  
  // Smooth scroll - Enhanced with mobile menu close
  $('a[href^="#"]').on('click',function(e){
    var tgt=$(this.getAttribute('href'));
    if(tgt.length){
      e.preventDefault();
      $('html,body').animate({scrollTop:tgt.offset().top-70},600,'swing');
      // Close mobile menu
      $('#navLinks').removeClass('show');
      $('#navHamburger').removeClass('open');
      $('body').removeClass('nav-open');
    }
  });
  
  // Gallery filter - Enhanced for mobile
  $('.gpill').on('click',function(){
    $('.gpill').removeClass('active');$(this).addClass('active');
    var f=$(this).data('filter');
    if(f==='all'){$('.gal-item').show(300);}
    else{$('.gal-item').hide(200).filter('[data-cat="'+f+'"]').show(400);}
  });
  
  // Lightbox - Enhanced for touch devices
  $('.gal-item').on('click',function(e){
    e.preventDefault();
    var src=$(this).find('img').attr('src');
    $('#lightboxImg').attr('src',src);
    $('#lightbox').addClass('open');
    $('body').css('overflow','hidden'); // Prevent background scroll
  });
  
  $('#lightboxClose,#lightbox').on('click',function(e){
    if($(e.target).is('#lightbox')||$(e.target).is('#lightboxClose')){
      $('#lightbox').removeClass('open');
      $('body').css('overflow',''); // Restore scroll
    }
  });
  
  // Escape key to close lightbox
  $(document).on('keydown',function(e){
    if(e.key==='Escape'&&$('#lightbox').hasClass('open')){
      $('#lightbox').removeClass('open');
      $('body').css('overflow','');
    }
  });
  
  // Counter animation - Only trigger when in viewport
  var counted=false;
  $(window).on('scroll',function(){
    if(!counted&&$('.stats-section').length){
      var statsTop=$('.stats-section').offset().top;
      var statsBottom=statsTop+$('.stats-section').outerHeight();
      var scrollPos=$(window).scrollTop()+$(window).height();
      if(scrollPos>statsTop+100){
        counted=true;
        $('.s-num[data-target]').each(function(){
          var $el=$(this),target=parseInt($el.data('target')),suffix=target>=1000?'K+':'+';
          var display=target>=1000?target/1000:target;
          $({val:0}).animate({val:display},{duration:2000,easing:'swing',step:function(){
            $el.text(Math.floor(this.val)+(suffix));
          },complete:function(){$el.text(display+suffix);}});
        });
      }
    }
  });
  
  // Contact form validation
  window.validateContactForm=function(){
    var n=$('#fullname').val().trim();
    if(!/^[a-zA-Z ]+$/.test(n)){alert('Name should contain only letters.');return false;}
    var e=$('#emailid').val().trim();
    if(!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(e)){alert('Invalid email format.');return false;}
    var p=$('#mobileno').val().trim();
    if(!/^[0-9]{10}$/.test(p)){alert('Phone number must be 10 digits.');return false;}
    return true;
  };
  
  // Prevent body scroll when mobile menu is open
  var style=$('<style>body.nav-open{overflow:hidden;}</style>');
  $('head').append(style);
});
</script>
</body>
</html>