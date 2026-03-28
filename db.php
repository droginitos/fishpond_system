<?php
$host = "localhost";
$user = "root"; // default XAMPP username
$password = ""; // default XAMPP password
$database = "fishpond_db";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>