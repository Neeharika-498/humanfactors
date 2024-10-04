<?php
include 'db_connect.php';
session_start();

if ($_SESSION['user_role'] != 2) {
    header("Location: unauthorized.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_id = $_POST['patient_id'];
    $notes = $_POST['notes'];

    $sql = "UPDATE patient_records SET notes = ? WHERE patient_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $notes, $patient_id);

    if ($stmt->execute()) {
        echo "Patient notes updated successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
