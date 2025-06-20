<?php
include 'includes/load.php';

$getPayementId = $conn->prepare("SELECT * FROM bookedevent ORDER BY id DESC LIMIT 1");
$getPayementId->execute();
$payment_ids = $getPayementId->fetchAll();


$payment_id = $payment_ids[0]['payment_id'];
?>
<a href="refund.php?payment_id=<?= $payment_id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to refund this payment?');">
    Refund
</a>
