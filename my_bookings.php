<?php
session_start();
include "../config/db.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT bookings.booking_date, bookings.status, services.service_name
        FROM bookings
        JOIN services ON bookings.service_id = services.service_id
        WHERE bookings.user_id = '$user_id'";

$result = mysqli_query($conn, $sql);
?>

<h2>My Bookings</h2>

<table border="1" cellpadding="10">
<tr>
    <th>Service</th>
    <th>Booking Date</th>
    <th>Status</th>
</tr>

<?php

if(mysqli_num_rows($result) > 0){

    while($row = mysqli_fetch_assoc($result)){
        echo "<tr>";
        echo "<td>".$row['service_name']."</td>";
        echo "<td>".$row['booking_date']."</td>";
        echo "<td>".$row['status']."</td>";
        echo "</tr>";
    }

}else{
    echo "<tr><td colspan='3'>No bookings found</td></tr>";
}

?>

</table>

<br>

<a href="dashboard.php">Back to Dashboard</a>