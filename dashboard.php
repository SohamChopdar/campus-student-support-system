<?php
session_start();
include "../config/db.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

if(isset($_POST['book_service'])){

    $user_id = $_SESSION['user_id'];
    $service_id = $_POST['service_id'];
    $date = date("Y-m-d");

    $sql = "INSERT INTO bookings (user_id, service_id, booking_date)
            VALUES ('$user_id', '$service_id', '$date')";

    if(mysqli_query($conn, $sql)){
        echo "Service booked successfully!";
    } else {
        echo "Booking failed.";
    }
}
?>


<?php include "../includes/header.php"; ?>


<h2>Welcome <?php echo $_SESSION['name']; ?>!</h2>
<h3>Available Services</h3>
<?php

$sql = "SELECT * FROM services";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0){

echo "<div class='row'>";

while($service = mysqli_fetch_assoc($result)){
        
echo "<div class='col-md-4 mb-3'>";

echo "<div class='card h-100'>";

echo "<div class='card-body'>";

echo "<h5 class='card-title'>".$service['service_name']."</h5>";
echo "<p class='card-text'>".$service['description']."</p>";

echo "<form method='POST'>";
echo "<input type='hidden' name='service_id' value='".$service['service_id']."'>";

echo "<button type='submit' name='book_service' class='btn btn-primary'>
Book Service
</button>";

echo "</form>";

echo "</div>";
echo "</div>";

echo "</div>";

}

echo "</div>";

}else{
echo "No services available.";
}

?>


</div>
</body>
</html>