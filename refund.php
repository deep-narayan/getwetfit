<?php
include "includes/load.php";

$role = $_SESSION['role'];
if (!$session->isUserLoggedIn()) {
    redirect("login.php");
}
if ($role !== 'admin') {
    redirect("logout.php");
}

$key_id = 'rzp_live_eCwgKJkBk1CeL4';
$secret = '0yzwchEEvMlHDqmx1J7NxTAy';

if (!isset($_POST['event_id']) || empty($_POST['event_id'])) {
    redirect('booked_event_reports.php');
}
$id = $_POST['event_id'];
$reason = $_POST['reason'];


$getEventIds = $conn->prepare("SELECT * FROM bookedevent WHERE id = ?");
$getEventIds->execute([$id]);
$getEventIdsRes = $getEventIds->fetchAll();

$payment_id = $getEventIdsRes[0]['payment_id'];
$user_id = $getEventIdsRes[0]['user_id'];


// Call Razorpay Refund API
$ch = curl_init("https://api.razorpay.com/v1/payments/$payment_id/refund");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, $key_id . ':' . $secret);
curl_setopt($ch, CURLOPT_POST, true);

$response = curl_exec($ch);
curl_close($ch);
$result = json_decode($response, true);


if(isset($result['id'])){
    
    $amount = $result['amount']/100;
    $status = $result['status'];
    $createdAt = $result['created_at'];
    $refundedAt = $user_id; // Set current datetime for refunded_at

    $refundquery = $conn->prepare("
        INSERT INTO refunds (
            booking_id, refund_id, amount, status, reason, refunded_at, created_at, date
        ) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())
    ");

    $refundquery->execute([
        $id,              // booking_id
        $result['id'],    // refund_id
        $amount,          // amount
        $status,          // status
        $reason,          // reason
        $refundedAt,      // refunded_at (correct datetime format)
        $createdAt        // created_at
    ]);


    $session->flashMessage("Pass", "Refund Successfully!");
    redirect("manage_refund.php");

}
 else {
    print_r($result);

if (isset($result['error']) && isset($result['error']['description'])) {
    $description = $result['error']['description'];
    $session->flashMessage("Fail", $description);
    redirect('booked_event_reports.php');
} else {
    $session->flashMessage("Fail", "Something went wrong.");
    redirect('booked_event_reports.php');
}

}
?>
