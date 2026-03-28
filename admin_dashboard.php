<?php
include 'db.php';
session_start();

if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'admin'){
    echo "Access denied!";
    exit();
}


if($_SESSION['user_role'] != 'admin'){
    echo "Access denied.";
    exit();
}

$query = "SELECT bookings.*, users.user_name, ponds.pond_name
          FROM bookings
          JOIN users ON bookings.user_id = users.user_id
          JOIN ponds ON bookings.pond_id = ponds.pond_id";

$result = mysqli_query($conn,$query);
?>

<h2>Admin Dashboard</h2>

<a href="add_pond.php">Add New Pond</a>
<br><br>
<a href="ponds.php">View Ponds</a>
<br><br>

<table border="1">

<tr>
<th>User</th>
<th>Pond</th>
<th>Start</th>
<th>End</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($result)){
?>

<tr>

<td><?php echo $row['user_name']; ?></td>
<td><?php echo $row['pond_name']; ?></td>
<td><?php echo $row['start_date']; ?></td>
<td><?php echo $row['end_date']; ?></td>
<td><?php echo $row['status']; ?></td>

<td>
<a href="approve_booking.php?id=<?php echo $row['booking_id']; ?>">Approve</a>
|
<a href="reject_booking.php?id=<?php echo $row['booking_id']; ?>">Reject</a>

</td>

</tr>

<?php } ?>

</table>
