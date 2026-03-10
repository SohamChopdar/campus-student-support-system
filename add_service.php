<?php
session_start();
include "../config/db.php";

if(isset($_POST['delete_service'])){

    $service_id = $_POST['service_id'];

    $delete = "DELETE FROM services WHERE service_id='$service_id'";

    mysqli_query($conn, $delete);
}

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
        echo "Service added successfully!";
    } else {
        echo "Error adding service.";
    }
}
?>

<h2>Add New Service</h2>

<form method="POST">

<label>Service Name</label><br>
<input type="text" name="service_name" required><br><br>

<label>Description</label><br>
<textarea name="description" required></textarea><br><br>

<button type="submit" name="add_service">Add Service</button>

</form>

<br>

<a href="admin_dashboard.php">Back to Dashboard</a>

<h3>Existing Services</h3>

<table border="1" cellpadding="10">

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
    <button type='submit' name='delete_service'>Delete</button>
    </form>
    </td>";

    echo "</tr>";
}

?>

</table>