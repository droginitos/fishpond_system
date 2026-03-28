<?php
session_start();
?>

<h1>Fish Pond Rental System</h1>

<?php
if(isset($_SESSION['user_id'])){

    echo "Welcome, " . $_SESSION['user_name'] . "<br><br>";

    echo "<a href='ponds.php'>View Available Ponds</a><br><br>";
    echo "<a href='my_bookings.php'>My Bookings</a><br><br>";

    if($_SESSION['user_role'] == 'admin'){
        echo "<a href='admin_dashboard.php'>Admin Dashboard</a><br><br>";
    }

    echo "<a href='logout.php'>Logout</a>";

}else{

    echo "<a href='login.php'>Login</a><br><br>";
    echo "<a href='register.php'>Register</a>";

}
?>