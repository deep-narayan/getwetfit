<?php
include './layouts/dashboardheader.php';

$role = $_SESSION['role'];
if ($role !== 'admin') {
    redirect("logout.php");
}

$getId = isset($_GET['id'])?$_GET['id']:"";
$messageValue = "";

if($getId != ""){
    $getNotification  = $conn->prepare("SELECT * FROM notifications WHERE id = ?");
    $getNotification->execute([$getId]);
    $getResult = $getNotification->fetchAll();


    $messageValue = $getResult[0]['message'];
}

$buttonName = $getId != ""?"Update":"Add";

if (isset($_POST['submit'])) {

    if($buttonName == "Add"){
        $notification = $_POST['notificationMessage'];
        $today = date('Y-m-d');

        $queryInsert = $conn->prepare("INSERT INTO notifications(message, date) VALUES(?,?)");
        $queryInsert->execute([$notification, $today]);
    }else{
        $notification = $_POST['notificationMessage'];
        $today = date('Y-m-d');

        $queryInsert = $conn->prepare("UPDATE notifications SET message = ?, date = ? WHERE id = ?");
        $queryInsert->execute([$notification, $today, $getId]);

        redirect('add_notification.php');
    }

    
    
}
?>

<main id="content" >
    <nav aria-label="breadcrumb" class="mt-5">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="admin_dashboard.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Notification</li>
        </ol>
    </nav>
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Add Notification Details</h4>
            </div>
            <div class="card-body">
                <form method="POST">
                    
                    <div class="form-group">
                        <label for="session_type">Add Notification</label>
                        <input type="text" class="form-control" placeholder="Add Notification" name="notificationMessage" value="<?php echo $messageValue?>" required />
                    </div>

                    <button type="submit" name="submit" class="btn btn-success btn-block"><?php echo $buttonName; ?></button>
                </form>
            </div>
        </div>
    </div>

    <?php include 'manage_notification.php';?>
</main>
<?php include './layouts/dashboardfooter.php'; ?>
