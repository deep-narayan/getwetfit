<?php
if (isset($_GET['payment_id'])) {
    $payment_id = $_GET['payment_id'];
    // Save to DB, verify payment, etc.
    echo "Payment Successful! Your payment ID is: " . htmlspecialchars($payment_id);
} else {
    echo "Payment Failed or Cancelled.";
}
?>
