<?php
include 'db_connect.php';
session_start();

if ($_SESSION['user_role'] != 2) {
    header("Location: unauthorized.php");
    exit();
}

$patient_id = $_GET['patient_id'];
$sql = "SELECT username, notes FROM users JOIN patient_records ON users.user_id = patient_records.patient_id WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $patient_id);
$stmt->execute();
$stmt->bind_result($username, $notes);
$stmt->fetch();

echo "<h3>Patient: $username</h3>";
echo "<p>Notes: $notes</p>";

$stmt->close();
$conn->close();
?>
