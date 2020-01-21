<?php
$servername = "localhost";
$username = "root";
$password = "";
$mydb= "ce_system";

// Create connection
$conn = mysqli_connect($servername, $username,$password,$mydb);
// Check connection
if (!$conn) {
    
    die("Connection failed: " . mysqli_connect_error());
}
// echo "Connected successfully";
?>