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
      font-family:sans-serif;
    }
    .login-wrapper {
      display: flex;
      height: 100vh;
    }
    .login-left {
      background: url('./assets/images/yoga2.jpg') center center no-repeat;
      background-size: cover;
      position: relative;
      display: none;
    }
    .login-left::before {
      content: '';
      position: absolute;
      top: 0; left: 0;
      height: 100%; width: 100%;
      background-color: rgba(0, 0, 0, 0.7);
    }
    .login-left-content {
      position: absolute;
      top: 30%;
      left: 10%;
      z-index: 1;
      color: #fff;
    }
    .login-left-content h1 {
      font-size: 2.5rem;
      font-weight: bold;
    }
    .login-left-content p {
      max-width: 400px;
      font-size: 1rem;
    }

    @media (min-width: 768px) {
      .login-left {
        flex: 1;
        display: block;
      }
    }

    .login-right {
      flex: 1;
      background-color: black;
      padding: 60px 40px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .login-form {
      width: 100%;
      max-width: 400px;
      color: #FCFCFC;
    }

    .login-form input {
      height: 45px;
    }

    .login-form .btn {
      background-color: #16B2FD;
      color: #fff;
    }

    .login-form .btn:hover {
      background-color: #333;
    }
  </style>
</head>
<body>

<div class="login-wrapper">
  <!-- Left Side -->
  <div class="login-left">
    <div class="login-left-content">
      <h1>Welcome To GetWetFit</h1>
      <p>India’s First Floating Fitness Platform.</p>
    </div>
  </div>

  <!-- Right Side (Form) -->
  <div class="login-right">
    <div class="login-form">
      <h2 class="font-weight-bold mb-4">GetWetFit</h2>
      <h3 class="mb-2">Login</h3>
      <p class="text-muted mb-4">Welcome back! Please log in to manage your sessions.</p>

      <form method="POST" action="#">
        <div class="form-group">
          <input type="email" class="form-control" placeholder="Email" name="email" required />
        </div>
        <div class="form-group">
          <input type="password" class="form-control" placeholder="Password" name="password" required />
        </div>
        <button type="submit" class="btn btn-block">Login</button>
      </form>

      <p class="mt-4 text-center" style="color: #FCFCFC;">
        Don’t have an account?
        <a href="signup.php" class="text-dark font-weight-bold"><span style="color:#16B2FD">Sign up</span></a>
      </p>

      <a href="/getwetfit" class="mt-4 text-center">Back to home page!</a>
    </div>
    
  </div>

</div>

</body>
</html>
