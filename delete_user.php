<?php
include 'includes/load.php';

$id = isset($_GET['id']) ? $_GET['id'] : redirect('manageUpcomingEvents.php');

// Validate that $id is a number
if (!is_numeric($id)) {
    redirect('manageUpcomingEvents.php');
}

// Use prepared statement with bound parameter
$query = $conn->prepare("DELETE FROM LOGIN WHERE id = ?");
$query->execute([$id]);





redirect('manage_user.php');
?>
