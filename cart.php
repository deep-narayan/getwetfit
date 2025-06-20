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

    $cartDetails = $conn->prepare("SELECT * FROM carts WHERE user_id = ? AND isBooked = 0");
    $cartDetails->execute([$userId]);
    $cartItems = $cartDetails->fetchAll();

    $eventsRes = [];
    $totalAmount = 0;

    foreach ($cartItems as $cartItem) {
        $eventId = $cartItem['event_id'];
        $cartId = $cartItem['id'];

        $eventStmt = $conn->prepare("SELECT * FROM upcomingEvents WHERE id = ?");
        $eventStmt->execute([$eventId]);
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
        //floor($totalAmount/1000)*1000;
        
        
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
                        Time: <?= htmlspecialchars($event['slot']) ?> :
                        <?= date("g:i A", strtotime($event['time'] ?? '07:00:00')) ?>
                    </div>
                    <p class="mb-1"><?= date('jS M Y', strtotime($event['date'])) ?></p>
                    <p class="mb-1">Contact: <?= htmlspecialchars($event['contact'] ?? 'N/A') ?></p>
                    <p class="mb-0">Location: <?= htmlspecialchars($event['state']) . " " . htmlspecialchars($event['city']) ?>.</p>
                    <p class="mb-0 font-weight-bold text-success">
                        Price: ₹<?= htmlspecialchars($event['price']) ?> × <?= $event['count'] ?> = ₹<?= number_format($event['price'] * $event['count'], 2) ?>
                    </p>
                    <hr>
                    <div class="d-flex align-items-center">
                      <?php if($event['count'] > 0) :?>
                        <a href="delete_cart.php?id=<?= $event['cart_ids'][0] ?>" class="btn btn-outline-primary btn-sm font-weight-bold">
                          Remove
                        </a>
                        <button class="btn btn-outline-secondary btn-sm font-weight-bold rounded-left px-3 m-2">
                           <?= $event['count'] ?>
                           
                        </button>
                        <?php endif; ?>
                        <?php
                            $eventSeats = $event['seats'];
                            if ($event['count'] >= $eventSeats): ?>
                                <span class="text-danger font-weight-bold">No more seats</span>
                        <?php else: ?>
                            <a href="add_cart.php?id=<?= $event['id'] ?>&type=<?= urlencode("cart") ?>" class="btn btn-outline-primary btn-sm font-weight-bold">
                                Add
                            </a>
                        <?php endif; ?>

                    </div>
                    
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="text-white text-center w-100">
                <h5>Cart Empty.</h5>
            </div>
        <?php endif; ?>
    </div>

    <?php if (!empty($eventsRes)): ?>
        <div class="card mt-4 shadow-sm">
            <div class="card-header bg-secondary text-white font-weight-bold">
                Booking Summary
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush mb-3">
                    <?php
                    $count = 1;
                    $eventsIds = [];
                    $resEventsData = [];
                    $totalEventCount = 0;
                    ?>
                    <?php foreach ($eventsRes as $event): ?>
                        <?php
                        $eventsIds[] = $event['id'];
                        $resEventsData[] = [
                            'event_id' => $event['id'],
                            'count' => $event['count'],
                            'price' => $event['price'],
                            'cart_ids' => $event['cart_ids'],
                        ];
                        $totalEventCount += $event['count'];
                        ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Event <?= $count++ ?> (<?= htmlspecialchars($event['type']) ?> × <?= $event['count'] ?>)
                            <span class="text-success font-weight-bold">
                                ₹<?= number_format($event['price'] * $event['count'], 2) ?>
                            </span>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <?php
                if($totalEventCount > 1){
                    $totalAmounts = floor($totalAmount/1000)*1000;
                }else{
                    $totalAmounts = $totalAmount;
                }
                
                $resEventsIds = implode(',', $eventsIds);
                $resEventsDataJSON = htmlspecialchars(json_encode($resEventsData));
                ?>
                <hr>
                <div class="d-flex justify-content-between align-items-center">
                    <strong class="text-dark">Total Amount</strong>
                    <h5 class="text-primary font-weight-bold mb-0">₹<?= number_format($totalAmounts, 2) ?></h5>
                </div>
            </div>

            <div class="card-footer text-right bg-light">
                <form action="checkout.php" method="POST">
                    <input type="hidden" name="user_id" value="<?= $userId ?>">
                    <input type="hidden" name="user_name" value="<?= $userName ?>">
                    <input type="hidden" name="user_contact" value="<?= $userContact ?>">
                    <input type="hidden" name="user_email" value="<?= $userEmail ?>">
                    <input type="hidden" name="events_data" value="<?= $resEventsDataJSON ?>">
                    <input type="hidden" name="total_amount" value="<?= htmlspecialchars($totalAmounts) ?>">
                    <button type="submit" class="btn btn-primary px-4 font-weight-bold" id="rzp-button1">
                        Proceed to Payment
                    </button>
                </form>
            </div>
        </div>
    <?php endif; ?>
</main>


<?php include 'layouts/dashboardfooter.php'; ?>
