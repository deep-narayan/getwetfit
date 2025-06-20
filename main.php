<?php
include './layouts/dashboardheader.php';

$role = $_SESSION['role'];
if ($role !== 'user') {
    redirect("logout.php");
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
<nav aria-label="breadcrumb" class="mt-5">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="main.php">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
  </ol>
</nav>
  <?php
    include "./includes/upcomingEvents/dashboardUpcomingEvents.php";
  ?>

  <?php
    include "./includes/calendar/dashboardCalendar.php";
  ?>
</main>


<?php
include './layouts/dashboardfooter.php'
?>