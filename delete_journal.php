<?php
include 'db_connect.php';
session_start();

if ($_SESSION['user_role'] != 1) {
    header("Location: unauthorized.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $entry_id = $_POST['entry_id'];

    $sql = "DELETE FROM journal_entries WHERE entry_id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $entry_id, $_SESSION['user_id']);

    if ($stmt->execute()) {
        echo "Journal entry deleted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
