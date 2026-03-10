<?php
session_start();
include "../config/db.php";

if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit();
}
if(isset($_POST['approve'])){

    $booking_id = $_POST['booking_id'];

    $update = "UPDATE bookings SET status='Approved' WHERE booking_id='$booking_id'";

    mysqli_query($conn, $update);
}

$sql = "SELECT bookings.booking_id, users.name, services.service_name, bookings.booking_date, bookings.status        FROM bookings
        JOIN users ON bookings.user_id = users.user_id
        JOIN services ON bookings.service_id = services.service_id";

$result = mysqli_query($conn, $sql);
?>

<h2>Admin Dashboard</h2>

<table border="1" cellpadding="10">

<tr>
<th>Student</th>
<th>Service</th>
<th>Date</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php

while($row = mysqli_fetch_assoc($result)){

    echo "<tr>";
    echo "<td>".$row['name']."</td>";
    echo "<td>".$row['service_name']."</td>";
    echo "<td>".$row['booking_date']."</td>";
    echo "<td>".$row['status']."</td>";

    echo "<td>
    <form method='POST'>
    <input type='hidden' name='booking_id' value='".$row['booking_id']."'>
    <button type='submit' name='approve'>Approve</button>
    </form>
    </td>";

    echo "</tr>";
}

?>

</table>

<br>

<a href="admin_login.php">Logout</a>