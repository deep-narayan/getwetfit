<?php
include 'includes/load.php';

if (!$session->isUserLoggedIn()) {
    redirect("login.php");
}


$getNotifications = $conn->prepare("SELECT * FROM notifications ORDER BY id DESC LIMIT 5");
$getNotifications->execute();
$resultGetNotification = $getNotifications->fetchAll();



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>GetWetFit</title>

  <!-- Fonts & Icons -->
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css" rel="stylesheet" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Open Sans', sans-serif;
      background: linear-gradient(135deg, #131519 0%, #0a0a0a 50%, #000000 100%);
      padding-top: 60px;
      color: #16B2FD;
    }
    

    header {
      position: fixed;
      top: 0;
      width: 100%;
      height: 60px;
      background:black;
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 1.2rem;
      z-index: 1000;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }
    .brand img {
      height: 40px;
      max-width: 100%;
      object-fit: contain;
      display: block;
    }

    .navbar-brand {
      display: flex;
      align-items: center;
      text-decoration: none;
    }

    header .brand {
      font-weight: 800;
      font-size: 1.3rem;
      letter-spacing: 1px;
    }

    #toggleSidebar {
      background: none;
      border: none;
      font-size: 1.5rem;
      color: #fff;
      display: none;
      cursor: pointer;
    }

    #sidebar {
      position: fixed;
      top: 60px;
      left: 0;
      width: 260px;
      height: calc(100% - 60px);
      background: black;
      padding: 2rem 1.2rem;
      overflow-y: auto;
      transform: translateX(0);
      transition: transform 0.3s ease;
      z-index: 999;
      overflow-y: scroll;
      
    }

    
    #sidebar::-webkit-scrollbar {
      display: none;
    }

    #sidebar ul {
      list-style: none;
    }

    #sidebar ul li {
      margin-bottom: 2rem;
    }

    #sidebar ul li a {
      color: #FCFCFC;
      font-size: 1rem;
      text-decoration: none;
      display: block; /* Makes the <a> fill the width */
      padding: 0.75rem 1rem;
      border-radius: 4px;
      transition: all 0.3s ease;
      background: linear-gradient(90deg, #131519,rgb(38, 40, 44), #131519);
    }

    #sidebar ul li a:hover {
      background: linear-gradient(90deg, #16B2FD, #0f0c29);
      color: #fff;
      transform: translateX(5px);
    }

    #sidebar ul li a i {
      margin-right: 1rem;
      font-size: 1.1rem;
    }

    #content {
      margin-left: 260px;
      padding-left: 2rem;
      padding-right: 2rem;
      min-height: calc(100vh - 100px);
      transition: margin-left 0.3s ease;
    }

    .glass-box {
      background: rgba(255, 255, 255, 0.6);
      border-radius: 12px;
      padding: 2rem;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      backdrop-filter: blur(8px);
    }

    footer {
      background: #343a40;
      color: white;
      text-align: center;
      padding: 12px;
      font-size: 0.9rem;
      position: fixed;
      bottom: 0;
      left: 260px;
      width: calc(100% - 260px);
      transition: left 0.3s ease;
    }

    /* Responsive */
    @media (max-width: 768px) {
      #toggleSidebar {
        display: block;
      }

      #sidebar {
        transform: translateX(-100%);
      }

      #sidebar.active {
        transform: translateX(0);
      }

      #content {
        margin-left: 0;
      }

      footer {
        left: 0;
        width: 100%;
      }
    }
    .header-actions {
  display: flex;
  align-items: center;
  gap: 12px;
}

.notification-icon, .profile-icon {
  position: relative;
}

.notification-dot {
  position: absolute;
  top: 0;
  right: 0;
  background: red;
  width: 8px;
  height: 8px;
  border-radius: 50%;
  display: inline-block;
}

.toggle-btn {
  background: none;
  border: none;
  font-size: 1.5rem;
  color: #fff;
  display: none;
}

@media (max-width: 768px) {
  .toggle-btn {
    display: block;
  }
  .header-actions {
    gap: 10px;
  }
}

  </style>
</head>
<body>

  <!-- Header -->
