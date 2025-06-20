<?php
$email = $_SESSION['email'];

// Get user ID
$getUser = $conn->prepare("SELECT * FROM LOGIN WHERE email = ?");
$getUser->execute([$email]);
$user = $getUser->fetchAll();
$user_id = $user[0]['id'];


$bookeeventQuery = $conn->prepare("SELECT * FROM bookedevent WHERE user_id = ?");
$bookeeventQuery->execute([$user_id]);
$getAllEvents = $bookeeventQuery->fetchAll();

foreach ($getAllEvents as $allEvents) {
    $events = json_decode($allEvents['event_ids'], true);

    foreach ($events as $eventDetails) {
        // ✅ Mark all carts as booked
        foreach ($eventDetails['cart_ids'] as $cartId) {
            $updateCart = $conn->prepare("UPDATE carts SET isBooked = 1 WHERE id = ?");
            $updateCart->execute([$cartId]);
        }
    }
}







$today = date('Y-m-d');

// Get filters from URL (GET method)
$city = $_POST['city'] ?? '';
$type = $_POST['type'] ?? '';
$level = $_POST['level'] ?? '';

// Build dynamic SQL with filters
$sql = "SELECT * FROM upcomingEvents WHERE date >= :today AND isSpecialEvent = 0";
$params = [':today' => $today];

if (!empty($city)) {
    $sql .= " AND city = :city";
    $params[':city'] = $city;
}
if (!empty($type)) {
    $sql .= " AND type = :type";
    $params[':type'] = $type;
}
if (!empty($level)) {
    $sql .= " AND level = :level";
    $params[':level'] = $level;
}

$sql .= " ORDER BY date ASC";

$stmt = $conn->prepare($sql);
$stmt->execute($params);
$result = $stmt->fetchAll();
?>

