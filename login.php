<?php
include 'includes/load.php';

if(isset($_POST['loginbutton'])){
  $email = $_POST['email'];
  $paswword = $_POST['password'];

  $getUserData = $conn->prepare("SELECT * FROM login WHERE email = :useremail");
  $getUserData->bindParam(':useremail', $email);
  $getUserData->execute();
  $result = $getUserData->fetchAll();
  if($result == null){
    echo '<script> alert("Invalid username or password!")</script>';
    redirect('login.php');
  }
  $hashpassword = $result[0]['password'];
  $role = $result[0]['role'];
  if($result[0]['checked'] != 1){
      echo '<script> alert("Email not verified!")</script>';
      redirect('index.php');
  }
  if (password_verify($paswword, $hashpassword)) {
    $session->login($role, $email);
    if($role == "admin"){
      redirect('admin_dashboard.php');
    }else{
      redirect('main.php');
    }
  } else {
      echo '<script> alert("Invalid username or password!")</script>';
  }



}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - GetWetFit</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"/>
  <style>
    body, html {
      height: 100%;
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: url('./assets/images/image8.webp') no-repeat center center fixed;
      background-size: cover;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .login-container {
      display: flex;
      background: rgba(0, 0, 0, 0.4); /* new: darker container background */
      border-radius: 16px;
      backdrop-filter: blur(12px);
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
      overflow: hidden;
      width: 90%;
      max-width: 900px;
      min-height: 450px;
    }

    .login-left,
    .login-right {
      flex: 1;
      padding: 40px;
    }

    .login-left {
     
      color: #fff;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .login-left h1 {
      font-size: 2rem;
      font-weight: bold;
    }

    .login-left p {
      font-size: 1rem;
      margin-top: 10px;
      color: #ddd;
    }

    .login-right {
       background: rgba(0, 0, 0, 0.4);
      color: #fff;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .login-form {
      width: 100%;
    }

    .form-control {
      background: rgba(255, 255, 255, 0.1);
      border: none;
      border-radius: 8px;
      color: #fff;
    }

    .form-control::placeholder {
      color: #ccc;
    }

    .form-control:focus {
      background: rgba(255, 255, 255, 0.2);
      box-shadow: none;
      color: #fff;
    }

    .btn-custom {
      background: transparent;
      border: 2px solid #16B2FD;
      color: #16B2FD;
      border-radius: 8px;
      transition: all 0.3s ease;
    }

    .btn-custom:hover {
      background: #16B2FD;
      color: #fff;
    }

    .link-light {
      color: #aaa;
    }

    .link-light:hover {
      color: #fff;
      text-decoration: none;
    }

    @media (max-width: 768px) {
      .login-container {
        flex-direction: column;
      }
      .login-left {
        padding: 30px 20px;
        text-align: center;
      }
    }
  </style>
</head>
<body>

  <div class="login-container">
    <!-- Left Side -->
    <div class="login-left">
      <h1>Welcome to GetWetFit</h1>
      <p>India’s First Floating Fitness Platform. Stay fit with unique water-based workouts designed for everyone!</p> 
    </div>

    <!-- Right Side -->
    <div class="login-right">
      <div class="login-form">
        <h3 class="font-weight-bold mb-3">Login</h3>
        <p class="text-muted mb-4">Welcome back! Please log in to continue.</p>
        <form method="POST" action="#">
          <div class="form-group">
            <input type="email" class="form-control" placeholder="Email" name="email" required />
          </div>
          <div class="form-group">
            <input type="password" class="form-control" placeholder="Password" name="password" required />
          </div>
          <button type="submit" name="loginbutton" class="btn btn-block btn-custom mt-3">Login</button>
        </form>
        <p class="mt-4">
          Don’t have an account?
          <a href="signup.php" class="text-info font-weight-bold">Sign up</a>
        </p>
        <a href="/getwetfit_final/getwetfit" class="link-light d-block mt-2">← Back to home page</a>
      </div>
    </div>
  </div>

</body>
</html>
