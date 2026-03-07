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

<h2>Welcome <?php echo $_SESSION['name']; ?>!</h2>
<h3>Available Services</h3>
<?php

$sql = "SELECT * FROM services";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0){

    while($service = mysqli_fetch_assoc($result)){
        
        echo "<div>";
        echo "<h4>".$service['service_name']."</h4>";
        echo "<p>".$service['description']."</p>";

        echo "<form method='POST'>";
        echo "<input type='hidden' name='service_id' value='".$service['service_id']."'>";
        echo "<button type='submit' name='book_service'>Book Service</button>";
        echo "</form>";

        echo "</div>";
        echo "<hr>";
    }

}else{
    echo "No services available.";
}

?>

<a href="logout.php">Logout</a>