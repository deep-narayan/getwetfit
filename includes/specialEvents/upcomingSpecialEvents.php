<?php
include 'includes/config.php';

$today = date('Y-m-d');

// Build dynamic SQL with filters
$sql = "SELECT * FROM upcomingEvents WHERE date >= :today AND isSpecialEvent = 1";
$params = [':today' => $today];

$sql .= " ORDER BY date ASC";

$stmt = $conn->prepare($sql);
$stmt->execute($params);
$result = $stmt->fetchAll();
?>


<div class="container special-events mt-5 zoom-in ">
    <div class="justify-content-start">
        <div class="d-flex justify-content-center align-items-center gap-2 text-center my-4">
            <i class="fa-regular fa-circle-dot text-white fs-4" style="color: #16B2FD !important;"></i>
            <h4 class="tagline m-0" style="color: #FCFCFC;">Upcoming Special <span style="color:#16B2FD;">Events</span></h4>
            <i class="fa-solid fa-arrow-right rotated-arrow text-white fs-4"></i>
        </div>

        <div class="row justify-content-start">
            <?php if (count($result) > 0): ?>
                <?php foreach ($result as $resultValue): ?>
                    <div class="col-md-6 col-lg-4 mb-4 ">
                        <div class="card shadow p-4 border-0 special-event-card h-100 card-overlay">

                            <img src="<?= htmlspecialchars($resultValue['imageUrl']) ?>" alt="">
                            <h3 class="card-title">GetWetFit <?= htmlspecialchars($resultValue['type'] ?? ' ') ?></h3>
                            <p class="event-date text-muted"><?= date('jS M Y', strtotime($resultValue['date'])) ?>  <?= htmlspecialchars($resultValue['slot'] ?? ' ') ?> : 
                            <?= date("g:i A", strtotime($resultValue['time'] ?? '07:00:00')) ?></p>
                            <p class="event-date text-muted"><?= htmlspecialchars($resultValue['city']) ?> <?= htmlspecialchars($resultValue['addPlace']) ?></p>
                            <button class="btn btn-primary w-100 mt-auto">Register Now</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
            <div class="text-white text-center w-100">
                <h5>No special events available.</h5>
            </div>
            <?php endif; ?>

            
        </div>
    </div>
</div>