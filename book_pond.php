<?php
include 'db.php';
session_start();

// Check if user is logged in
if(!isset($_SESSION['user_id'])){
    echo "You must login first.";
    exit();
}

// Check if pond was selected
if(!isset($_GET['pond_id'])){
    echo "Invalid request.";
    exit();
}

$pond_id = $_GET['pond_id'];
$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Book Pond</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav>
    <a href="index.php">Home</a>
    <a href="ponds.php">View Ponds</a>
    <a href="my_bookings.php">My Bookings</a>
    <a href="logout.php">Logout</a>
</nav>

<h2>Book This Pond</h2>

<form method="POST">
    <label>Start Date:</label><br>
    <input type="date" name="start_date" required><br><br>

    <label>End Date:</label><br>
    <input type="date" name="end_date" required><br><br>

    <button type="submit">Confirm Booking</button>
</form>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Check if pond is already booked in those dates
    $check_query = "SELECT * FROM bookings
    WHERE pond_id = $pond_id
    AND status != 'cancelled'
    AND start_date <= '$end_date'
    AND end_date >= '$start_date'";

    $result = mysqli_query($conn,$check_query);

    if(mysqli_num_rows($result) > 0){
        echo "<p style='color:red;'>This pond is already booked for the selected dates.</p>";
    } else {

        // Get pond price
        $price_query = "SELECT price_per_day FROM ponds WHERE pond_id = $pond_id";
        $price_result = mysqli_query($conn, $price_query);
        $pond = mysqli_fetch_assoc($price_result);
        $price_per_day = $pond['price_per_day'];

        // Calculate total days and price
        $days = (strtotime($end_date) - strtotime($start_date)) / (60*60*24) + 1; // include start date
        $total_price = $days * $price_per_day;

        // Insert booking
        $insert_query = "INSERT INTO bookings (user_id, pond_id, start_date, end_date, status, total_price)
                         VALUES ($user_id, $pond_id, '$start_date', '$end_date', 'pending', $total_price)";

        if(mysqli_query($conn, $insert_query)){
            echo "<p style='color:green;'>Booking successful! Total price: KES " . number_format($total_price, 2) . "</p>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }

    }

}
?>

<br>
<a href="ponds.php">Back to Ponds</a>

</body>
</html>