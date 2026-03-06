<?php

session_start();
include "../config/db.php";

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 1){

        $user = mysqli_fetch_assoc($result);

        if(password_verify($password, $user['password'])){

            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['name'] = $user['name'];

            header("Location: dashboard.php");
            exit();

        } else {
            echo "Invalid password!";
        }

    } else {
        echo "User not found!";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Student Login</title>
</head>

<body>

<h2>Student Login</h2>

<form method="POST">

<label>Email</label><br>
<input type="email" name="email" required><br><br>

<label>Password</label><br>
<input type="password" name="password" required><br><br>

<button type="submit" name="login">Login</button>

</form>

</body>
</html>