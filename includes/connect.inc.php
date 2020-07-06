<?php 
//Database details
$servername ="localhost";
$dbUsername ="root";
$dbPassword ="";
$dbName = "loginsystem";

// Create connection
$conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbName);

// Check connection
if (!$conn) {
    die('<div class="alert alert-warning mt-3" role="alert"><h4>Connection Failed<h4>'.mysqli_connect_error().'</div>');
}
echo '<div class="alert alert-success mt-3" role="alert">Connection Successful</div>';

?>