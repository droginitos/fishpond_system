<?php
include 'db.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Available Ponds</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
// Get search and price filter values if they exist
$search = isset($_GET['search']) ? $_GET['search'] : '';
$min_price = isset($_GET['min_price']) ? floatval($_GET['min_price']) : 0;
$max_price = isset($_GET['max_price']) ? floatval($_GET['max_price']) : 1000000;

// Build query
$query = "SELECT * FROM ponds WHERE pond_status='available' AND price_per_day BETWEEN $min_price AND $max_price";
if($search != ''){
    $query .= " AND (pond_name LIKE '%$search%' OR pond_location LIKE '%$search%')";
}

$result = mysqli_query($conn, $query);
?>

<h2>Available Ponds</h2>

<form method="GET">
    <input type="text" name="search" placeholder="Search by name or location" value="<?php echo htmlspecialchars($search); ?>">
    Min Price (KES): <input type="number" name="min_price" value="<?php echo $min_price; ?>" min="0" step="1">
    Max Price (KES): <input type="number" name="max_price" value="<?php echo $max_price; ?>" min="0" step="1">
    <button type="submit">Filter</button>
    <a href="ponds.php">Reset</a>
</form>

<br>

<table border="1">
<tr>
    <th>Name</th>
    <th>Location</th>
    <th>Price per Day</th>
    <th>Action</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($result)){
    echo "<tr>";
    echo "<td>" . $row['pond_name'] . "</td>";
    echo "<td>" . $row['pond_location'] . "</td>";
    echo "<td>KES " . number_format($row['price_per_day'], 2) . "</td>";
    echo "<td><a href='book_pond.php?pond_id=" . $row['pond_id'] . "'>Book</a></td>";
    echo "</tr>";
}
?>

</table>

</body>
</html>