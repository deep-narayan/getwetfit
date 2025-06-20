<?php
include './layouts/dashboardheader.php';
require_once 'mail_helper.php'; // Include the function

$role = $_SESSION['role'];
if ($role !== 'admin') {
    redirect("logout.php");
}

$getUsers = $conn->prepare("SELECT email FROM login"); // Optional: only verified users
$getUsers->execute();
$allUsers = $getUsers->fetchAll(PDO::FETCH_ASSOC);




if (isset($_POST['submit'])) {
    $state = $_POST['state'];
    $city = $_POST['city'];
    $venue =  $_POST['venue'];
    $session_type = $_POST['session_type'];
    $level = $_POST['level'];
    $time = $_POST['time'];
    $slot = $_POST['slot'];
    $contact = $_POST['contact'];
    $date = $_POST['date'];
    $price = $_POST['price'];
    $seats = $_POST['seats'];
    $is_special = "";
    if($_POST['special_event'] == "No"){
        $is_special = 0;
    }else{
        $is_special = 1;
    }

    // === Image Upload & WebP Conversion ===
    $targetDir = "upcomingsEventsImages/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    $fileTmp = $_FILES["image"]["tmp_name"];
    $fileName = pathinfo($_FILES["image"]["name"], PATHINFO_FILENAME);
    $fileExt = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
    $allowedTypes = ['jpg', 'jpeg', 'png', 'webp'];

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
        // echo "<script>alert('Image Uploaded Successfully')</script>";
        $upcomingEventsQuery = $conn->prepare("INSERT INTO upcomingEvents(type, level, imageUrl, contact, date, isSpecialEvent, state, city, time, slot,addPlace, price, seats) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $upcomingEventsQuery->execute([$session_type, $level, $targetWebpPath, $contact,$date, $is_special, $state, $city, $time, $slot,$venue, $price,$seats ]);

        $subject = "🚀 New Upcoming Session Alert - GetWetFit";

        $body = "
        <div style='font-family: Arial, sans-serif; color: #333; padding: 20px; background-color: #f7f9fa; border-radius: 8px;'>
            <h2 style='color: #16B2FD;'>A New Session is Live!</h2>
            <p>Dear Member,</p>
            <p>We’re excited to inform you that a new <strong>$session_type</strong> session has just been scheduled.</p>
            <p>Don’t miss the opportunity to reserve your spot and continue your fitness journey with us.</p>
            
            <div style='margin: 30px 0; text-align: center;'>
            <a href='https://getwetfit.com/gallery_events.php' 
                style='display: inline-block; padding: 12px 24px; background-color: #16B2FD; color: #fff; text-decoration: none; border-radius: 30px; font-weight: bold;'>
                View Upcoming Sessions
            </a>
            </div>

            <p>Warm regards,<br>The GetWetFit Team</p>
        </div>
        ";

        foreach ($allUsers as $user) {
            $email = $user['email'];
            sendCustomMail($email, $subject, $body);
        }

        echo "<script>alert('Event Added Successfully')</script>";
    } else {
        echo "❌ Conversion to WebP failed.";
    }

    // You can now insert all data including $country, $state, $city into your database here.
}
?>

<main id="content" >
<nav aria-label="breadcrumb" class="mt-5">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="admin_dashboard.php">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Add Session Details</li>
    </ol>
</nav>
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
                
                <div class="form-group col-md-6">
                    <label for="venue">Venue:</label>
                    <select class="form-control" id="venue" name="venue" required>
                        <option disabled selected value="">-- Select Venue --</option>
                        <option value="Crowne Plaza, Rohini, Delhi">Crowne Plaza, Rohini, Delhi</option>
                        <option value="Wellness Club, Shangri-la Eros">Wellness Club, Shangri-la Eros</option>
                        <option value="Central Park Resorts, Sector-48, Sohna Road, Gurgaon">Central Park Resorts, Sector-48, Sohna Road, Gurgaon</option>
                        <option value="The Westin, Mehrauli Road, Gurgaon">The Westin, Mehrauli Road, Gurgaon</option>
                    </select>
                </div>


                <div class="form-group">
                    <label for="session_type">Session Type:</label>
                    <select class="form-control" id="session_type" name="session_type" required>
                        <option disabled selected value="">-- Select Session Type --</option>
                        <option value="FLAABH™ FIT">FLAABH™ Fit</option>
                        <option value="FLAABH™ HEAL">FLAABH™ Heal</option>
                        <option value="WELLNESS RETREAT">Wellness Retreat</option>>
                    </select>
                </div>

                <div class="form-group">
                    <label>Level:</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="level" value="beginner" required>
                        <label class="form-check-label">Beginner</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="level" value="advanced">
                        <label class="form-check-label">Advanced</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="image">Upload Image:</label>
                    <input type="file" class="form-control-file" id="image" name="image" required>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="time">Time:</label>
                        <input type="time" class="form-control" id="time" name="time" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="slot">Slot:</label>
                        <select class="form-control" id="slot" name="slot" required>
                            <option disabled selected value="">-- Select Slot --</option>
                            <option value="Slot 1: 50-60 min (FLAABH FIT)">Slot 1: 50-60 min (FLAABH FIT)</option>
                            <option value="Slot 1: 50-75 min (FLAABH HEAL)">Slot 1: 50-75 min (FLAABH HEAL)</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="contact">Contact:</label>
                    <input type="tel" class="form-control" id="contact" name="contact" required>
                </div>

                <div class="form-group">
                    <label for="date">Date:</label>
                    <input type="date" class="form-control" id="date" name="date" required>
                </div>

                <div class="form-group">
                    <label>Is This a Special Event?</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="special_event" value="Yes" required>
                        <label class="form-check-label">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="special_event" value="No">
                        <label class="form-check-label">No</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="price">Price (Including GST*)</label>
                    <input type="text" class="form-control" placeholder="Add price" name="price" required />
                </div>
                <div class="form-group">
                    <label for="seats">Seats</label>
                    <input type="text" class="form-control" placeholder="add seats" name="seats" required />
                </div>

                <button type="submit" name="submit" class="btn btn-success btn-block">Submit</button>
            </form>
        </div>
    </div>
</div>
</main>

<!-- Country-State-City Script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
  const country = "India";

  // Load states of India
  $.ajax({
    url: 'https://countriesnow.space/api/v0.1/countries/states',
    method: 'POST',
    contentType: 'application/json',
    data: JSON.stringify({ country: country }),
    success: function(response) {
      $('#state').html('<option value="">Select State</option>');
      response.data.states.forEach(function(state) {
        $('#state').append('<option value="' + state.name + '">' + state.name + '</option>');
      });
    }
  });

  // Load cities when state is selected
  $('#state').change(function() {
    const state = $(this).val();
    $('#city').html('<option>Loading...</option>');
    $.ajax({
      url: 'https://countriesnow.space/api/v0.1/countries/state/cities',
      method: 'POST',
      contentType: 'application/json',
      data: JSON.stringify({ country: country, state: state }),
      success: function(response) {
        $('#city').html('<option value="">Select City</option>');
        response.data.forEach(function(city) {
          $('#city').append('<option value="' + city + '">' + city + '</option>');
        });
      }
    });
  });
});
</script>


<?php include './layouts/dashboardfooter.php'; ?>
