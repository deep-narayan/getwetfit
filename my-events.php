<?php
include 'layouts/dashboardheader.php';

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

    $today = date('Y-m-d');
    $cartDetails = $conn->prepare("SELECT * FROM carts WHERE user_id = ? AND isBooked = 1");
    $cartDetails->execute([$userId]);
    $cartItems = $cartDetails->fetchAll();

    $eventsRes = [];
    $totalAmount = 0;

    foreach ($cartItems as $cartItem) {
        $eventId = $cartItem['event_id'];
        $cartId = $cartItem['id'];

        $eventStmt = $conn->prepare("SELECT * FROM upcomingEvents WHERE id = ? AND date >= ?");
        $eventStmt->execute([$eventId,$today]);
        $event = $eventStmt->fetch();

        if ($event) {
            if (!isset($eventsRes[$eventId])) {
                $event['count'] = 1;
                $event['cart_ids'] = [$cartId];
                $eventsRes[$eventId] = $event;
            } else {
                $eventsRes[$eventId]['count']++;
                $eventsRes[$eventId]['cart_ids'][] = $cartId;
            }

            $totalAmount += (float)$event['price'];
        }
    }

} catch (Exception $e) {
    echo "<div class='alert alert-danger'>Something went wrong: " . $e->getMessage() . "</div>";
    exit;
}
?>
<style>
  .rotated-arrow {
    transform: rotate(45deg);
    color: #16B2FD !important;
  }

  .tagline {
    font-weight: 600;
    font-size: 1.6rem;
  }

  .calendar-filters .custom-select {
    background-color: #1b1e23;
    border: 1px solid #2e2e2e;
    color: #16B2FD;
  }

  .calendar-filters .custom-select:focus {
    outline: none;
    box-shadow: none;
    border-color: #16B2FD;
  }

  .calendar-filters .btn {
    background: #16B2FD;
    border: none;
    color: #000;
    font-weight: 600;
  }

  .calendar-event {
    background: rgba(19, 21, 25, 0.5);
    border-radius: 10px;
    padding: 1rem;
    color: #FCFCFC;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    transition: transform 0.2s ease;
    margin-bottom: 1.5rem;
  }

  .calendar-event:hover {
    transform: translateY(-5px);
  }

  .calendar-event img {
    border-radius: 8px;
    width: 100%;
    object-fit: cover;
    height: 180px;
  }

  .calendar-event h6 {
    color: #16B2FD;
    margin-top: 10px;
    font-weight: 600;
  }

  .calendar-event p,
  .calendar-event .event-date {
    font-size: 0.95rem;
  }

  .calendar-event hr {
    border-color: rgba(255, 255, 255, 0.1);
  }
</style>
<main id="content">
    <div class="d-flex justify-content-center align-items-center gap-2 text-center my-4">
        <i class="fa-regular fa-circle-dot text-white fs-4" style="color: #16B2FD !important;"></i>
        <h2 class="tagline m-0" style="color: #FCFCFC;"><span style="color:#16B2FD;">Your</span> Upcoming <span style="color:#16B2FD;">Events</span></h2>
        <i class="fa-solid fa-arrow-right rotated-arrow text-white fs-4"></i>
    </div>
    <div class="calendar row g-4">
        <?php if (!empty($eventsRes)): ?>
            <?php foreach ($eventsRes as $event): ?>
                <div class="calendar-event col-12 col-sm-6 col-md-3 slide-in-left pb-3">
                    <div>
                        <?php
                        $image = $event['imageUrl'] ?? '';
                        $defaultImage = './assets/images/image1.webp';
                        $finalImage = (!empty($image)) ? $image : $defaultImage;
                        ?>
                        <img src="<?= htmlspecialchars($finalImage) ?>" alt="Event Image" class="img-fluid mb-2">
                    </div>
                    <h6>
                        <?= htmlspecialchars($event['type']) ?>
                        <span class="badge badge-info">x<?= $event['count'] ?></span>
                    </h6>
                    <div class="event-date">
                        <?= htmlspecialchars($event['slot']) ?> <br/>Time: 
                        <?= date("g:i A", strtotime($event['time'] ?? '07:00:00')) ?>
                    </div>
                    <p class="mb-1"><?= date('jS M Y', strtotime($event['date'])) ?></p>
                    <p class="mb-1">Contact: <?= htmlspecialchars($event['contact'] ?? 'N/A') ?></p>
                    <p class="mb-0">Location: <?= htmlspecialchars($event['state']) . " " . htmlspecialchars($event['city']) ?>.</p>
                    <p class="mb-0 font-weight-bold text-success">
                        Total Seats Booked : <?= $event['count'] ?>
                    </p>
                    <hr>
                    <p class="mb-0 font-weight-bold text-success text-center">
                        <a href="#" class="btn btn-sm btn-outline-primary">
                            Download Invoice
                        </a>
                    </p>

                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="text-white text-center w-100">
                <h5>No  events.</h5>
            </div>
        <?php endif; ?>
    </div>
</main>


<?php include 'layouts/dashboardfooter.php'; ?>
