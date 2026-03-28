<?php
include 'db.php';

$error = '';
$success = '';

if(isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = 'user'; // default role for normal users

    // Check if email already exists
    $check = mysqli_query($conn, "SELECT * FROM users WHERE user_email='$email'");
    if(mysqli_num_rows($check) > 0){
        $error = "Email already registered!";
    } else {
        // Insert new user
        $insert = mysqli_query($conn, "INSERT INTO users (user_name, user_email, user_password, user_role) 
                                      VALUES ('$name', '$email', '$password', '$role')");
        if($insert){
            $success = "Registration successful! <a href='login.php'>Login here</a>";
        } else {
            $error = "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Register - Fish Pond Rental</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>


<h2>User Registration</h2>

<?php
if($error != ''){
    echo "<p style='color:red;'>$error</p>";
}
if($success != ''){
    echo "<p style='color:green;'>$success</p>";
}
?>

<form method="POST" action="">
    <label>Name:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit" name="register">Register</button>
</form>

<p>Already have an account? <a href="login.php">Login here</a></p>

</body>
</html>