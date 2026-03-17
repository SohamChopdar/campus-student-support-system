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

<?php include "../includes/header.php"; ?>

<div class="row justify-content-center">
<div class="col-md-4">

<div class="card">
<div class="card-header text-center">
<h4>Student Login</h4>
</div>

<div class="card-body">

<form method="POST">

<div class="mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="mb-3">
<label>Password</label>
<input type="password" name="password" class="form-control" required>
</div>

<button type="submit" name="login" class="btn btn-primary w-100">
Login
</button>

<div class="text-center mt-3">

<a href="register.php" class="btn btn-outline-primary btn-sm me-2">
Create Account
</a>

<a href="../admin/admin_login.php" class="btn btn-outline-dark btn-sm">
Admin Login
</a>

</div>

</form>

</div>
</div>

</div>
</div>

</div>
</body>
</html>