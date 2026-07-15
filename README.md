# 🏥 Hospital Management System (HMS+)

A comprehensive web-based Hospital Management System built with PHP and MySQL that connects patients, doctors, and administrators in a seamless healthcare platform.

<div align="center">

[![Live Demo](https://img.shields.io/badge/Live%20Demo-Visit%20Site-brightgreen?style=for-the-badge&logo=google-chrome)](http://hmsfree.infinityfreeapp.com/)
[![PHP](https://img.shields.io/badge/PHP-7.4+-blue?style=for-the-badge&logo=php)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-5.7+-orange?style=for-the-badge&logo=mysql)](https://www.mysql.com/)
[![License](https://img.shields.io/badge/License-MIT-yellow?style=for-the-badge)](LICENSE)

**[🌐 Live Demo](http://hmsfree.infinityfreeapp.com/)** | **[📖 Documentation](#table-of-contents)** | **[🚀 Quick Start](#installation)**

</div>

![HMS+ Banner](hospital/assets/images/logo.png)

---

## 🌐 Quick Access Links

<div align="center">

| Portal | URL | Description |
|--------|-----|-------------|
| 🏠 **Landing Page** | [Visit](http://hmsfree.infinityfreeapp.com/) | Public homepage with information |
| 👤 **Patient Login** | [Login](http://hmsfree.infinityfreeapp.com/hms/user-login.php) | Patient portal access |
| 👨‍⚕️ **Doctor Login** | [Login](http://hmsfree.infinityfreeapp.com/hms/doctor/) | Doctor portal access |
| 👔 **Admin Login** | [Login](http://hmsfree.infinityfreeapp.com/hms/admin/) | Admin panel access |

</div>

---

## 📋 Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Technology Stack](#technology-stack)
- [System Requirements](#system-requirements)
- [Installation](#installation)
  - [Local Installation (XAMPP)](#local-installation-xampp)
  - [Production Deployment (InfinityFree)](#production-deployment-infinityfree)
- [Project Structure](#project-structure)
- [Database Schema](#database-schema)
- [User Roles & Access](#user-roles--access)
- [Default Login Credentials](#default-login-credentials)
- [Configuration](#configuration)
- [Screenshots](#screenshots)
- [Features by Role](#features-by-role)
- [Troubleshooting](#troubleshooting)
- [Contributing](#contributing)
- [License](#license)
- [Support](#support)

---

## 🎯 Overview

HMS+ is a modern, responsive hospital management system designed to streamline healthcare operations. It provides dedicated portals for patients, doctors, and administrators, enabling efficient appointment scheduling, medical record management, and administrative oversight.

### 🌐 Live Demo
**Live URL**: [http://hmsfree.infinityfreeapp.com/](http://hmsfree.infinityfreeapp.com/)

### Key Highlights

- ✅ **Multi-role System**: Separate interfaces for Patients, Doctors, and Admins
- ✅ **Responsive Design**: Works seamlessly on desktop, tablet, and mobile devices
- ✅ **Real-time Appointments**: Book and manage appointments with instant confirmation
- ✅ **Medical History Tracking**: Comprehensive patient medical record management
- ✅ **Doctor Specialization**: Filter doctors by specialty for targeted care
- ✅ **Secure Authentication**: Password-protected access with session management
- ✅ **Modern UI/UX**: Clean, intuitive interface with smooth animations

---

## ✨ Features

### 🏠 Public Landing Page
- Hero section with call-to-action
- Services showcase with 6+ medical departments
- About Us section with hospital statistics
- Image gallery
- Contact form
- Responsive navigation

### 👤 Patient Portal
- User registration and login
- Book appointments by doctor specialization
- View appointment history
- Manage medical history records
- Update profile information
- Change password
- Secure logout

### 👨‍⚕️ Doctor Portal
- Doctor-specific dashboard
- View assigned appointments
- Manage appointment status
- Update patient medical records
- View patient history
- Profile management
- Search patients

### 👔 Admin Portal
- Comprehensive admin dashboard with statistics
- Manage doctors (add, edit, delete)
- Manage patients
- Manage doctor specializations
- View all appointments
- Manage contact form submissions
- View system logs (user logs, doctor logs)
- Update About Us and Contact pages
- Session management

---

## 🛠️ Technology Stack

### Frontend
- **HTML5**: Semantic markup
- **CSS3**: Modern styling with CSS variables
- **Bootstrap 4.5**: Responsive grid and components
- **JavaScript/jQuery**: Dynamic interactions
- **Font Awesome**: Icon library
- **Google Fonts**: Fraunces & Poppins typography

### Backend
- **PHP 7.4+**: Server-side scripting
- **MySQL 5.7+**: Relational database
- **MySQLi**: Database connectivity

### Additional Libraries
- **Bootstrap Datepicker**: Date selection
- **Bootstrap Timepicker**: Time selection
- **jQuery 3.6**: JavaScript library

---

## 💻 System Requirements

### Minimum Requirements
- **Web Server**: Apache 2.4+ or Nginx
- **PHP**: 7.4 or higher (compatible with PHP 8.x)
- **MySQL**: 5.7 or higher / MariaDB 10.3+
- **Storage**: 100 MB disk space
- **RAM**: 256 MB minimum

### Recommended Setup
- **PHP**: 8.0+
- **MySQL**: 8.0+
- **RAM**: 512 MB or more
- **SSL Certificate**: For HTTPS (Let's Encrypt)

### Browser Compatibility
- Chrome 90+
- Firefox 88+
- Safari 14+
- Edge 90+
- Opera 76+

---

## 📦 Installation

### Local Installation (XAMPP)

#### Step 1: Install XAMPP
1. Download XAMPP from [https://www.apachefriends.org/](https://www.apachefriends.org/)
2. Install XAMPP on your system
3. Start **Apache** and **MySQL** services from XAMPP Control Panel

#### Step 2: Clone/Download Project
```bash
# Clone the repository
git clone https://github.com/yourusername/HMS.git

# Or download ZIP and extract to:
C:\xampp\htdocs\HMS\
```

#### Step 3: Import Database
1. Open **phpMyAdmin**: `http://localhost/phpmyadmin`
2. Create new database: `hms`
3. Click **Import** tab
4. Choose file: `SQL File/hms.sql`
5. Click **Go** to import

#### Step 4: Configure Database Connection
The project auto-detects localhost, but verify settings in:
```
hospital/hms/include/config.php
```

Localhost settings:
```php
DB_SERVER: 'localhost'
DB_USER: 'root'
DB_PASS: ''
DB_NAME: 'hms'
```

#### Step 5: Access Application
Open your browser and navigate to:

- **Landing Page**: `http://localhost/HMS/`
- **Patient Login**: `http://localhost/HMS/hms/user-login.php`
- **Doctor Login**: `http://localhost/HMS/hms/doctor/`
- **Admin Login**: `http://localhost/HMS/hms/admin/`

---

### Production Deployment (InfinityFree)

#### Step 1: Create InfinityFree Account
1. Sign up at [https://www.infinityfree.com/](https://www.infinityfree.com/)
2. Create a new hosting account
3. Note your subdomain (e.g., `yourname.infinityfreeapp.com`)

#### Step 2: Create MySQL Database
1. Go to **Control Panel** → **MySQL Databases**
2. Click **Create Database**
3. Database name will be: `if0_XXXXXXXX_hms`
4. Note the credentials:
   - MySQL Hostname
   - MySQL Username
   - MySQL Password
   - Database Name

#### Step 3: Import Database
1. Click **phpMyAdmin** button
2. Select your database
3. Click **Import** tab
4. Upload `SQL File/hms.sql`
5. Click **Go**

#### Step 4: Update Configuration
Edit `hospital/hms/include/config.php`:

```php
// Production Configuration
define('DB_SERVER','sql206.infinityfree.com'); // Your MySQL hostname
define('DB_USER','if0_XXXXXXXX');              // Your username
define('DB_PASS','YourPassword');              // Your password
define('DB_NAME','if0_XXXXXXXX_hms');         // Your database name
```

#### Step 5: Upload Files via FTP
1. Download **FileZilla** from [https://filezilla-project.org/](https://filezilla-project.org/)
2. Connect using FTP details from Control Panel:
   - Host: `ftpupload.net`
   - Username: `if0_XXXXXXXX`
   - Password: Your FTP password
   - Port: `21`

3. Upload to `/htdocs/`:
   ```
   /htdocs/
   ├── assets/
   ├── hms/
   └── index.php
   ```

#### Step 6: Access Your Site
Visit: `https://yoursubdomain.infinityfreeapp.com/`

**Example (Live)**: [http://hmsfree.infinityfreeapp.com/](http://hmsfree.infinityfreeapp.com/)

**Note**: MySQL activation can take 24-72 hours on free hosting.

---

## 📁 Project Structure

```
HMS/
├── hospital/
│   ├── assets/                    # Landing page assets
│   │   ├── css/
│   │   │   ├── animate.css
│   │   │   ├── bootstrap.min.css
│   │   │   ├── fontawsom-all.min.css
│   │   │   └── style.css
│   │   ├── images/
│   │   │   ├── gallery/          # Gallery images
│   │   │   ├── slider/           # Hero slider images
│   │   │   ├── logo.png
│   │   │   └── medical.png
│   │   ├── js/
│   │   │   ├── bootstrap.min.js
│   │   │   ├── jquery-3.2.1.min.js
│   │   │   └── script.js
│   │   └── plugins/              # Additional plugins
│   │
│   ├── hms/                       # Main application
│   │   ├── admin/                # Admin portal
│   │   │   ├── about-us.php
│   │   │   ├── add-doctor.php
│   │   │   ├── appointment-history.php
│   │   │   ├── contact-us.php
│   │   │   ├── dashboard.php
│   │   │   ├── edit-doctor.php
│   │   │   ├── manage-doctors.php
│   │   │   ├── manage-patients.php
│   │   │   ├── manage-users.php
│   │   │   └── ...
│   │   │
│   │   ├── doctor/               # Doctor portal
│   │   │   ├── appointment-history.php
│   │   │   ├── dashboard.php
│   │   │   ├── edit-profile.php
│   │   │   ├── manage-patient.php
│   │   │   ├── search.php
│   │   │   └── ...
│   │   │
│   │   ├── include/              # Shared includes
│   │   │   ├── config.php       # Database configuration
│   │   │   ├── checklogin.php   # Authentication
│   │   │   ├── header.php       # Header component
│   │   │   ├── sidebar.php      # Sidebar navigation
│   │   │   ├── footer.php       # Footer component
│   │   │   ├── head.php         # HTML head
│   │   │   └── scripts.php      # JavaScript includes
│   │   │
│   │   ├── vendor/               # Third-party libraries
│   │   │   ├── bootstrap/
│   │   │   ├── jquery/
│   │   │   ├── fontawesome/
│   │   │   ├── bootstrap-datepicker/
│   │   │   └── bootstrap-timepicker/
│   │   │
│   │   ├── assets/               # HMS-specific assets
│   │   │   └── css/
│   │   │       └── hms-theme.css
│   │   │
│   │   ├── appointment-history.php
│   │   ├── book-appointment.php
│   │   ├── change-password.php
│   │   ├── dashboard.php
│   │   ├── edit-profile.php
│   │   ├── forgot-password.php
│   │   ├── get_doctor.php       # AJAX endpoint
│   │   ├── index.php            # Redirect to login
│   │   ├── logout.php
│   │   ├── manage-medhistory.php
│   │   ├── registration.php
│   │   ├── reset-password.php
│   │   ├── user-login.php
│   │   └── ...
│   │
│   └── index.php                 # Landing page
│
├── SQL File/
│   └── hms.sql                   # Database dump
│
└── README.md                     # This file
```

---

## 🗄️ Database Schema

### Tables Overview

| Table Name | Description | Key Fields |
|------------|-------------|------------|
| `users` | Patient accounts | id, fullName, email, password, address, city |
| `doctors` | Doctor profiles | id, specilization, doctorName, email, password, contactno |
| `doctorspecilization` | Medical specialties | id, specilization, creationDate |
| `appointment` | Appointment records | id, doctorSpecialization, doctorId, userId, appointmentDate, appointmentTime |
| `tblpatient` | Extended patient info | ID, Docid, PatientName, PatientContno, PatientEmail |
| `tblmedicalhistory` | Medical records | ID, PatientID, BloodPressure, Weight, MedicalPres, CreationDate |
| `admin` | Admin accounts | id, username, password |
| `userlog` | Patient login logs | id, uid, username, userip, loginTime |
| `doctorslog` | Doctor login logs | id, uid, username, userip, loginTime |
| `tblcontactus` | Contact form submissions | id, fullname, email, contactno, message |
| `tblpage` | CMS pages (About/Contact) | ID, PageType, PageTitle, PageDescription |

### Relationships
- `appointment.userId` → `users.id`
- `appointment.doctorId` → `doctors.id`
- `tblmedicalhistory.PatientID` → `tblpatient.ID`
- `tblpatient.Docid` → `doctors.id`

---

## 👥 User Roles & Access

### 1. Patient
**Access Level**: Limited (own data only)

**Capabilities**:
- Register new account
- Login with email/password
- Book appointments
- View appointment history
- Manage medical history
- Update profile
- Change password

**Restrictions**:
- Cannot view other patients' data
- Cannot access doctor/admin panels

### 2. Doctor
**Access Level**: Moderate (assigned patients)

**Capabilities**:
- Login with doctor email/password
- View dashboard with statistics
- View assigned appointments
- Manage appointment status (approved/cancelled)
- Add/view patient medical records
- Search patients
- Update own profile

**Restrictions**:
- Cannot manage other doctors
- Cannot access admin functions
- Cannot delete system data

### 3. Administrator
**Access Level**: Full system access

**Capabilities**:
- Full CRUD operations on doctors
- Manage doctor specializations
- View all patients and appointments
- Manage system pages (About, Contact)
- View system logs
- Dashboard with comprehensive statistics
- No restrictions

---

## 🔑 Default Login Credentials

### Live Demo Access
**Site**: [http://hmsfree.infinityfreeapp.com/](http://hmsfree.infinityfreeapp.com/)

### Admin Login
```
URL: http://hmsfree.infinityfreeapp.com/hms/admin/
Username: admin
Password: Test@12345
```

### Doctor Login (Sample)
```
URL: http://hmsfree.infinityfreeapp.com/hms/doctor/
Email: Check doctors table in database
Password: Check doctors table in database
```

### Patient Login
```
URL: http://hmsfree.infinityfreeapp.com/hms/user-login.php
Register a new account or check users table
```

**⚠️ Security Note**: Change default admin password immediately after installation!

---

## ⚙️ Configuration

### Database Configuration
File: `hospital/hms/include/config.php`

The configuration automatically detects environment:

```php
<?php
// Auto-detect environment
$isLocalhost = (isset($_SERVER['HTTP_HOST']) && 
                ($_SERVER['HTTP_HOST'] == 'localhost' || 
                 strpos($_SERVER['HTTP_HOST'], '127.0.0.1') !== false));

if ($isLocalhost) {
    // Localhost Configuration
    define('DB_SERVER','localhost');
    define('DB_USER','root');
    define('DB_PASS','');
    define('DB_NAME','hms');
} else {
    // Production Configuration
    define('DB_SERVER','your_mysql_host');
    define('DB_USER','your_mysql_user');
    define('DB_PASS','your_mysql_pass');
    define('DB_NAME','your_database_name');
    define('DB_PORT', 3306);
}

// Connection
if (!$isLocalhost && defined('DB_PORT')) {
    $con = @mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME, DB_PORT);
} else {
    $con = @mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
}

// Error handling
if (!$con) {
    if ($isLocalhost) {
        die("Database connection failed: " . mysqli_connect_error());
    } else {
        error_log("Database connection failed: " . mysqli_connect_error());
        die("We're experiencing technical difficulties. Please try again later.");
    }
}
?>
```

### Session Configuration
Sessions are managed in each portal's index.php:
- Session timeout: 30 minutes of inactivity
- Secure session handling with proper logout

### Security Features
- Password hashing with MD5 (consider upgrading to bcrypt)
- SQL injection prevention with `mysqli_real_escape_string()`
- Session-based authentication
- Login attempt logging
- XSS protection with `htmlspecialchars()`

---

## 📸 Screenshots

### Landing Page
![Landing Page](docs/screenshots/landing.png)

### Patient Dashboard
![Patient Dashboard](docs/screenshots/patient-dashboard.png)

### Doctor Dashboard
![Doctor Dashboard](docs/screenshots/doctor-dashboard.png)

### Admin Dashboard
![Admin Dashboard](docs/screenshots/admin-dashboard.png)

### Book Appointment
![Book Appointment](docs/screenshots/book-appointment.png)

---

## 🎯 Features by Role

### Patient Features

#### Registration & Authentication
- ✅ New patient registration form
- ✅ Email/password login
- ✅ Forgot password functionality
- ✅ Password reset via email
- ✅ Secure session management

#### Dashboard
- 📊 Total appointments count
- 📅 Upcoming appointments
- 📋 Recent medical history
- 🔔 Appointment notifications

#### Appointment Management
- 📝 Book new appointment
  - Select doctor specialization
  - Choose available doctor
  - Pick date and time
  - View consultation fees
- 📜 View appointment history
- ✅ Appointment status tracking (Pending/Approved/Cancelled)

#### Medical History
- 🏥 View medical records
- 📄 Download medical reports
- 📊 Track health metrics

#### Profile Management
- ✏️ Update personal information
- 📧 Change email address
- 🔒 Change password
- 📱 Update contact details

---

### Doctor Features

#### Authentication
- 🔐 Secure doctor login
- 🔄 Session management
- 📝 Activity logging

#### Dashboard
- 📊 Today's appointments
- 👥 Total patients
- 📈 Monthly statistics
- 🔔 New appointment notifications

#### Appointment Management
- 📅 View all appointments
- ✅ Approve appointments
- ❌ Cancel appointments with reason
- 🔍 Filter by date/status
- 📄 View patient details

#### Patient Management
- 👤 View patient profiles
- 📋 Add medical history
- 💊 Prescribe medications
- 📊 Track patient progress
- 🔍 Search patients

#### Profile
- ✏️ Update doctor profile
- 🏥 Manage specialization
- 📧 Change contact info
- 🔒 Change password

---

### Admin Features

#### Dashboard
- 📊 Total system statistics
  - Total doctors
  - Total patients
  - Total appointments
  - New queries
- 📈 Recent activity
- 📅 Latest appointments
- 📝 Recent contact submissions

#### Doctor Management
- ➕ Add new doctors
- ✏️ Edit doctor details
- 🗑️ Delete doctors
- 👀 View doctor list
- 🔍 Search doctors
- 📊 Doctor statistics

#### Specialization Management
- ➕ Add medical specializations
- ✏️ Edit specializations
- 🗑️ Delete specializations
- 📋 View all specializations

#### Patient Management
- 👥 View all patients
- 📊 Patient statistics
- 🔍 Search patients
- 📋 View patient details

#### Appointment Overview
- 📅 View all appointments
- 📊 Appointment statistics
- 🔍 Filter by date/status/doctor
- 📄 Export reports

#### Content Management
- 📝 Update About Us page
- 📧 Update Contact Us page
- 🖼️ Manage gallery images

#### System Logs
- 📜 View user login logs
- 📜 View doctor login logs
- 🔍 Track system activity
- 🕐 Login history with timestamps

#### Contact Management
- 📧 View contact form submissions
- 📋 Manage queries
- 🗑️ Delete processed queries

---

## 🐛 Troubleshooting

### Common Issues

#### 1. Database Connection Failed
**Problem**: "Failed to connect to MySQL" error

**Solutions**:
- Verify MySQL service is running in XAMPP
- Check database credentials in `config.php`
- Ensure database `hms` exists
- Import SQL file if database is empty
- For InfinityFree: Wait 24-72 hours for MySQL activation

#### 2. Blank Page / 500 Error
**Problem**: White screen or HTTP 500 error

**Solutions**:
- Enable error reporting: Add to top of PHP file:
  ```php
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  ```
- Check PHP version (must be 7.4+)
- Verify file permissions (755 for directories, 644 for files)
- Check Apache error logs

#### 3. Login Not Working
**Problem**: Cannot login with credentials

**Solutions**:
- Verify database is imported correctly
- Check `users`, `doctors`, or `admin` tables exist
- Ensure password is MD5 hashed in database
- Clear browser cache and cookies
- Check session configuration

#### 4. Appointments Not Loading
**Problem**: Doctor dropdown empty or appointments not showing

**Solutions**:
- Check `doctorspecilization` table has data
- Verify `doctors` table is populated
- Check AJAX endpoint `get_doctor.php` works
- Open browser console for JavaScript errors
- Ensure jQuery is loaded

#### 5. CSS/Images Not Loading
**Problem**: Page appears without styling

**Solutions**:
- Verify file paths are correct
- Check `.htaccess` for rewrite rules
- Clear browser cache (Ctrl+F5)
- Verify `assets` folder is uploaded
- Check file permissions

#### 6. Email Not Working
**Problem**: Password reset emails not sending

**Solutions**:
- Configure SMTP settings in PHP
- Use PHPMailer library
- Check spam folder
- Verify email server configuration
- For free hosting: Email may have limitations

---

## 🔧 Advanced Configuration

### Enable HTTPS
For production, always use HTTPS:

1. Get SSL certificate (Let's Encrypt is free)
2. Update `.htaccess`:
```apache
RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

### Improve Security

#### 1. Upgrade Password Hashing
Replace MD5 with bcrypt:
```php
// Registration
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Login verification
if (password_verify($input_password, $stored_hash)) {
    // Login success
}
```

#### 2. Prepared Statements
Replace `mysqli_real_escape_string` with prepared statements:
```php
$stmt = $con->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
```

#### 3. CSRF Protection
Add CSRF tokens to forms:
```php
// Generate token
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));

// In form
<input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

// Verify
if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die('CSRF token validation failed');
}
```

### Performance Optimization

#### 1. Enable Caching
Add to `.htaccess`:
```apache
<IfModule mod_expires.c>
ExpiresActive On
ExpiresByType image/jpg "access plus 1 year"
ExpiresByType image/jpeg "access plus 1 year"
ExpiresByType image/png "access plus 1 year"
ExpiresByType text/css "access plus 1 month"
ExpiresByType application/javascript "access plus 1 month"
</IfModule>
```

#### 2. Minify CSS/JS
Use tools like:
- [CSS Minifier](https://cssminifier.com/)
- [JavaScript Minifier](https://javascript-minifier.com/)

#### 3. Optimize Images
- Compress images before upload
- Use WebP format for better compression
- Lazy load images below the fold

---

## 🚀 Future Enhancements

### Planned Features
- [ ] Email notifications for appointments
- [ ] SMS reminders
- [ ] Payment gateway integration
- [ ] Video consultation
- [ ] Prescription printing
- [ ] Lab report uploads
- [ ] Medicine inventory management
- [ ] Billing system
- [ ] Insurance claim processing
- [ ] Multi-language support
- [ ] Dark mode theme
- [ ] Mobile app (React Native)
- [ ] API for third-party integration
- [ ] Advanced reporting and analytics
- [ ] AI-powered appointment scheduling

---

## 🤝 Contributing

We welcome contributions! To contribute:

1. Fork the repository
2. Create a feature branch: `git checkout -b feature/amazing-feature`
3. Commit your changes: `git commit -m 'Add amazing feature'`
4. Push to branch: `git push origin feature/amazing-feature`
5. Open a Pull Request

### Contribution Guidelines
- Follow PSR-12 coding standards for PHP
- Write meaningful commit messages
- Add comments for complex logic
- Test thoroughly before submitting
- Update documentation if needed

---

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

```
MIT License

Copyright (c) 2024 HMS+

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```

---

## 📞 Support

### Getting Help
- 📧 Email: support@hmsplus.com
- 💬 Discord: [Join our community](https://discord.gg/hmsplus)
- 🐛 Issues: [GitHub Issues](https://github.com/yourusername/HMS/issues)
- 📖 Documentation: [Wiki](https://github.com/yourusername/HMS/wiki)

### Frequently Asked Questions

**Q: Can I use this for commercial purposes?**  
A: Yes, this project is under MIT License. You can use it commercially.

**Q: Is this HIPAA compliant?**  
A: No, additional security measures are needed for HIPAA compliance.

**Q: Can I customize the design?**  
A: Yes, all CSS files are editable. Customize as needed.

**Q: How do I add more doctor specializations?**  
A: Login as admin → Manage Specialization → Add New Specialization

**Q: Can patients book multiple appointments?**  
A: Yes, there's no limit on the number of appointments.

**Q: How do I backup the database?**  
A: Use phpMyAdmin → Export → Save SQL file regularly.

---

## 🙏 Acknowledgments

- Bootstrap Team for the responsive framework
- Font Awesome for the icon library
- jQuery Team for JavaScript simplification
- XAMPP for local development environment
- InfinityFree for free hosting solution
- All contributors and testers

---

## 📊 Project Stats

- **Lines of Code**: ~15,000+
- **Number of Files**: 100+
- **Database Tables**: 11
- **Supported Languages**: English (more coming)
- **Browser Support**: 99%+ modern browsers
- **Mobile Responsive**: Yes
- **Last Updated**: 2024

---

## 🌟 Show Your Support

If you find this project helpful, please ⭐ star the repository and share it with others!

---

<div align="center">

### Made with ❤️ by HMS+ Team

**[Live Demo](http://hmsfree.infinityfreeapp.com/)** • **[GitHub](https://github.com/yourusername/HMS)** • **[Documentation](https://github.com/yourusername/HMS/wiki)**

© 2024 HMS+. All rights reserved.

</div>
