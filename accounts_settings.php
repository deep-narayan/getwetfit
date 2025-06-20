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

    // Handle image upload if submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile_photo'])) {
        $targetDir = "profileImage/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $fileTmp = $_FILES["profile_photo"]["tmp_name"];
        $fileName = pathinfo($_FILES["profile_photo"]["name"], PATHINFO_FILENAME);
        $fileExt = strtolower(pathinfo($_FILES["profile_photo"]["name"], PATHINFO_EXTENSION));
        $allowedTypes = ['jpg', 'jpeg', 'png', 'webp'];

        if (!in_array($fileExt, $allowedTypes)) {
            die("Only JPG, JPEG, PNG, and WEBP files are allowed.");
        }

        $safeName = preg_replace('/[^a-zA-Z0-9_-]/', '_', $fileName);
        $webpFileName = time() . "_" . $safeName . ".webp";
        $targetWebpPath = $targetDir . $webpFileName;

        if ($fileExt === 'webp') {
            if (move_uploaded_file($fileTmp, $targetWebpPath)) {
                $update = $conn->prepare("UPDATE login SET image = ? WHERE id = ?");
                $update->execute([$targetWebpPath, $userId]);
                echo "<script>alert('Profile image uploaded successfully'); window.location.href = window.location.pathname;</script>";

            } else {
                echo "❌ Failed to upload WebP image.";
            }
        } else {
            switch ($fileExt) {
                case 'jpg':
                case 'jpeg':
                    $image = imagecreatefromjpeg($fileTmp);
                    break;
                case 'png':
                    $image = imagecreatefrompng($fileTmp);
                    break;
                default:
                    die("Unsupported image type.");
            }

            if ($image && imagewebp($image, $targetWebpPath, 80)) {
                imagedestroy($image);
                $update = $conn->prepare("UPDATE login SET image = ? WHERE id = ?");
                $update->execute([$targetWebpPath, $userId]);
                echo "<script>alert('Profile image uploaded successfully'); window.location.href = window.location.pathname;</script>";
            } else {
                echo "❌ Conversion to WebP failed.";
            }
        }
    }
} catch (Exception $e) {
    echo "<div class='alert alert-danger'>Something went wrong: " . $e->getMessage() . "</div>";
    exit;
}
?>
<style>
  .profile-box {
    background: #111;
    border-radius: 20px;
    box-shadow: 0 0 25px rgba(0, 255, 255, 0.05);
    color: #fff;
  }

  .profile-card {
    background: linear-gradient(145deg, #0f0f0f, #1c1c1c);
    padding: 2rem 1rem;
    border-radius: 15px;
    box-shadow: 0 0 10px rgba(0,0,0,0.4);
  }

  .profile-img {
    width: 130px;
    height: 130px;
    object-fit: cover;
    border: 4px solid #16B2FD;
  }

  .profile-info {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .profile-info li {
    padding: 0.8rem 0;
    border-bottom: 1px solid rgba(255,255,255,0.1);
  }

  .edit-btn {
    background: linear-gradient(90deg, #16B2FD, #0f0c29);
    border: none;
    color: #fff;
    font-weight: 600;
    border-radius: 30px;
    padding: 0.5rem 1.5rem;
    transition: 0.3s ease;
  }

  .edit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 0 10px #16B2FD;
  }

  .text-gradient {
    background: linear-gradient(90deg, #16B2FD, #0f0c29);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    font-weight: bold;
    font-size: 1.8rem;
  }

  .border-left-detail {
    border-left: 2px solid rgba(255, 255, 255, 0.1);
  }

  .hr-gradient {
    height: 2px;
    border: none;
    margin: 1rem auto;
    background-image: linear-gradient(to right, rgba(255,255,255,0.2), rgba(255,255,255,0.8), rgba(255,255,255,0.2));
  }
</style>

<main id="content">
  <nav aria-label="breadcrumb" class="mt-5">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="main.php">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Profile</li>
    </ol>
</nav>
  <div class="container my-5">
    <div class="profile-box p-4">
      
      <!-- Profile Title inside box -->
      <div class="text-center mb-4">
        <h2 class="text-gradient">Profile</h2>
        <hr class="hr-gradient" style="width: 200px;">
      </div>

      <div class="row">
        <!-- Left: Profile Image Card -->
        <div class="col-md-4 mb-4 mb-md-0 text-center">
          <div class="profile-card">
            <img src="<?= $user['image'] ? $user['image'] : 'https://via.placeholder.com/150' ?>" class="rounded-circle profile-img mb-3" alt="Profile Picture">
            <h5 class="mb-1"><?= $userName ?></h5>
            <p class="text-muted small">Member since 2025</p>
            <form action="" method="POST" enctype="multipart/form-data">
              <label for="photoUpload" class="edit-btn" style="cursor: pointer;">Edit Profile Photo</label>
              <input type="file" name="profile_photo" id="photoUpload" accept="image/*" style="display: none;" onchange="this.form.submit()">
            </form>

          </div>
        </div>

        <!-- Right: Profile Details -->
        <div class="profile-card col-md-8 border-left-detail pl-md-4">
          <hr class="hr-gradient">
          <ul class="profile-info">
            <li><strong>Email:</strong> <?= $userName ?></li>
            <li><strong>Contact:</strong><?= $userContact ?> </li>
            <li><strong>Member Since:</strong> <?= $user['date'];?></li>
          </ul>
          <a href="edit_profile.php" style="color:#fcfcfc" class="btn edit-btn mt-4">Edit Profile</a>
        </div>
      </div>
    </div>
  </div>
</main>

<?php
include "./layouts/dashboardfooter.php";
?>
