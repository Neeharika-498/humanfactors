<?php
// db_connect.php

$servername = "localhost";  // localhost
$username = "root";         // default username
$password = "";             // default password 
$dbname = "care_d";        

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
