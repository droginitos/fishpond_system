<?php
session_start();
include 'db.php';

$error = '';

if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $check = mysqli_query($conn, "SELECT * FROM users WHERE user_email='$email' AND user_password='$password'");
    if(mysqli_num_rows($check) == 1){
        $user = mysqli_fetch_assoc($check);
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_name'] = $user['user_name'];
        $_SESSION['user_role'] = $user['user_role'];

        // Redirect based on role
        if($user['user_role'] == 'admin'){
            header("Location: admin_dashboard.php");
        } else {
            header("Location: index.php");
        }
        exit();
    } else {
        $error = "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login - Fish Pond Rental</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>User Login</h2>

<?php
if($error != ''){
    echo "<p style='color:red;'>$error</p>";
}
?>

<form method="POST" action="">
    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit" name="login">Login</button>
</form>

<p>Don't have an account? <a href="register.php">Register here</a></p>

</body>
</html>