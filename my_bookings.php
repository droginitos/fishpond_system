<?php
include 'db.php';
session_start();

$user_id = $_SESSION['user_id'];

// Fetch all bookings including cancelled or rejected
$query = "SELECT bookings.booking_id, ponds.pond_name, bookings.start_date, bookings.end_date, bookings.status, bookings.total_price
          FROM bookings
          JOIN ponds ON bookings.pond_id = ponds.pond_id
          WHERE bookings.user_id = $user_id
          ORDER BY bookings.start_date DESC";

$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>My Bookings</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>My Bookings</h2>

<table border="1">
<tr>
    <th>Pond</th>
    <th>Start Date</th>
    <th>End Date</th>
    <th>Status</th>
    <th>Total Price</th>
    <th>Action</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($result)){
    echo "<tr>";
    echo "<td>" . $row['pond_name'] . "</td>";
    echo "<td>" . $row['start_date'] . "</td>";
    echo "<td>" . $row['end_date'] . "</td>";
    echo "<td>" . ucfirst($row['status']) . "</td>";
    echo "<td>KES " . number_format($row['total_price'], 2) . "</td>";
    echo "<td>";
    if($row['status'] == 'pending' || $row['status'] == 'approved'){
        echo "<a href='cancel_booking.php?id=" . $row['booking_id'] . "'>Cancel</a>";
    } else {
        echo "N/A";
    }
    echo "</td>";
    echo "</tr>";
}
?>
</table>

<br>
<a href="ponds.php">Book Another Pond</a>

</body>
</html>