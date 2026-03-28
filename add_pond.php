<?php
include 'db.php';
session_start();

if($_SESSION['user_role'] != 'admin'){
    echo "Access denied.";
    exit();
}

if($_SERVER["REQUEST_METHOD"] == "POST"){

$name = $_POST['pond_name'];
$location = $_POST['pond_location'];
$price = $_POST['price_per_day'];

$query = "INSERT INTO ponds (pond_name, pond_location, price_per_day, pond_status)
VALUES ('$name','$location','$price','available')";

mysqli_query($conn,$query);

echo "Pond added successfully.";

}
?>

<h2>Add New Pond</h2>

<form method="POST">

Pond Name:<br>
<input type="text" name="pond_name" required><br><br>

Location:<br>
<input type="text" name="pond_location" required><br><br>

Price Per Day:<br>
<input type="number" name="price_per_day" required><br><br>

<button type="submit">Add Pond</button>

</form>

<br>
<a href="admin_dashboard.php">Back</a>
