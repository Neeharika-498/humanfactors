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
                case 1:
                    header("Location: patient_dashboard.php");
                    break;
                case 2:
                    header("Location: therapist_dashboard.php");
                    break;
                case 3:
                    header("Location: staff_dashboard.php");
                    break;
                case 4:
                    header("Location: auditor_dashboard.php");
                    break;
                default:
                    echo "Unknown user role.";
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        h2 {
            color: #333;
        }
        form {
            margin-top: 20px;
        }
        label, input {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"], input[type="password"] {
            padding: 10px;
            width: 100%;
            max-width: 300px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            padding: 10px 15px;
            background-color: #007bff;
            border: none;
            color: white;
            cursor: pointer;
            margin-top: 10px;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Login</h2>
    <form method="POST" action="login.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="Login">
    </form>
</body>
</html>
