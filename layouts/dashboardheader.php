<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Attractive Header</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
  <style>
    body {
      background-color: #f8f9fa;
    }

    .navbar {
      background-color: #ffffff;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .navbar-brand img {
      height: 48px;
      width: 160px;
      object-fit: contain;
    }

    .dropdown-menu {
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .sidebar {
      background-color: #3a3a3a;
      color: #f0f0f0;
      min-height: 100vh;
      padding-top: 20px;
    }

    .sidebar a {
      color: #f0f0f0;
      padding: 12px 16px;
      display: block;
      border-radius: 8px;
      transition: background 0.3s ease;
    }

    .sidebar a:hover {
      background-color: #007bff;
      color: white;
      text-decoration: none;
    }

    main {
      background-color: #ffffff;
      padding: 24px;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .mobile-menu {
      transition: transform 0.3s ease-in-out;
    }

    .mobile-menu.show {
      transform: translateX(0);
    }

    .mobile-menu.hide {
      transform: translateX(-100%);
    }

    .mobile-menu a {
      padding: 12px 16px;
      font-size: 18px;
      border-radius: 8px;
      transition: background 0.3s ease;
    }

    .mobile-menu a:hover {
      background-color: #007bff;
      color: #fff !important;
    }
  </style>
</head>
<body>
  <div class="d-flex flex-column min-vh-100">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
      <a class="navbar-brand" href="/dashboard">
        <img src="assets/images/aster.png" alt="Aster Logo"/>
      </a>
      <div class="ml-auto d-none d-lg-block dropdown">
        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownUser" data-toggle="dropdown">
          <i class="far fa-user-circle fa-lg"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right">
          <a class="dropdown-item" href="#">Profile</a>
          <div class="dropdown-divider"></div>
          <form action="#" method="POST">
            <button type="submit" class="dropdown-item">Sign out</button>
          </form>
        </div>
      </div>
      <button class="btn d-lg-none" id="menuToggle">
        <i class="fas fa-bars"></i>
      </button>
    </nav>

    <!-- Page Content -->
    <div class="d-flex flex-grow-1 pt-5 mt-4">
      <!-- Sidebar -->
      <aside class="sidebar d-none d-lg-block col-md-3">
        <nav>
          <a href="/dashboard"><i class="fas fa-tachometer-alt mr-2"></i> Dashboard</a>
          <a href="/dashboard"><i class="fas fa-plus mr-2"></i> Add Product</a>
        </nav>
      </aside>
      <!-- Mobile Menu -->
        <div id="mobileMenu" class="mobile-menu hide position-fixed bg-white shadow p-4" style="top:0; left:0; height:100%; width:75%; z-index:1040;">
        <img src="assets/images/aster.png" alt="Logo" class="mb-4" style="height: 48px; width: 160px;"/>
        <a href="/profile" class="text-dark d-flex align-items-center mb-3">
            <i class="far fa-user mr-3"></i> PROFILE
        </a>
        <a href="/dashboard" class="text-dark d-flex align-items-center mb-3">
            <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
        </a>
        <a href="/logout" class="text-dark d-flex align-items-center">
            <i class="fas fa-sign-out-alt mr-3"></i> LOGOUT
        </a>
        </div>
