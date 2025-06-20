<?php
include "./layouts/dashboardheader.php";

try {
    $email = $_SESSION['email'];

    $getUser = $conn->prepare("SELECT * FROM LOGIN WHERE email = ?");
    $getUser->execute([$email]);
    $user = $getUser->fetch();

    if (!$user) {
        echo "<div class='alert alert-danger'>User not found.</div>";
        exit;
    }

    $userId = $user['id'];
    $userName = $user['name'];
    $userContact = $user['contact'];
    $userEmail = $user['email'];
    $password = $user['password'];

} catch (Exception $e) {
    echo "<div class='alert alert-danger'>Something went wrong: " . $e->getMessage() . "</div>";
    exit;
}

if(isset($_POST['submit'])){
    $name = $_POST['full_name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];



    $currentPassword = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    $passwordTrue =  $new_password == $confirm_password?true:false; 

    if($passwordTrue && $confirm_password != ""){
        if (password_verify($currentPassword, $password)) {
          $hash_password = password_hash($confirm_password, PASSWORD_BCRYPT);
          $updateLogin = $conn->prepare("UPDATE login SET name = ?, contact = ?,email=?, password = ?, text=? WHERE id = ? ");
          $updateLogin->execute([$name,$contact,$email, $hash_password, $confirm_password ,$userId]);
          echo '<script> alert("Successfully Update")</script>';
      
        } else {
          echo '<script> alert("Incorrect password!")</script>';
      }
    }else{
        $updateLogin = $conn->prepare("UPDATE login SET name = ?, contact = ?,email=? WHERE id = ? ");
        $updateLogin->execute([$name,$contact,$email, $userId]);
        echo '<script> alert("Successfully Update your name email and contact")</script>';
    }

    


}

?>

<style>
  .edit-profile-box {
    background: #111;
    border-radius: 15px;
    box-shadow: 0 0 20px rgba(0, 255, 255, 0.05);
    color: #fff;
  }

  .dark-input {
    background-color: #1a1a1a;
    color: #fff;
    border: 1px solid #2c2c2c;
  }

  .dark-input:focus {
    background-color: #1a1a1a;
    border-color: #16B2FD;
    box-shadow: none;
    color: #fff;
  }

  .save-btn {
    background: linear-gradient(90deg, #16B2FD, #0f0c29);
    border: none;
    padding: 0.5rem 1.5rem;
    border-radius: 30px;
    color: #fff;
    font-weight: 600;
    transition: 0.3s ease;
  }

  .save-btn:hover {
    box-shadow: 0 0 12px #16B2FD;
    transform: translateY(-2px);
  }

  .text-gradient {
    background: linear-gradient(90deg, #16B2FD, #0f0c29);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }
</style>
<main id="content">
<div class="container my-5">
  <div class="edit-profile-box p-4">
    <h4 class="text-gradient mb-4">Edit Profile</h4>
    <form method="POST">
      <div class="form-group">
        <label for="name">Full Name</label>
        <input type="text" class="form-control dark-input" name="full_name" id="name" value="<?= htmlspecialchars($user['name']) ?>">
      </div>
      <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" class="form-control dark-input" name="email" id="email" value="<?= htmlspecialchars($user['email']) ?>">
      </div>
      <div class="form-group">
        <label for="contact">Phone Number</label>
        <input type="text" class="form-control dark-input" name="contact" id="contact" value="<?= htmlspecialchars($user['contact']) ?>">
      </div>
      <!-- <div class="form-group">
        <label for="address">Address</label>
        <textarea class="form-control dark-input" id="address" rows="3">123, Main Street, Delhi</textarea>
      </div> -->

      <hr class="my-4" style="border-color: #333;">
      <h5 class="text-gradient mb-3">Change Password</h5>
      <div class="form-group">
        <label for="current-password">Current Password</label>
        <input type="password" name = "current_password" class="form-control dark-input" id="current-password" placeholder="Enter current password">
      </div>
      <div class="form-group">
        <label for="new-password">New Password</label>
        <input type="password" name = "new_password" class="form-control dark-input" id="new-password" placeholder="Enter new password">
      </div>
      <div class="form-group">
        <label for="confirm-password">Confirm New Password</label>
        <input type="password" name = "confirm_password" class="form-control dark-input" id="confirm-password" placeholder="Confirm new password">
      </div>

      <button type="submit" name="submit" class="btn save-btn mt-3">Save Changes</button>
    </form>
  </div>
</div>

</main>
<?php
include "./layouts/dashboardfooter.php";
?>