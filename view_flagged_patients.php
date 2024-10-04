<?php
include 'db_connect.php';
session_start();

if ($_SESSION['user_role'] != 2) {
    header("Location: unauthorized.php");
    exit();
}

$sql = "SELECT p.patient_id, u.username, pr.notes FROM patient_records pr JOIN users u ON pr.patient_id = u.user_id WHERE pr.flagged_for_followup = TRUE";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "Patient ID: " . $row['patient_id'] . " - Name: " . $row['username'] . " - Notes: " . $row['notes'] . "<br>";
}

$conn->close();
?>
