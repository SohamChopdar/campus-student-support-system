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
    mysqli_query($conn,$update);
}

$sql = "SELECT bookings.booking_id, users.name, services.service_name, bookings.booking_date, bookings.status
        FROM bookings
        JOIN users ON bookings.user_id = users.user_id
        JOIN services ON bookings.service_id = services.service_id";

$result = mysqli_query($conn,$sql);
?>

<?php include "../includes/admin_header.php"; ?>

<h2 class="mb-4">Admin Dashboard</h2>

<table class="table table-striped table-bordered table-hover">

<thead>
<tr>
<th>Student</th>
<th>Service</th>
<th>Date</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>

<tbody>

<?php
while($row = mysqli_fetch_assoc($result)){
?>

<tr>

<td><?php echo $row['name']; ?></td>
<td><?php echo $row['service_name']; ?></td>
<td><?php echo $row['booking_date']; ?></td>

<td>
<?php
if($row['status']=="Pending"){
echo "<span class='badge bg-warning text-dark'>Pending</span>";
}else{
echo "<span class='badge bg-success'>Approved</span>";
}
?>
</td>

<td>

<?php
if($row['status']=="Pending"){
?>

<form method="POST">
<input type="hidden" name="booking_id" value="<?php echo $row['booking_id']; ?>">
<button type="submit" name="approve" class="btn btn-success btn-sm">Approve</button>
</form>

<?php
}else{
echo "<span class='badge bg-success'>Approved</span>";
}
?>

</td>

</tr>

<?php
}
?>

</tbody>
</table>

</div>
</body>
</html>