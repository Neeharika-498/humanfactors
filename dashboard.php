<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

echo "<h2>Welcome, " . $_SESSION['username'] . "</h2>";

switch ($_SESSION['user_role']) {
    case 1: include 'patient_dashboard.php'; break;
    case 2: include 'therapist_dashboard.php'; break;
    case 3: include 'staff_dashboard.php'; break;
    case 4: include 'auditor_dashboard.php'; break;
    default: echo "Unknown role.";
}
?>
