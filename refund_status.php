<?php
include 'layouts/dashboardheader.php';


$role = $_SESSION['role'];
if ($role !== 'admin') {
    redirect("logout.php");
}

$key_id = 'rzp_live_eCwgKJkBk1CeL4';
$secret = '0yzwchEEvMlHDqmx1J7NxTAy';

$refund_id = $_POST['event_id'] ?? null;
$razorpayRefund = null;
$errorMessage = null;

if ($refund_id) {
    // Fetch from Razorpay API
    $ch = curl_init("https://api.razorpay.com/v1/refunds/$refund_id");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERPWD, $key_id . ':' . $secret);
    $response = curl_exec($ch);
    curl_close($ch);

    $razorpayRefund = json_decode($response, true);

    if (isset($razorpayRefund['error'])) {
        $errorMessage = $razorpayRefund['error']['description'] ?? 'Something went wrong';
    }
} else {
    $errorMessage = "Invalid refund ID.";
}
?>
<main id="content">
<div class="container mt-5">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="manage_refund.php">Back to Reports</a></li>
      <li class="breadcrumb-item active" aria-current="page">Refund Status</li>
    </ol>
  </nav>

  <?php if ($errorMessage): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($errorMessage) ?></div>
  <?php elseif ($razorpayRefund): ?>
    <div class="card shadow border-left-info mb-4">
      <div class="card-header bg-info text-white">Live Refund Details (from Razorpay)</div>
      <div class="card-body">
        <ul class="list-group">
          <li class="list-group-item"><strong>Refund ID:</strong> <?= htmlspecialchars($razorpayRefund['id']) ?></li>
          <li class="list-group-item"><strong>Amount:</strong> ₹<?= htmlspecialchars($razorpayRefund['amount'] / 100) ?></li>
          <li class="list-group-item"><strong>Status:</strong> <?= htmlspecialchars($razorpayRefund['status']) ?></li>
          <li class="list-group-item"><strong>Speed Requested:</strong> <?= htmlspecialchars($razorpayRefund['speed_requested']) ?></li>
          <li class="list-group-item">
            <strong>Processed At:</strong>
            <?= isset($razorpayRefund['processed_at']) && $razorpayRefund['processed_at'] ? date('d-m-Y H:i:s', $razorpayRefund['processed_at']) : 'N/A' ?>
          </li>
          <li class="list-group-item"><strong>Created At:</strong> <?= date('d-m-Y H:i:s', $razorpayRefund['created_at']) ?></li>
        </ul>
      </div>
    </div>
  <?php endif; ?>
</div>
</main>
<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<?php include 'layouts/dashboardfooter.php'; ?>

