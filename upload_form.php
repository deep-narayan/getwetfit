<!-- Add Bootstrap 4 CSS -->
<?php
include './layouts/dashboardheader.php';

$role = $_SESSION['role'];
if ($role !== 'admin') {
    redirect("logout.php");
}

if (isset($_POST['submit'])) {
    $session_type = $_POST['session_type'];
    $videoUrl = $_POST['video_url'];
    $isForTestinomial = $_POST['is_testimonial']=="yes"? 1:0;

    $targetDir = "uploads/";

    // Create directory if not exists
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    $fileTmp = $_FILES["image"]["tmp_name"];
    $fileName = pathinfo($_FILES["image"]["name"], PATHINFO_FILENAME);
    $fileExt = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
    $allowedTypes = ['jpg', 'jpeg', 'png', 'webp'];

    if (!in_array($fileExt, $allowedTypes)) {
        die("Only JPG, JPEG, PNG, and WEBP files are allowed.");
    }

    $safeName = preg_replace('/[^a-zA-Z0-9_-]/', '_', $fileName);
    $webpFileName = time() . "_" . $safeName . ".webp";
    $targetWebpPath = $targetDir . $webpFileName;

    if ($fileExt === 'webp') {
        // Just move the file if it's already webp
        if (move_uploaded_file($fileTmp, $targetWebpPath)) {
            $uploadImageQuery = $conn->prepare("INSERT INTO galleryurl(imgURL, sessionType,videoUrl,forTestinomial) VALUES(?,?,?,?)");
            $uploadImageQuery->execute([$targetWebpPath, $session_type,$videoUrl, $isForTestinomial]);
            echo "<script>alert('WebP image uploaded successfully');</script>";
        } else {
            echo "❌ Failed to upload WebP image.";
        }
    } else {
        // Convert to WebP if jpg/jpeg/png
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
            $uploadImageQuery = $conn->prepare("INSERT INTO galleryurl(imgURL, sessionType, videoUrl,forTestinomial) VALUES(?,?,?,?)");
            $uploadImageQuery->execute([$targetWebpPath, $session_type, $videoUrl, $isForTestinomial]);
            echo "<script>alert('Image uploaded successfully');</script>";
        } else {
            echo "❌ Conversion to WebP failed.";
        }
    }
}
?>


<main id="content" class="mt-5">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="admin_dashboard.php">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Upload photos</li>
    </ol>
  </nav>
  <div class="container mt-5">
    <div class="card border-light">
      <div class="card-header bg-white">
        <h4 class="mb-0 text-dark">Upload Image</h4>
      </div>
      <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label for="image" class="text-dark">Select Image:</label>
            <input type="file" class="form-control-file" name="image" id="image" required>
          </div>
          <div class="form-group">
            <label for="video_url" class="text-dark">Video YouTube URL:</label>
            <input type="text" class="form-control" name="video_url" id="video_url">
          </div>

          <div class="form-group">
            <label class="text-dark d-block">Is this video URL for a Testimonial also?</label>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="is_testimonial" id="testimonial_yes" value="yes">
              <label class="form-check-label" for="testimonial_yes">Yes</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="is_testimonial" id="testimonial_no" value="no" checked>
              <label class="form-check-label" for="testimonial_no">No</label>
            </div>
          </div>


          Add check point label for= for testinomial also   ------ yes no
          <div class="form-group">
            <label for="session_type" class="text-dark">Select Session Type:</label>
            <select class="form-control" name="session_type" id="session_type" required>
              <option value="" disabled selected>-- Select Session --</option>
              <option value="flaabh">FLAABH™ Fit</option>
              <option value="Soundhealing">Sound Healing</option>
              <option value="Retreat">Retreat</option>>
            </select>
          </div>

          <button type="submit" name="submit" class="btn btn-dark btn-block">Upload</button>
        </form>
      </div>
    </div>
  </div>
</main>



<?php
include "./layouts/dashboardfooter.php";

?>