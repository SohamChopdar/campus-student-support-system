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


<?php include "../includes/header.php"; ?>


<h2>My Bookings</h2>

<table class="table table-striped table-bordered">
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


</div>
</body>
</html>