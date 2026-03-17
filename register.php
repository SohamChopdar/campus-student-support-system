<?php

include "../config/db.php";

if(isset($_POST['register'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, password)
            VALUES ('$name', '$email', '$password')";

    if(mysqli_query($conn, $sql)){
    header("Location: login.php");
    exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<?php include "../includes/header.php"; ?>

<div class="row justify-content-center">
<div class="col-md-5">

<div class="card">
<div class="card-header text-center">
<h4>Student Registration</h4>
</div>

<div class="card-body">

<form method="POST">

<div class="mb-3">
<label>Name</label>
<input type="text" name="name" class="form-control" required>
</div>

<div class="mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="mb-3">
<label>Password</label>
<input type="password" name="password" class="form-control" required>
</div>

<button type="submit" name="register" class="btn btn-success w-100">
Register
</button>

</form>

</div>
</div>

</div>
</div>

</div>
</body>
</html>