<?php
include 'includes/load.php';

$role = $_SESSION['role'];
if ($role !== 'admin') {
    redirect("logout.php");
}

$id = isset($_GET['id']) ? $_GET['id'] : redirect('manageUpcomingEvents.php');

// Validate that $id is a number
if (!is_numeric($id)) {
    redirect('manageUpcomingEvents.php');
}

$getImage = $conn->prepare("SELECT * FROM upcomingEvents WHERE id = ?");
$getImage->execute([$id]);
$result = $getImage->fetchAll();

$imagePath = $result[0]['imageUrl'];

if (file_exists($imagePath)) {
    unlink($imagePath); // deletes the file from server
}
// Use prepared statement with bound parameter
$query = $conn->prepare("DELETE FROM upcomingEvents WHERE id = ?");
$query->execute([$id]);





redirect('manageUpcomingEvents.php');
?>
