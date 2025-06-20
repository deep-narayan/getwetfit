<?php
include "includes/load.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$showModal = false;
$random_number = 0;
if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $contact = $_POST['contact'];
  $email = $_POST['email'];     
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];
  
  if ($password != $confirm_password) {
    echo "<script>alert('Write password correctly!')</script>";
  } else {
    $random_number = rand(1, 1000000);
    $random_number_two = rand(10, 20);
    $hash_password = password_hash($password, PASSWORD_BCRYPT);

    try {
      $query = $conn->prepare("INSERT INTO login (name, contact, email, text, ccode, password, date) VALUES (?, ?, ?, ?, ?, ?, NOW())");
      $query->execute([$name, $contact, $email, $text, $ccode, $hash_password]);


      // trigger modal if successful
      $showModal = true;


      


      require 'PHPMailer-master/src/PHPMailer.php';
      require 'PHPMailer-master/src/SMTP.php';
      require 'PHPMailer-master/src/Exception.php';

      $mail = new PHPMailer(true);

      try {
          $mail->isSMTP();
          $mail->Host       = 'smtpout.secureserver.net';
          $mail->SMTPAuth   = true;
          $mail->Username   = 'team@getwetfit.com';
          $mail->Password   = 'getwetfit25';
          $mail->SMTPSecure = 'tls';
          $mail->Port       = 587;

          $mail->setFrom('team@getwetfit.com', 'GetWetFit&Co.');
          $mail->addAddress($email);

          $mail->isHTML(true);
          $mail->Subject = 'Confirmation Mail - GetWetFit';
          $mail->Body = "
          <div style='font-family: Arial, sans-serif; padding: 20px; background-color: #f9f9f9; color: #333;'>
            <h2 style='color: #007bff;'>Email Verification</h2>
            <p>Dear User,</p>
            <p>Thank you for registering with us. To complete your sign-up, please verify your email address using the code below:</p>
            <div style='margin: 20px 0; padding: 15px; background-color: #e9ecef; border-left: 5px solid #007bff; font-size: 18px;'>
              <strong>Verification Code:</strong> {$random_number}
            </div>
            <p>If you did not initiate this request, please ignore this email.</p>
            <p>Best regards,<br>GetWetFit&Co.</p>
          </div>
        ";
          $mail->send();
          echo "<script>alert('Check your mail and verify before login!');</script>";
      } catch (Exception $e) {
          // echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');</script>";
          echo "<script>alert('Some error occured please contact on : 9582384888!');</script>";
      }



    } catch (Exception $e) {
      echo "<script>alert('Error: " . $e->getMessage() . "')</script>";
    }
    }


  


}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sign Up - GetWetFit</title>
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

    .signup-container {
      display: flex;
      background: rgba(0, 0, 0, 0.4);
      border-radius: 16px;
      backdrop-filter: blur(12px);
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
      overflow: hidden;
      width: 90%;
      max-width: 900px;
      min-height: 500px;
    }

    .signup-left,
    .signup-right {
      flex: 1;
      padding: 40px;
    }

    .signup-left {
      color: #fff;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .signup-left h1 {
      font-size: 2rem;
      font-weight: bold;
    }

    .signup-left p {
      font-size: 1rem;
      margin-top: 10px;
      color: #ddd;
    }

    .signup-right {
      background: rgba(0, 0, 0, 0.6);
      color: #fff;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .signup-form {
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
      .signup-container {
        flex-direction: column;
      }
      .signup-left {
        padding: 30px 20px;
        text-align: center;
      }
    }
  </style>
</head>
<body>

  <div class="signup-container">
    <div class="signup-left">
      <h1>Join GetWetFit</h1>
      <p>India’s First Floating Fitness Platform. Dive into a new way to stay fit with us!</p>
    </div>

    <div class="signup-right">
      <div class="signup-form">
        <h3 class="font-weight-bold mb-3">Sign Up</h3>
        <p class="text-muted mb-4">Create an account to start your fitness journey.</p>
        <form method="POST" action="">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Full Name" name="name" required />
          </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Contact" name="contact" required />
          </div>
          <div class="form-group">
            <input type="email" class="form-control" placeholder="Email" name="email" required />
          </div>
          <div class="form-group">
            <input type="password" class="form-control" placeholder="Password" name="password" required />
          </div>
          <div class="form-group">
            <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" required />
          </div>
          <button type="submit" name="submit" class="btn btn-block btn-custom mt-3">Sign Up</button>
        </form>
        <p class="mt-4">
          Already have an account?
          <a href="login.php" class="text-info font-weight-bold">Login</a>
        </p>
        <a href="/getwetfit_final/getwetfit" class="link-light d-block mt-2">← Back to home page</a>
      </div>
    </div>
  </div>

  <!-- Verify Email Modal -->
  <div class="modal fade" id="verifyModal" tabindex="-1" role="dialog" aria-labelledby="verifyModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content bg-dark text-white rounded-lg shadow-lg">
        <div class="modal-header border-0">
          <h5 class="modal-title" id="verifyModalLabel">Email Verification</h5>
        </div>
        <div class="modal-body">
          <?php
          if (isset($_POST['verification_button'])) {
              $verification_code = $_POST['verification'];
              $stmt = $conn->prepare("SELECT * FROM login WHERE ccode = :code");
              $stmt->bindParam(':code', $verification_code, PDO::PARAM_STR);
              $stmt->execute();
              $result = $stmt->fetch(PDO::FETCH_ASSOC);

              if ($result && $verification === $result['code']) {
                  $queryChecked = $conn->prepare("UPDATE login SET checked = 1 WHERE ccode = ?");
                  $queryChecked->execute([$verification_code]);
                  echo  "<script>alert('Verified successfully. Redirecting...')</script>";
                  redirect("login.php");
              } else {
                 $deleteQuery = $conn->prepare("DELETE FROM login WHERE ccode = ?");
                 $deleteQuery->execute([$random_number]);
                 echo  "<script>alert('Invalid verification code.')</script>";
              }
          }
          ?>
          <form action="" method="post" class="mt-3">
            <div class="form-group">
              <label for="verification">Enter Verification Code</label>
              <input type="text" class="form-control" name="verification" id="verification" required placeholder="e.g. 123456">
            </div>
        
            <button type="submit" name="verification_button" class="btn btn-info btn-block">Verify Email</button>
          </form>
          <p class="mt-3 small text-muted text-center">
            Check your inbox or spam for the verification code.
          </p>
        </div>
        <div class="modal-footer border-0 justify-content-center">
          <button type="button" class="btn btn-secondary" disabled>Verification Required</button>
        </div>
      </div>
    </div>
  </div>

<!-- Trigger modal when page loads -->
<script>
  $(document).ready(function(){
    $('#verifyModal').modal('show');
  });
</script>


  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

  <?php if ($showModal): ?>
  <script>
    $(document).ready(function () {
      $('#verifyModal').modal('show');
    });
  </script>
  <?php endif; ?>

</body>
</html>
