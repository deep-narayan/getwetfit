<?php

$today = date('Y-m-d');

// Secure query using bindParam
$calendarQuery = $conn->prepare("SELECT * FROM upcomingEvents WHERE date >= :today ORDER BY id DESC");
$calendarQuery->bindParam(':today', $today);
$calendarQuery->execute();
$result = $calendarQuery->fetchAll();
?>

<div class="container my-4 event-calendar">
    <div class="d-flex justify-content-center align-items-center gap-2 text-center my-4">
        <i class="fa-regular fa-circle-dot text-white fs-4" style="color: #16B2FD !important;"></i>
        <h4 class="tagline m-0" style="color: #FCFCFC;">
            Weekly Class <span style="color:#16B2FD;">Schedule</span>
        </h4>
        <i class="fa-solid fa-arrow-right rotated-arrow text-white fs-4"></i>
    </div>
    <hr>

    <!-- Header Row -->
    <div class="row font-weight-bold text-center d-none d-md-flex">
        <div class="col-md-3" style="color: #FCFCFC;">Class Details</div>
        <div class="col-md-2" style="color: #FCFCFC;">Date</div>
        <div class="col-md-2" style="color: #FCFCFC;">Time</div>
        <div class="col-md-3" style="color: #FCFCFC;">Location</div>
        <div class="col-md-1" style="color: #FCFCFC;">Seats</div>
        <div class="col-md-1" style="color: #FCFCFC;"></div>
    </div>
    <hr class="event-divider d-none d-md-block" style="border-color:#FCFCFC; background-color:#FCFCFC; opacity:1;">
    <?php if (count($result) > 0): ?>
    <?php foreach ($result as $resultValue): ?>
        <div class="row align-items-start text-center mb-4 text-white">
            <div class="col-md-3">
                <small class="d-md-none text-muted">Class Details</small>
                <h5>Session</h5>
                <p class="text-muted"><?= htmlspecialchars($resultValue['type']) ?></p>
            </div>
            <div class="col-md-2">
                <small class="d-md-none text-muted">Date</small>
                <p><?= date('d M Y', strtotime($resultValue['date'])) ?></p>
            </div>
            <div class="col-md-2">
                <small class="d-md-none text-muted">Time</small>
                <p><?= htmlspecialchars($resultValue['slot']) . ' ' . htmlspecialchars($resultValue['time']) ?></p>
            </div>
            <div class="col-md-3">
                <small class="d-md-none text-muted">Location</small>
                <p><?= htmlspecialchars($resultValue['city']) ?></p>
                <p><?= htmlspecialchars($resultValue['addPlace']) ?></p>
            </div>
            <div class="col-md-1">
                <small class="d-md-none text-muted">Seats</small>
                <p><?= htmlspecialchars($resultValue['seats']) ?></p>
            </div>
            <div class="col-md-1">
                <a href="#" class="btn btn-primary btn-sm px-4 py-1 mt-2" style="font-size: 1rem; line-height: 1;">
                    Join
                </a> 
            </div>
        </div>
        <hr class="event-divider" style="border-color:#FCFCFC; background-color:#FCFCFC; opacity:1;">
    <?php endforeach; ?>
    <?php else: ?>
    <div class="text-center text-white my-5">
        <h5>No events currently scheduled.</h5>
    </div>
    <?php endif; ?>
</div>
