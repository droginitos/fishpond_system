<?php
include 'db.php';

if(isset($_GET['id'])){

$id = $_GET['id'];

$query = "UPDATE bookings SET status='rejected' WHERE booking_id=$id";

mysqli_query($conn,$query);

echo "Booking rejected.";

}

?>

<br>
<a href="admin_dashboard.php">Back</a>