<div class="events-calendar fade-in">
    <div class="d-flex justify-content-center align-items-center gap-2 text-center my-4">
        <i class="fa-regular fa-circle-dot text-white fs-4" style="color: #16B2FD !important;"></i>
        <h2 class="tagline m-0" style="color: #FCFCFC;">Upcoming <span style="color:#16B2FD;">Events</span></h2>
        <i class="fa-solid fa-arrow-right rotated-arrow text-white fs-4"></i>
    </div>

    <form class="form-row align-items-end mb-4" method="POST" id="filterForm">
        <!-- State Dropdown -->
        <div class="col-md-2">
            <label for="state" class="text-white">State</label>
            <select id="state" class="form-control">
                <option value="">Select State</option>
            </select>
        </div>

        <!-- City Dropdown (filters on submit) -->
        <div class="col-md-2">
            <label for="city" class="text-white">City</label>
            <select id="city" name="city" class="form-control">
                <option value="">Select City</option>
            </select>
            <input type="hidden" id="selectedCity" name="city" value="<?= htmlspecialchars($city) ?>">
        </div>

        <!-- Type -->
        <div class="col-md-2">
            <label for="type" class="text-white">Type</label>
            <select class="form-control" name="type" id="type">
                <option value="">All Types</option>
                <option value="FLAABH™ Fit" <?= $type == 'FLAABH™ Fit' ? 'selected' : '' ?>>FLAABH™ Fit</option>
                <option value="Sound Healing" <?= $type == 'Sound Healing' ? 'selected' : '' ?>>Sound Healing</option>
                <option value="Retreat" <?= $type == 'Retreat' ? 'selected' : '' ?>>Retreat</option>
            </select>
        </div>

        <!-- Level -->
        <div class="col-md-2">
            <label for="level" class="text-white">Level</label>
            <select class="form-control" name="level" id="level">
                <option value="">All Levels</option>
                <option value="beginner" <?= $level == 'beginner' ? 'selected' : '' ?>>Beginner</option>
                <option value="advanced" <?= $level == 'advanced' ? 'selected' : '' ?>>Advanced</option>
            </select>
        </div>

        <!-- Filter Button -->
        <div class="col-md-2">
            <label class="d-block">&nbsp;</label>
            <button type="submit" class="btn btn-secondary btn-block">Filter</button>
        </div>
    </form>


    <!-- Events List -->
    <div class="calendar row g-4">
        <?php if (count($result) > 0): ?>
            <?php foreach ($result as $resultValue): ?>
                <div class="calendar-event col-12 col-sm-6 col-md-3 slide-in-left pb-3">
                    <div>
                        <?php
                            $image = $resultValue['imageUrl'] ?? '';
                            $defaultImage = './assets/images/image1.webp';

                            // If it's a valid URL or local path, use it; otherwise, fallback to default
                            $finalImage = (!empty($image)) ? $image : $defaultImage;

                            $cartQuery = $conn->prepare("SELECT * FROM carts WHERE user_id = ? AND event_id = ? AND isBooked = 0");
                            $cartQuery->execute([$user_id, $resultValue['id']]);
                            $cartResult = $cartQuery->fetch();
                            $count = $cartQuery->rowCount();


                        ?>

                        <img src="<?= htmlspecialchars($finalImage) ?>" alt="Event Image" loading="lazy" class="img-fluid mb-2">
                    </div>
                    <h6><?= htmlspecialchars($resultValue['type'] ?? ' ') ?></h6>
                    <div class="event-date mb-1">
                        Time: <?= htmlspecialchars($resultValue['slot'] ?? ' ') ?> : 
                        <?= date("g:i A", strtotime($resultValue['time'] ?? '07:00:00')) ?>
                    </div>
                    <p class="mb-1">Seats Available : <?= htmlspecialchars($resultValue['seats'] ?? 'N/A') ?></p>
                    <p class="mb-1">price : <?= htmlspecialchars($resultValue['price'] ?? 'N/A') ?>(Including GST*)</p>
                    <p class="mb-1"><?= date('jS M Y', strtotime($resultValue['date'])) ?></p>
                    <p class="mb-1">Contact: <?= htmlspecialchars($resultValue['contact'] ?? 'N/A') ?></p>
                    <p class="mb-0">Location: <?= htmlspecialchars($resultValue['state'] ?? ' ') . " " . htmlspecialchars($resultValue['city'] ?? ' ') . " " . htmlspecialchars($resultValue['addPlace'] ?? ' ') ?>.</p>
                    <hr>
                    <?php if($count > 0) :?>
                    <div class="d-flex align-items-center">
                        <button class="btn btn-outline-secondary btn-sm font-weight-bold rounded-left px-3 mr-2">
                            +<?= $count ?>
                        </button>
                        <a href="add_cart.php?id=<?= $resultValue['id'] ?>" 
                            class="btn btn-outline-primary btn-sm font-weight-bold rounded-right px-4">
                            Add
                        </a>
                    </div>
                    <?php else: ?>
                    <a href="add_cart.php?id=<?= $resultValue['id'] ?>" class="btn btn-outline-primary btn-sm font-weight-bold">Add to Cart</a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="text-white text-center w-100">
                <h5>No upcoming events available.</h5>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- JS for State/City API -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    const country = "India";

    // Load States
    $.ajax({
        url: 'https://countriesnow.space/api/v0.1/countries/states',
        method: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({ country }),
        success: function (response) {
            $('#state').html('<option value="">Select State</option>');
            response.data.states.forEach(function (state) {
                $('#state').append('<option value="' + state.name + '">' + state.name + '</option>');
            });
        }
    });

    // Load Cities
    $('#state').change(function () {
        const state = $(this).val();
        $('#city').html('<option>Loading...</option>');
        $.ajax({
            url: 'https://countriesnow.space/api/v0.1/countries/state/cities',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ country, state }),
            success: function (response) {
                $('#city').html('<option value="">Select City</option>');
                response.data.forEach(function (city) {
                    $('#city').append('<option value="' + city + '">' + city + '</option>');
                });
            }
        });
    });

    // When city is selected, set it in hidden input so it submits via GET
    $('#city').change(function () {
        const selectedCity = $(this).val();
        $('#selectedCity').val(selectedCity);
    });
});
</script>
