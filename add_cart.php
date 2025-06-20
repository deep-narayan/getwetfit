<?php
include 'includes/load.php';

$email = $_SESSION['email'];
$id = isset($_GET['id']) ? $_GET['id'] : redirect('manageUpcomingEvents.php');
$type = isset($_GET['type']) ? $_GET['type'] : "";
// Validate that $id is a number
if (!is_numeric($id)) {
    redirect('main.php');
}

$getUser = $conn->prepare("SELECT * FROM LOGIN WHERE email = ?");
$getUser->execute([$email]);
$result = $getUser->fetchAll();

$userId = $result[0]['id'];
$today = date('Y-m-d');

$query = $conn->prepare("INSERT INTO carts(user_id, event_id, date) VALUES(?,?,?)");
$query->execute([$userId, $id,$today ]);

if($type == 'cart'){
    redirect('cart.php');
}

redirect('main.php');
?>
