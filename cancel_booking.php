<?php
include 'db.php';
session_start();

if(isset($_GET['id'])){

    $booking_id = $_GET['id'];

    $query = "DELETE FROM bookings WHERE booking_id = $booking_id";
    mysqli_query($conn, $query);
}

header("Location: my_bookings.php");
exit();
?>