<?php
include 'db_connect.php';
session_start();

if ($_SESSION['user_role'] != 1) {
    header("Location: unauthorized.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $entry_date = $_POST['entry_date'];
    $content = $_POST['content'];

    $sql = "INSERT INTO journal_entries (user_id, entry_date, content) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $user_id, $entry_date, $content);

    if ($stmt->execute()) {
        echo "Journal entry added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head><title>Add Journal</title></head>
<body>
    <h2>Add Journal Entry</h2>
    <form method="POST">
        <label>Date:</label><input type="date" name="entry_date" required><br>
        <label>Content:</label><textarea name="content" required></textarea><br>
        <input type="submit" value="Add Entry">
    </form>
</body>
</html>
