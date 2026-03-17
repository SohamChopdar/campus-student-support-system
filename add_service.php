<?php
session_start();
include "../config/db.php";

if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit();
}

if(isset($_POST['add_service'])){

    $service_name = $_POST['service_name'];
    $description = $_POST['description'];

    $sql = "INSERT INTO services (service_name, description)
            VALUES ('$service_name', '$description')";

    if(mysqli_query($conn, $sql)){
        echo "<div class='alert alert-success'>Service added successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error adding service.</div>";
    }
}

if(isset($_POST['delete_service'])){

    $service_id = $_POST['service_id'];

    $delete = "DELETE FROM services WHERE service_id='$service_id'";

    mysqli_query($conn, $delete);
}
?>

<?php include "../includes/admin_header.php"; ?>

<div class="row justify-content-center">
<div class="col-md-6">

<div class="card mb-4 shadow">

<div class="card-header">
<h4>Add New Service</h4>
</div>

<div class="card-body">

<form method="POST">

<div class="mb-3">
<label>Service Name</label>
<input type="text" name="service_name" class="form-control" required>
</div>

<div class="mb-3">
<label>Description</label>
<textarea name="description" class="form-control" required></textarea>
</div>

<button type="submit" name="add_service" class="btn btn-primary">
Add Service
</button>

</form>

</div>
</div>

</div>
</div>

<h4 class="mb-3">Existing Services</h4>

<table class="table table-striped table-bordered table-hover">

<tr>
<th>Service Name</th>
<th>Description</th>
<th>Action</th>
</tr>

<?php

$sql = "SELECT * FROM services";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result)){

    echo "<tr>";
    echo "<td>".$row['service_name']."</td>";
    echo "<td>".$row['description']."</td>";

    echo "<td>
    <form method='POST'>
    <input type='hidden' name='service_id' value='".$row['service_id']."'>
    <button type='submit' name='delete_service' class='btn btn-danger btn-sm'>
    Delete
    </button>
    </form>
    </td>";

    echo "</tr>";
}

?>

</table>

</div>
</body>
</html>