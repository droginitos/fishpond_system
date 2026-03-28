<?php
include 'db.php';

if(isset($_GET['id'])){

$id = $_GET['id'];

$query = "UPDATE bookings SET status='approved' WHERE booking_id=$id";

mysqli_query($conn,$query);

echo "Booking approved.";

}

?>

<br>
<a href="admin_dashboard.php">Back</a>
