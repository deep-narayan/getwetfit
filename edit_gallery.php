<?php
include './layouts/dashboardheader.php';

$role = $_SESSION['role'];
if ($role !== 'admin') {
    redirect("logout.php");
}

$id = isset($_GET['id']) ? $_GET['id'] : redirect('manageUpcomingEvents.php');

$getAllEvents = $conn->prepare("SELECT * FROM galleryurl WHERE id = ?");
$getAllEvents->execute([$id]);
$getAllEventsResult = $getAllEvents->fetchAll();



if (isset($_POST['submit'])) {
    $session_type = $_POST['session_type'];
    $targetDir = "uploads/";
    $imageUrl = $getAllEventsResult[0]['imgURL']; // default: existing image

    // Create directory if not exists
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    if (!empty($_FILES["image"]["name"])) {
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
            if (move_uploaded_file($fileTmp, $targetWebpPath)) {
                $imageUrl = $targetWebpPath;
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
                $imageUrl = $targetWebpPath;
            } else {
                echo "❌ Conversion to WebP failed.";
            }
        }

        // Delete old image if new uploaded successfully
        if ($imageUrl !== $getAllEventsResult['imgURL'] && file_exists($getAllEventsResult['imgURL'])) {
            unlink($getAllEventsResult['imgURL']);
        }
    }

    // Update the DB row
    $updateQuery = $conn->prepare("UPDATE galleryurl SET imgURL = ?, sessionType = ? WHERE id = ?");
    $updateQuery->execute([$imageUrl, $session_type, $id]);

    echo "<script>alert('Event updated successfully'); location.href='manage_gallery.php';</script>";
}
?>



<main id="content">
  <div class="container mt-5">
    <div class="card border-light">
      <div class="card-header bg-white">
        <h4 class="mb-0 text-dark">Upload Image</h4>
      </div>
      <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <?php if (!empty($getAllEventsResult[0]['imgURL']) && file_exists($getAllEventsResult[0]['imgURL'])): ?>
                <div class="form-group">
                    <label>Existing Image:</label><br>
                    <img src="<?= $getAllEventsResult[0]['imgURL'] ?>" alt="Current Image" style="max-width: 200px; height: auto; border: 1px solid #ccc;">
                </div>
            <?php endif; ?>
          <div class="form-group">
            <label for="image" class="text-dark">Select Image:</label>
            <input type="file" class="form-control-file" name="image" id="image">
          </div>

          <div class="form-group">
            <label for="video_url" class="text-dark">Video YouTube URL:</label>
            <input type="text" class="form-control" name="video_url" id="video_url" value="<?= $getAllEventsResult[0]['videoUrl'] ?>">
          </div>

          <div class="form-group">
            <label class="text-dark d-block">Is this video URL for a Testimonial also?</label>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="is_testimonial" id="testimonial_yes" value="yes" <?= $getAllEventsResult[0]['forTestinomial'] ? 'checked' : '' ?>>
              <label class="form-check-label" for="testimonial_yes">Yes</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="is_testimonial" id="testimonial_no" value="no" <?= $getAllEventsResult[0]['forTestinomial'] ? 'checked' : '' ?>>
              <label class="form-check-label" for="testimonial_no">No</label>
            </div>
          </div>

          <div class="form-group">
            <label for="session_type" class="text-dark">Select Session Type:</label>
            <select class="form-control" name="session_type" id="session_type" required>
              <option value="" disabled selected>-- Select Session --</option>
              <option value="flaabh" <?= $getAllEventsResult[0]['sessionType'] === 'flaabh' ? 'selected' : '' ?>>FLAABH™ Fit</option>
              <option value="Soundhealing" <?= $getAllEventsResult[0]['sessionType'] === 'Soundhealing' ? 'selected' : '' ?>>Sound Healing</option>
              <option value="Retreat" <?= $getAllEventsResult[0]['sessionType'] === 'Retreat' ? 'selected' : '' ?>>Retreat</option>>
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