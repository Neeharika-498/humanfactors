<?php
include 'db_connect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $sql = "SELECT user_id, username, password_hash, role_id FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $username_db, $password_hash, $role_id);
        $stmt->fetch();

        if (password_verify($password, $password_hash)) {
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username_db;
            $_SESSION['user_role'] = $role_id;

            switch ($role_id) {
                case 1: header("Location: patient_dashboard.php"); break;
                case 2: header("Location: therapist_dashboard.php"); break;
                case 3: header("Location: staff_dashboard.php"); break;
                case 4: header("Location: auditor_dashboard.php"); break;
                default: echo "Unknown role.";
            }
            exit();
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "Username not found.";
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>
    <h2>Login</h2>
    <form method="POST">
        <label>Username:</label><input type="text" name="username" required><br>
        <label>Password:</label><input type="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
