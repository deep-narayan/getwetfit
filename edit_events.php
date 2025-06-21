<?php
include './layouts/dashboardheader.php';
$role = $_SESSION['role'];
if ($role !== 'admin') {
    redirect("logout.php");
}

$id = isset($_GET['id'])? $_GET['id']:redirect('manageUpcomingEvents.php');

$getAllEvents = $conn->prepare("SELECT * FROM upcomingEvents WHERE id = ?");
$getAllEvents->execute([$id]);
$getAllEventsResult = $getAllEvents->fetchAll();




if (isset($_POST['submit'])) {
    $state = $_POST['state'];
    $city = $_POST['city'];
    $session_type = $_POST['session_type'];
    $level = $_POST['level'];
    $time = $_POST['time'];
    $slot = $_POST['slot'];
    $contact = $_POST['contact'];
    $date = $_POST['date'];
    $placeName = $_POST['venue'];
    $price = $_POST['price'];
    $seats = $_POST['seats'];
    $is_special = ($_POST['special_event'] === "Yes") ? 1 : 0;

    // Default to existing image
    $imageUrl = $getAllEventsResult[0]['imageUrl'];

    // Only process if a new image is uploaded
    if (!empty($_FILES['image']['name'])) {
        $targetDir = "upcomingsEventsImages/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $fileTmp = $_FILES["image"]["tmp_name"];
        $fileName = pathinfo($_FILES["image"]["name"], PATHINFO_FILENAME);
        $fileExt = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
        $allowedTypes = ['jpg', 'jpeg', 'png', 'webp']; // lowercase only

        if (!in_array($fileExt, $allowedTypes)) {
            die("Only JPG, JPEG, PNG, and WebP files are allowed.");
        }

        $safeName = preg_replace('/[^a-zA-Z0-9_-]/', '_', $fileName);
        $webpFileName = time() . "_" . $safeName . ".webp";
        $targetWebpPath = $targetDir . $webpFileName;

        switch ($fileExt) {
            case 'jpg':
            case 'jpeg':
                $image = imagecreatefromjpeg($fileTmp);
                break;
            case 'png':
                $image = imagecreatefrompng($fileTmp);
                break;
            case 'webp':
                $image = imagecreatefromwebp($fileTmp);
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


    // Final Update Query
    $upcomingEventsQuery = $conn->prepare("UPDATE upcomingEvents SET type = ?, level = ?, imageUrl = ?, contact = ?, date = ?, isSpecialEvent = ?, state = ?, city = ?, time = ?, slot = ?, addPlace = ?, price = ? , seats=? WHERE id = ?");
    $upcomingEventsQuery->execute([$session_type, $level, $imageUrl, $contact, $date, $is_special, $state, $city, $time, $slot, $placeName,$price, $seats, $id]);

    echo "<script>alert('Event updated successfully.'); window.location.href='manageUpcomingEvents.php';</script>";
}

?>

<main id="content">
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Add Session Details</h4>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">

                <!-- Country, State, City -->
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="state">State:</label>
                        <select id="state" name="state" class="form-control" required>
                        <option value="">Select State</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="city">City:</label>
                        <select id="city" name="city" class="form-control" required>
                        <option value="">Select City</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="session_type">Add Hotel Name / Place</label>
                    <input type="text" class="form-control" placeholder="place name" name="placeName" value="<?= htmlspecialchars($getAllEventsResult[0]['addPlace']) ?>" required />
                </div>

                <div class="form-group col-md-6">
                    <label for="venue">Venue:</label>
                    <select class="form-control" id="venue" name="venue" required>
                        <option disabled selected value="">-- Select Venue --</option>
                        <option value="Crowne Plaza, Rohini, Delhi"  <?= $getAllEventsResult[0]['addPlace'] === 'Crowne Plaza, Rohini, Delhi' ? 'selected' : '' ?>>Crowne Plaza, Rohini, Delhi</option>
                        <option value="Wellness Club, Shangri-la Eros" <?= $getAllEventsResult[0]['addPlace'] === 'Wellness Club, Shangri-la Eros' ? 'selected' : '' ?>>Wellness Club, Shangri-la Eros</option>
                        <option value="Central Park Resorts, Sector-48, Sohna Road, Gurgaon" <?= $getAllEventsResult[0]['addPlace'] === 'Central Park Resorts, Sector-48, Sohna Road, Gurgaon' ? 'selected' : '' ?>>Central Park Resorts, Sector-48, Sohna Road, Gurgaon</option>
                        <option value="The Westin, Mehrauli Road, Gurgaon" <?= $getAllEventsResult[0]['addPlace'] === 'The Westin, Mehrauli Road, Gurgaon' ? 'selected' : '' ?>>The Westin, Mehrauli Road, Gurgaon</option>
                    </select>
                </div>
    
                <div class="form-group">
                    <label for="session_type">Session Type:</label>
                    <select class="form-control" id="session_type" name="session_type" required>
                        <option disabled selected value="">-- Select Session Type --</option>
                        <option value="FLAABH™ Fit" <?= $getAllEventsResult[0]['type'] === 'FLAABH™ Fit' ? 'selected' : '' ?>>FLAABH™ Fit</option>
                        <option value="Sound Healing" <?= $getAllEventsResult[0]['type'] === 'Sound Healing' ? 'selected' : '' ?>>Sound Healing</option>
                        <option value="Retreat" <?= $getAllEventsResult[0]['type'] === 'Retreat' ? 'selected' : '' ?>>Retreat</option>

                    </select>
                </div>

                <div class="form-group">
                    <label>Level:</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="level" value="beginner"<?= $getAllEventsResult[0]['level'] == 'beginner' ? 'checked' : '' ?> required>
                        <label class="form-check-label">Beginner</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="level" value="advanced" <?= $getAllEventsResult[0]['level'] == 'advanced' ? 'checked' : '' ?>>
                        <label class="form-check-label">Advanced</label>
                    </div>
                </div>
                    <?php if (!empty($getAllEventsResult[0]['imageUrl']) && file_exists($getAllEventsResult[0]['imageUrl'])): ?>
                        <div class="form-group">
                            <label>Existing Image:</label><br>
                            <img src="<?= $getAllEventsResult[0]['imageUrl'] ?>" alt="Current Image" style="max-width: 200px; height: auto; border: 1px solid #ccc;">
                        </div>
                    <?php endif; ?>

                <div class="form-group">
                    <label for="image">Upload Image:</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="time">Time:</label>
                        <input type="time" class="form-control" id="time" name="time" value="<?= htmlspecialchars($getAllEventsResult[0]['time']) ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="slot">Slot:</label>
                        <select class="form-control" id="slot" name="slot" required>
                            <option disabled selected value="">-- Select Slot --</option>
                            <option value="Slot 1: 50-60 min (FLAABH FIT)" <?= $getAllEventsResult[0]['slot'] === 'Slot 1: 50-60 min (FLAABH FIT)' ? 'selected' : '' ?>>Slot 1: 50-60 min (FLAABH FIT)</option>
                            <option value="Slot 1: 50-75 min (FLAABH HEAL)" <?= $getAllEventsResult[0]['slot'] === 'Slot 1: 50-75 min (FLAABH HEAL)' ? 'selected' : '' ?>>Slot 1: 50-75 min (FLAABH HEAL)</option>

                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="contact">Contact:</label>
                    <input type="tel" class="form-control" id="contact" name="contact" value="<?= htmlspecialchars($getAllEventsResult[0]['contact']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="date">Date:</label>
                    <input type="date" class="form-control" id="date" name="date" value="<?= htmlspecialchars($getAllEventsResult[0]['date']) ?>" required>
                </div>

                <div class="form-group">
                    <label>Is This a Special Event?</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="special_event" value="Yes" <?= $getAllEventsResult[0]['isSpecialEvent'] ? 'checked' : '' ?> required>
                        <label class="form-check-label">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="special_event" value="No" <?= !$getAllEventsResult[0]['isSpecialEvent'] ? 'checked' : '' ?>>
                        <label class="form-check-label">No</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="price">Price (Including GST*)</label>
                    <input type="text" class="form-control" placeholder="Add price" name="price" value="<?= htmlspecialchars($getAllEventsResult[0]['price']) ?>" required />
                </div>
                <div class="form-group">
                    <label for="seats">Seats</label>
                    <input type="text" class="form-control" placeholder="add seats" name="seats" value="<?= htmlspecialchars($getAllEventsResult[0]['date']) ?>" required />
                </div>

                <button type="submit" name="submit" class="btn btn-success btn-block">Update</button>
            </form>
        </div>
    </div>
</div>
</main>

<!-- Country-State-City Script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
  const country = "India";
  const selectedState = "<?= $getAllEventsResult[0]['state'] ?>";
  const selectedCity = "<?= $getAllEventsResult[0]['city'] ?>";

  // Load states
  $.ajax({
    url: "https://countriesnow.space/api/v0.1/countries/states",
    method: "POST",
    contentType: "application/json",
    data: JSON.stringify({ country: country }),
    success: function (response) {
      $('#state').html('<option value="">Select State</option>');
      response.data.states.forEach(function (state) {
        $('#state').append(
          '<option value="' + state.name + '">' + state.name + "</option>"
        );
      });

      // Set previously selected state
      $('#state').val(selectedState).trigger('change');
    }
  });

  // Load cities when state is selected
  $('#state').on('change', function () {
    const state = $(this).val();
    $('#city').html('<option>Loading...</option>');

    $.ajax({
      url: "https://countriesnow.space/api/v0.1/countries/state/cities",
      method: "POST",
      contentType: "application/json",
      data: JSON.stringify({ country: country, state: state }),
      success: function (response) {
        $('#city').html('<option value="">Select City</option>');
        response.data.forEach(function (city) {
          $('#city').append(
            '<option value="' + city + '">' + city + "</option>"
          );
        });

        // Set previously selected city
        $('#city').val(selectedCity);
      }
    });
  });
});
</script>



<?php include './layouts/dashboardfooter.php'; ?>
