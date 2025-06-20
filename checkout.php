<?php
$key_id = 'rzp_live_eCwgKJkBk1CeL4';
$secret = '0yzwchEEvMlHDqmx1J7NxTAy';

$user_id = $_POST['user_id'];
$user_name = $_POST['user_name'];
$user_contact = $_POST['user_contact'];
$user_email = $_POST['user_email'];
$event_data = $_POST['events_data'];
$total_amount = $_POST['total_amount'];

$amount = $total_amount * 100;

$orderData = [
    'receipt' => 'session_' . $user_id,
    'amount' => $amount,
    'currency' => 'INR',
    'payment_capture' => 1
];

// Razorpay Order API
$ch = curl_init('https://api.razorpay.com/v1/orders');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, $key_id . ':' . $secret);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($orderData));

$response = curl_exec($ch);
if (curl_errno($ch)) {
    die('Razorpay Order API Error: ' . curl_error($ch));
}
curl_close($ch);

$order = json_decode($response, true);
$order_id = $order['id'];
?>

<!-- Razorpay Checkout Form -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<form name="razorpayform" id="razorpayform" action="verify_payment.php" method="POST">
  <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
  <input type="hidden" name="razorpay_order_id" id="razorpay_order_id">
  <input type="hidden" name="razorpay_signature" id="razorpay_signature">
  <input type="hidden" name="events_data" value='<?= htmlspecialchars($event_data, ENT_QUOTES) ?>'>
  <input type="hidden" name="user_id" value='<?= htmlspecialchars($user_id) ?>'>
</form>

<script>
var options = {
    "key": "<?= $key_id ?>",
    "amount": "<?= $amount ?>",
    "currency": "INR",
    "name": "GetWetFit",
    "description": "Session Booking",
    "order_id": "<?= $order_id ?>",
    "handler": function (response){
        document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
        document.getElementById('razorpay_order_id').value = response.razorpay_order_id;
        document.getElementById('razorpay_signature').value = response.razorpay_signature;
        document.getElementById('razorpayform').submit();
    },
    "prefill": {
        "name": "<?= $user_name ?>",
        "email": "<?= $user_email?>",
        "contact": "<?= $user_contact?>"
    },
    "theme": {
        "color": "#3399cc"
    }
};

window.onload = function() {
    rzp1 = new Razorpay(options);
    rzp1.open();
};
</script>

