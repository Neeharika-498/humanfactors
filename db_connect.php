<?php
// db_connect.php

$servername = "localhost";  // XAMPP default for localhost
$username = "root";         // XAMPP default username
$password = "";             // XAMPP default password (usually empty)
$dbname = "care_db";        // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
