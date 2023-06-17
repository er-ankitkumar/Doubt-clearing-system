<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ankit";

// Connection
$conn = mysqli_connect($servername,$username, $password,$dbname);

// Check if connection is
// Successful or not
if (!$conn) {
die("Connection failed: ");
}
?>
