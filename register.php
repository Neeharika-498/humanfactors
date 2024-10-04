<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role_id = $_POST['role_id'];  

    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (username, password_hash, email, role_id) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $username, $password_hash, $email, $role_id);

    if ($stmt->execute()) {
        echo "Registration successful!";
        header("Location: login.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head><title>Register</title></head>
<body>
    <h2>Register</h2>
    <form method="POST">
        <label>Username:</label><input type="text" name="username" required><br>
        <label>Email:</label><input type="email" name="email" required><br>
        <label>Password:</label><input type="password" name="password" required><br>
        <label>Role:</label>
        <select name="role_id">
            <option value="1">Patient</option>
            <option value="2">Therapist</option>
            <option value="3">Staff</option>
            <option value="4">Auditor</option>
        </select><br>
        <input type="submit" value="Register">
    </form>
</body>
</html>
