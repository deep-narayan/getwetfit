<?php
include 'includes/load.php';
include 'mail_helper.php';

$secret = '0yzwchEEvMlHDqmx1J7NxTAy';
$key_id = 'rzp_live_eCwgKJkBk1CeL4';

$razorpay_payment_id = $_POST['razorpay_payment_id'];
$razorpay_order_id = $_POST['razorpay_order_id'];
$razorpay_signature = $_POST['razorpay_signature'];

$user_id = $_POST['user_id'];
$events = $_POST['events_data'];

$user_email = $_SESSION['email'];

// Correct Signature Verification
$generated_signature = hash_hmac('sha256', $razorpay_order_id . "|" . $razorpay_payment_id, $secret);

if ($generated_signature === $razorpay_signature) {
    // Insert payment details

    // ✅ Fetch full payment details from Razorpay
    $ch = curl_init("https://api.razorpay.com/v1/payments/$razorpay_payment_id");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERPWD, $key_id . ':' . $secret);
    $response = curl_exec($ch);
    curl_close($ch);

    $payment = json_decode($response, true);

    // Extract method and extra info (based on method type)
    $method = $payment['method']; // upi, card, netbanking, etc.

    // Optional details
    $vpa = $payment['upi']['vpa'] ?? null;
    $card_type = $payment['card']['type'] ?? null;
    $card_network = $payment['card']['network'] ?? null;
    $status = $payment['status']; // captured, failed, refunded
    $amount = $payment['amount'];

    $insertBooke = $conn->prepare("
        INSERT INTO bookedevent(user_id, event_ids, payment_id, order_id, method, card_type, status, amount, currency)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $insertBooke->execute([
        $user_id, $events, $razorpay_payment_id, $razorpay_order_id,
        $method, $card_type, $status, $amount, 'INR'
    ]);

    $eventsData = json_decode($events, true);
    foreach ($eventsData as $eventDetails) {
        $eventId = $eventDetails['event_id'];
        $count = $eventDetails['count'];

        // ✅ Only reduce seats ONCE per event
        $getEvents = $conn->prepare("SELECT seats FROM upcomingEvents WHERE id = ?");
        $getEvents->execute([$eventId]);
        $getEventsRes = $getEvents->fetch();
        $seats = (int) $getEventsRes['seats'];
        $totalSeats = max(0, $seats - $count);

        $updateEvents = $conn->prepare("UPDATE upcomingEvents SET seats = ? WHERE id = ?");
        $updateEvents->execute([$totalSeats, $eventId]);

    }

   $subject = "✅ Your Session Registration is Confirmed – GetWetFit&Co.";

    $body = "
    <div style='font-family: Arial, sans-serif; color: #333; padding: 24px; background-color: #f4f8fb; border-radius: 10px; line-height: 1.7;'>
        <h2 style='color: #16B2FD; margin-top: 0;'>Registration Confirmed</h2>

        <p>Dear Member,</p>

        <p>Thank you for registering with <strong>GetWetFit&Co.</strong> Your session booking has been successfully confirmed.</p>

        <p>We're thrilled to have you onboard and can’t wait to help you move closer to your health and fitness goals.</p>

        <div style='text-align: center; margin: 35px 0;'>
            <a href='https://getwetfit.com/my-events.php' 
                style='display: inline-block; padding: 14px 30px; background-color: #16B2FD; color: #ffffff; text-decoration: none; border-radius: 30px; font-size: 16px; font-weight: bold;'>
                View My Sessions
            </a>
        </div>

        <p>If you have any questions or need assistance, feel free to reach out to our support team anytime.</p>

        <p style='margin-top: 40px;'>Warm regards,<br><strong>The GetWetFit&Co. Team</strong></p>
    </div>
    ";


    sendCustomMail($user_email, $subject, $body);


    echo "<script>Payment successfull!</script>";
    redirect('main.php');
} else {
    echo "❌ Payment verification failed. Please contact support with Payment ID: $razorpay_payment_id";
}
?>
