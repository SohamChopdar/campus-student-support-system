<?php
session_start();
include "../config/db.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
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
        echo "</div>";
        echo "<hr>";
    }

}else{
    echo "No services available.";
}

?>

<a href="logout.php">Logout</a>