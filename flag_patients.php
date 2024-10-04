<?php
include 'db_connect.php';
session_start();

if ($_SESSION['user_role'] != 2) {
    header("Location: unauthorized.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_id = $_POST['patient_id'];

    $sql = "UPDATE patient_records SET flagged_for_followup = TRUE WHERE patient_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $patient_id);

    if ($stmt->execute()) {
        echo "Patient flagged for follow-up!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