<header>
  <div class="brand">
    <a href="main.php" class="navbar-brand">
      <img src="assets/images/GetWetFit(PNG).webp" alt="GetWetFit Logo" />
    </a>
  </div>

  <div class="d-flex align-items-center gap-3">
    <div class="header-actions">
  <a href="#" class="text-white notification-icon" id="notificationToggle" style="color: #FCFCFC;">
    <i class="fas fa-bell fa-lg"></i>
    <span class="notification-dot"></span>
  </a>
  <?php if($_SESSION['role'] == "user"):?>
  <a href="cart.php" class="text-white profile-icon" style="color: #FCFCFC;">
    <i class="fa-solid fa-cart-shopping"></i>
    <span class="notification-dot"></span>
  </a>
  <?php endif; ?>
  <a href="#" class="text-white profile-icon" id="profileToggle" style="color: #FCFCFC;">
    <i class="fas fa-user-circle fa-lg"></i>
  </a>
  <button id="toggleSidebar" class="toggle-btn">
    <i class="fas fa-bars" id="sidebarIcon"></i>
  </button>
</div>

</header>
<!-- Notification Dropdown -->
<div id="notificationDropdown" style="
  position: absolute;
  top: 65px;
  right: 20px;
  width: 300px;
  background: #fff;
  border-radius: 8px;
  box-shadow: 0 6px 12px rgba(0,0,0,0.2);
  display: none;
  z-index: 1050;
  padding: 15px;
  
">
  <h6 style="margin-bottom: 10px; font-weight: 700; color: #343a40;">Notifications</h6>
  <ul style="list-style: none; padding: 0; margin: 0;">
    <?php foreach($resultGetNotification as $notification): ?>
    <li style="padding: 10px 0; border-bottom: 1px solid #eee;">
      <i class="fas fa-calendar-alt text-primary mr-2"></i> <?= $notification['message']; ?>
    </li>
    <?php endforeach; ?>
  </ul>
</div>

<div id="profileDropDown" style="
  position: absolute;
  top: 65px;
  right: 20px;
  width: 300px;
  background: #fff;
  border-radius: 8px;
  box-shadow: 0 6px 12px rgba(0,0,0,0.2);
  display: none;
  z-index: 1050;
  padding: 15px;
  
">
  <ul style="list-style: none; padding: 0; margin: 0;">
    <li style="padding: 10px 0; border-bottom: 1px solid #eee;">
      <i class="fas fa-user-circle fa-lg"></i> <a href="accounts_settings.php" style="text-decoration:none;">Profile</a>
    </li>
    <li style="padding: 10px 0; border-bottom: 1px solid #eee;">
       <i class="fas fa-sign-out-alt"></i><a href="logout.php" style="text-decoration:none;">Logout</a>
    </li>
  </ul>
</div>


  <!-- Sidebar -->
<nav id="sidebar">
  <ul>
    <?php if(isset($_SESSION['role']) && $_SESSION['role'] != 'admin'): ?>
      <li><a href="main.php"><i class="fas fa-tachometer-alt"></i> OVERVIEW</a></li>
      <li><a href="my-events.php"><i class="fas fa-calendar-check"></i> MY EVENTS</a></li>
      <li><a href="past-event.php"><i class="fas fa-history"></i> PAST EVENTS</a></li>
      <li><a href="packages.php"><i class="fas fa-box"></i> PACKAGES</a></li>
      <li><a href="accounts_settings.php"><i class="fas fa-cog"></i> PROFILE</a></li>
    <?php endif; ?>

    <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
      <li><a href="admin_dashboard.php"><i class="fas fa-tachometer-alt"></i> OVERVIEW</a></li>
      <li><a href="upload_form.php"><i class="fas fa-image"></i> UPLOAD IMAGES</a></li>
      <li><a href="manage_gallery.php"><i class="fas fa-image"></i> MANAGE IMAGES</a></li>
      <li><a href="upcoming_events.php"><i class="fas fa-calendar-plus"></i> ADD EVENTS</a></li>
      <li><a href="manageUpcomingEvents.php"><i class="fas fa-tasks"></i> MANAGE EVENTS</a></li>
      <li><a href="booked_event_reports.php"><i class="fas fa-chart-line"></i>BOOKING REPORTS</a></li>
      <li><a href="manage_refund.php"><i class="fas fa-chart-line"></i>REFUND REPORTS</a></li>
      <li><a href="user_contact.php"><i class="fas fa-envelope"></i> USER INQUIRIES</a></li>
      <li><a href="manage_user.php"><i class="fa-solid fa-user"></i>MANAGE USERS</a></li>
      <li><a href="add_notification.php"><i class="fas fa-bell fa-lg"></i></i>NOTIFICATION</a></li>
    <?php endif; ?>

    <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> LOGOUT</a></li>
  </ul>
</nav>



