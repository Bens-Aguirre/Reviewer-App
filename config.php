<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "reviewer_app";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);

if ($conn->connect_errno) {
    die("Connection error: " . $conn->connect_error);
}

return $conn;
?>