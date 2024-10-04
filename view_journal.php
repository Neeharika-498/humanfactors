<?php
include 'db_connect.php';
session_start();

if ($_SESSION['user_role'] != 1) {
    header("Location: unauthorized.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT entry_date, content FROM journal_entries WHERE user_id = ? ORDER BY entry_date DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($entry_date, $content);

while ($stmt->fetch()) {
    echo "<h3>$entry_date</h3>";
    echo "<p>$content</p><hr>";
}

$stmt->close();
$conn->close();
?>
