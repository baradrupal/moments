<?php
//$con=mysqli_connect("localhost","","","");

$servername = "localhost";
$username = "momentsu_intelli";
$password = "Intelli@123";
$dbname = "momentsu_website";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

