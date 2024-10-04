<?php
include 'db_connect.php';
session_start();

if ($_SESSION['user_role'] != 1) {
    header("Location: unauthorized.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $entry_id = $_POST['entry_id'];
    $content = $_POST['content'];

    $sql = "UPDATE journal_entries SET content = ? WHERE entry_id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sii", $content, $entry_id, $_SESSION['user_id']);

    if ($stmt->execute()) {
        echo "Journal entry updated successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
