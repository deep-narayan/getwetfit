<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>GetWetFit</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Favicon -->



    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <!-- CSS Libraries -->
        <link rel="stylesheet" href="./vendor/select2/css/select2.min.css">
        <link href="./vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
        <link rel="stylesheet" href="./bootstrap/dist/css/bootstrap.min.css">
        <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet"> -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="lib/animate/animate.min.css" rel="stylesheet">
        <link href="lib/flaticon/font/flaticon.css" rel="stylesheet"> 
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Template Stylesheet -->
    <link href="./assets/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Loader -->
    <div id="loader">
        <img src="./assets/images/logo.gif" alt="Loading..." />
    </div>
    <!-- Top Bar Start -->
    <div class="top-bar d-none d-md-block">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="top-bar-left">
                        <div class="text">
                            <i class="far fa-clock"></i>
                            <h2>8:00 - 9:00</h2>
                            <p>Mon - Fri</p>
                        </div>
                        <div class="text">
                            <i class="fa fa-phone-alt"></i>
                            <h2>9582384888 </h2>
                            <p>For Appointment</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="top-bar-right">
                        <div class="social">
                            <a href=""><i class="fab fa-twitter"></i></a>
                            <a href=""><i class="fab fa-facebook-f"></i></a>
                            <a href=""><i class="fab fa-linkedin-in"></i></a>
                            <a href=""><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Top Bar End -->

    <!-- Nav Bar Start -->
    <div class="navbar navbar-expand-lg bg-dark navbar-dark">
    
        <div class="container-fluid">
            <a href="index.php" class="navbar-brand"><img src="assets/images/GetWetFit(PNG).png" alt="" srcset=""></a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav ml-auto">
                    <a href="index.php" class="nav-item nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">Home</a>
                    <a href="about.php" class="nav-item nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : ''; ?>">About</a>
                    <a href="programs.php" class="nav-item nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'programs.php' ? 'active' : ''; ?>">Programs</a>
                    <a href="gallery_events.php" class="nav-item nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'gallery_events.php' ? 'active' : ''; ?>">Gallery & Events</a>
                    <a href="price.php" class="nav-item nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'price.php' ? 'active' : ''; ?>">Price</a>
                    <a href="contact_us.php" class="nav-item nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'contact_us.php' ? 'active' : ''; ?>">Contact Us</a>
                    <a href="faq.php" class="nav-item nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'faq.php' ? 'active' : ''; ?>">FaQ</a>
                    <a href="login.php" class="nav-item nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'login.php' ? 'active' : ''; ?>"> Login</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Nav Bar End -->

    

