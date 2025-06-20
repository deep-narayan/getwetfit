<?php
include 'layouts/dashboardheader.php';
$role = $_SESSION['role'];
if ($role !== 'admin') {
    redirect("logout.php");
}
// Sample values (replace with DB queries)


// Set target year (can be dynamic later)
$year = date('Y');



try {
    // Prepare and execute query to get event count per month
    $stmt = $conn->prepare("
        SELECT MONTH(date) AS month, COUNT(*) AS count
        FROM upcomingEvents
        WHERE YEAR(date) = ?
        GROUP BY MONTH(date)
        ORDER BY MONTH(date)
    ");
    $stmt->execute([$year]);

    // Initialize array with 0 for all 12 months
    $monthlyEvents = array_fill(0, 12, 0); // Index 0 = Jan, 11 = Dec

    // Fill the result from DB
    while ($row = $stmt->fetch()) {
        $monthIndex = (int)$row['month'] - 1; // 0-based index for JavaScript
        $monthlyEvents[$monthIndex] = (int)$row['count'];
    }
} catch (PDOException $e) {
    error_log("Error fetching event data: " . $e->getMessage());
    $monthlyEvents = array_fill(0, 12, 0);
}


?>

<main id="content" class="mt-5">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="admin_dashboard.php">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
    </ol>
  </nav>


  <!-- Stat Cards -->
  <div class="row">
    <div class="col-md-4">
        <div class="card text-white bg-secondary mb-3">
            <div class="card-body">
            <h5 class="card-title">Total Events</h5>
            <?php 
              $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM upcomingEvents");
              $stmt->execute();
              $eventCount = $stmt->fetch()['total'];
            ?>
            <p class="card-text display-4"><?= $eventCount ?></p>
            <a href="manageUpcomingEvents.php" class="btn btn-light btn-sm mt-2">See all events</a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
      <div class="card text-white bg-secondary mb-3">
        <div class="card-body">
          <h5 class="card-title">Total Users</h5>
          <?php 
          $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM login WHERE role != ?");
          $stmt->execute(['admin']);
          $userCount = $stmt->fetch()['total'];
          ?>
          <p class="card-text display-4"><?= $userCount ?></p>
          <a href="manage_user.php" class="btn btn-light btn-sm mt-2">See all users</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card text-white bg-secondary mb-3">
        <div class="card-body">
          <h5 class="card-title">Total Inquiries</h5>
           <?php 
              $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM contactusform");
              $stmt->execute();
              $contactCount = $stmt->fetch()['total'];
            ?>
          <p class="card-text display-4"><?= $contactCount ?></p>
          <a href="user_contact.php" class="btn btn-light btn-sm mt-2">See all inquiries</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Charts Row -->
  <div class="row">
    <!-- Bar Chart -->
    <div class="col-md-6">
      <div class="card mb-4">
        <div class="card-header">Monthly Event Stats</div>
        <div class="card-body">
          <canvas id="eventBarChart" height="200"></canvas>
        </div>
      </div>
    </div>

    <!-- Donut Chart -->
    <div class="col-md-6">
      <div class="card mb-4">
        <div class="card-header">User Distribution</div>
        <div class="card-body">
          <canvas id="userDonutChart" height="200"></canvas>
        </div>
      </div>
    </div>
  </div>
</main>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4"></script>
<script>
  const monthlyData = <?= json_encode($monthlyEvents) ?>;

  const ctxBar = document.getElementById('eventBarChart').getContext('2d');
  new Chart(ctxBar, {
    type: 'bar',
    data: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
      datasets: [{
        label: 'Events',
        data: monthlyData,
        backgroundColor: '#007bff'
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        yAxes: [{
          ticks: { beginAtZero: true }
        }]
      }
    }
  });


  // Donut Chart
  var ctxDonut = document.getElementById('userDonutChart').getContext('2d');
  new Chart(ctxDonut, {
    type: 'doughnut',
    data: {
      labels: ['Admins', 'Members', 'Guests'],
      datasets: [{
        data: [10, 40, 7],
        backgroundColor: ['#28a745', '#17a2b8', '#ffc107']
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: { position: 'bottom' }
    }
  });
</script>

<?php include 'layouts/dashboardfooter.php'; ?>
